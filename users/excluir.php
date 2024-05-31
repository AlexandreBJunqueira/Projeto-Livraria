<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_POST['id'];
$username = $_SESSION['username'];
$sql = "DELETE FROM carrinho WHERE livro_id = ? AND username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id, $username);
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: carrinho.php");
?>