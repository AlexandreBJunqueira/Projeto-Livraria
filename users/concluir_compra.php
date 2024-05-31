<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Aqui você pode limpar o carrinho, se desejar
$usuario_id = $_SESSION['username'];
$sql = "DELETE FROM carrinho WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario_id);
$stmt->execute();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Compra Concluída</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        h1 {
            color: #491254;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        a {
            text-decoration: none;
            color: #fff;
            background-color: #491254;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #ffac33;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Obrigado pela sua compra!</h1>
        <p>Sua compra está em processamento. Você receberá uma confirmação por email em breve.</p>
        <a href="index.html">Voltar à Página Inicial</a>
    </div>
</body>
</html>