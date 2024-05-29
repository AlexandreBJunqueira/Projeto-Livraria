<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "abj19032005";
$dbname = "livraria";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>