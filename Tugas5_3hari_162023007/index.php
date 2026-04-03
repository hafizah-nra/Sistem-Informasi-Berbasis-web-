<?php
require 'db/database.php';

$result = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Read Data</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Read Data</h2>
        
        <div class="data-list">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="data-item">
                    <div class="data-info">
                        <span class="data-name"><?= htmlspecialchars($row['name']) ?></span>
                        <span class="data-email"><?= htmlspecialchars($row['email']) ?></span>
                    </div>
                    <div class="data-actions">
                        <a href="proses/update.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                        <a href="proses/delete.php?id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </div>
                </div>
            <?php endwhile; ?>
            
            <?php if($result->num_rows == 0): ?>
                <p style="text-align:center; font-size: 13px;">No data available.</p>
            <?php endif; ?>
        </div>

        <div class="nav-buttons">
            <a href="proses/create.php">CREATE</a>
            <a href="index.php">READ</a>
        </div>
    </div>
</body>
</html>