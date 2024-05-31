<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_POST['id'];
$quantidade = $_POST['quantidade'];
$username = $_SESSION['username'];

$sql = "UPDATE carrinho SET quantidade = ? WHERE livro_id = ? AND username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $quantidade, $id, $username);
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: carrinho.php");
?>