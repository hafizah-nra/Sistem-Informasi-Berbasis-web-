<?php
require '../db/database.php';
$msg = '';
$msgType = '';

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
        $stmt = $conn->prepare("SELECT id FROM users WHERE name = ? OR email = ?");
        $stmt->bind_param("ss", $name, $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $msg = "This name or email is already registered. Please try another.";
            $msgType = "error";
        } else {
            $insert_stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
            $insert_stmt->bind_param("ss", $name, $email);
            if ($insert_stmt->execute()) {
                $msg = "User has been successfully inserted.";
                $msgType = "success";
            } else {
                $msg = "Failed to insert data.";
                $msgType = "error";
            }
            $insert_stmt->close();
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Data</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Create Data</h2>
        
        <?php if($msg != ''): ?>
            <div class="msg <?= $msgType ?>"><?= $msg ?></div>
        <?php endif; ?>

        <form action="create.php" method="POST">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" placeholder="Your name" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" placeholder="Your email" required>
            </div>
            <button type="submit" class="btn-submit">Insert</button>
        </form>

        <div class="nav-buttons">
            <a href="create.php">CREATE</a>
            <a href="../index.php">READ</a>
        </div>
    </div>
</body>
</html>