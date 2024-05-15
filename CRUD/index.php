<?php
include 'connection.php';

$sql = "SELECT * FROM livros";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Livros</title>
</head>
<body>
    <h1>Lista de Livros</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Capa</th>
            <th>Título</th>
            <th>Autor</th>
            <th>ISBN</th>
            <th>Descrição</th>
            <th>Data de Publicação</th>
            <th>Gênero</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td><img src='capas/".$row["capa"]."' alt='Capa do Livro' style='max-width: 100px;'></td>";
                echo "<td>".$row["titulo"]."</td>";
                echo "<td>".$row["autor"]."</td>";
                echo "<td>".$row["isbn"]."</td>";
                echo "<td>".$row["descricao"]."</td>";
                echo "<td>".$row["data_pub"]."</td>";
                echo "<td>".$row["genero"]."</td>";
                echo "<td><a href='edit.php?id=".$row["id"]."'>Editar</a> | <a href='delete.php?id=".$row["id"]."'>Excluir</a></td>";
                echo "</tr>";
            }

        } else {
            echo "<tr><td colspan='10'>Nenhum livro encontrado</td></tr>";
        }
        ?>
    </table>
    <a href="insert.php">Adicionar livro</a>
</body>
</html>
