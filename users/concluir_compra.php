<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Concluída</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        header {
            background-color: #491254;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        header nav ul li {
            display: inline;
            margin: 0 10px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        header nav ul li a:hover {
            text-decoration: underline;
        }

        main {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }

        h1 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Página Inicial</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
        session_start();
        include 'connection.php'; // Inclui o arquivo de conexão

        // Supomos que o username está armazenado na sessão
        $user = $_SESSION['username'];

        // Remover todos os itens do carrinho para o usuário logado usando prepared statement
        $stmt = $conn->prepare("DELETE FROM carrinho WHERE username = ?");
        $stmt->bind_param("s", $user);

        if ($stmt->execute()) {
            echo "<h1>Parabéns. Sua compra foi concluída!</h1>";
        } else {
            echo "<h1>Erro ao concluir a compra: " . $stmt->error . "</h1>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </main>
</body>
</html>
