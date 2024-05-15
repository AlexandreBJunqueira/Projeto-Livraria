<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Busca - Livraria</title>
    <link rel="stylesheet" href="style_catalogo.css">
</head>
<body>
    <header>
        <h1>Resultado da Busca</h1>
        <nav>
            <ul>
                <li><a href="index.html">Página Inicial</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
        include 'connection.php';

        if(isset($_GET['search'])) {
            $search = $_GET['search'];

            $sql = "SELECT * FROM livros WHERE id = '$search' OR titulo LIKE '%$search%'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table class='result-table'>";
                echo "<tr><th>Título</th><th>Autor</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["titulo"] . "</td><td>" . $row["autor"] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Nenhum livro encontrado.</p>";
            }
        }

        $conn->close();
        ?>
    </main>
    <footer>
        <p>&copy; 2024 Livraria. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
