<?php
require '../db/database.php';
$msg = '';
$msgType = '';

if (!isset($_GET['id']) && !isset($_POST['id'])) {
    header("Location: ../index.php"); 
    exit();
}

$id = $_GET['id'] ?? $_POST['id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$current_data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if (empty($name) || empty($email)) {
        $msg = "Please fill out all fields.";
        $msgType = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Invalid email address.";
        $msgType = "error";
    } else {
        $check_stmt = $conn->prepare("SELECT id FROM users WHERE (name = ? OR email = ?) AND id != ?");
        $check_stmt->bind_param("ssi", $name, $email, $id);
        $check_stmt->execute();
        $check_stmt->store_result();
        
        if ($check_stmt->num_rows > 0) {
            $msg = "This name or email is already used by another user.";
            $msgType = "error";
        } else {
            $update_stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            $update_stmt->bind_param("ssi", $name, $email, $id);
            if ($update_stmt->execute()) {
                $msg = "User successfully updated.";
                $msgType = "success";
                $current_data['name'] = $name;
                $current_data['email'] = $email;
            } else {
                $msg = "Failed to update data.";
                $msgType = "error";
            }
            $update_stmt->close();
        }
        $check_stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Update User</h2>
        
        <?php if($msg != ''): ?>
            <div class="msg <?= $msgType ?>"><?= $msg ?></div>
        <?php endif; ?>

        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" value="<?= htmlspecialchars($current_data['name']) ?>" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($current_data['email']) ?>" required>
            </div>
            <button type="submit" class="btn-submit">Update</button>
        </form>

        <div class="nav-buttons">
            <a href="create.php">CREATE</a>
            <a href="../index.php">READ</a>
        </div>
    </div>
</body>
</html>