<?php
session_start();
include 'connection.php';
$sql = "SELECT * FROM livros";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Livraria</title>
    <link rel="stylesheet" href="style_catalogo.css"> <!-- Adicione esta linha para vincular o arquivo CSS -->
</head>
<body>
    <header>
        <h1>Catálogo de Livros</h1>
        <nav>
            <ul>
                <li><a href="index.html">Início</a></li>
                <li><a href="livros_mais_vendidos.php">Livros mais vendidos</a></li>
                <li><a href="busca.html">Busca de Livros</a></li>
                <li><a href="carrinho.php">Carrinho de Compras</a></li>
                <li><a href="about.html">Sobre nós</a></li>
                <li><a href="contact.html">Contate-nos</a></li>
            </ul>
        </nav>
    </header>
    <a href="login.php" class="login-btn">Login</a>
    <main>
        <h2>Livros Disponíveis</h2>
        <?php
        // Exibindo os livros do catálogo
        if ($result->num_rows > 0) {
            // Exibir os dados de cada livro
            echo "<table>";
            echo "<tr><th>Título</th><th>Autor</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td><a href='modelo_livro.php?id=" . $row["id"] . "'>" . $row["titulo"] . "</a></td><td>" . $row["autor"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Nenhum livro disponível.</p>";
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2024 Livraria. Todos os direitos reservados.</p>
    </footer>
</body>
</html>

<?php
// Fechando a conexão
$conn->close();
?>
