<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    $stmt = $pdo->prepare("UPDATE albums SET status = 'прослушан' WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: index.php');
exit;
?>