<?php
session_start();
include 'connection.php';

// Consulta SQL para encontrar os 5 livros mais vendidos
$sql = "SELECT id_livro, COUNT(id_livro) AS total_vendas FROM vendas GROUP BY id_livro ORDER BY total_vendas DESC LIMIT 5";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5 Livros Mais Vendidos</title>
    <link rel="stylesheet" href="style_catalogo.css">
</head>
<body>
    <header>
        <h1>5 Livros Mais Vendidos</h1>
        <nav>
            <ul>
                <li><a href="index.html">Página Inicial</a></li>
                <!-- Adicione mais links de navegação, se necessário -->
            </ul>
        </nav>
    </header>
    <main>
        <h2>5 Livros Mais Vendidos</h2>
        <table>
            <tr>
                <th>ID do Livro</th>
                <th>Total de Vendas</th>
            </tr>
            <?php
            // Exibir os resultados em uma tabela HTML
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_livro"] . "</td>";
                    echo "<td>" . $row["total_vendas"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Nenhum livro vendido encontrado.</td></tr>";
            }

            // Fechar a conexão com o banco de dados
            $conn->close();
            ?>
        </table>
    </main>
</body>
</html>
