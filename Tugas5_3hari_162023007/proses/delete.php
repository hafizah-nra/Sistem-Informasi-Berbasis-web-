<?php
require '../db/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $del_stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $del_stmt->bind_param("i", $id);
    $del_stmt->execute();
    $del_stmt->close();
}

header("Location: ../index.php");
exit();
?>