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
                <li><a href="index.html">Página Inicial</a></li>
                <!-- Adicione mais links de navegação, se necessário -->
            </ul>
        </nav>
    </header>
    <main>
        <h2>Livros Disponíveis</h2>
        <?php
        // Exibindo os livros do catálogo
        if ($result->num_rows > 0) {
            // Exibir os dados de cada livro
            echo "<table>";
            echo "<tr><th>Título</th><th>Autor</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["titulo"] . "</td><td>" . $row["autor"] . "</td></tr>";
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
