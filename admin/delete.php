<?php
include '../connection.php';

$id = $_GET['id'];

$sql = "DELETE FROM livros WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Erro ao excluir registro: " . $conn->error;
}

$conn->close();
?>
