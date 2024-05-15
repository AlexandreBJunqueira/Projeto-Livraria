<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $isbn = $_POST['isbn'];
    $descricao = $_POST['descricao'];
    $data_pub = $_POST['data_pub'];
    $genero = $_POST['genero'];

    $capa = $_FILES['capa']['name'];
    $target_dir = "capas/";
    $target_file = $target_dir . basename($_FILES["capa"]["name"]);
    move_uploaded_file($_FILES["capa"]["tmp_name"], $target_file);

    $sql = "INSERT INTO livros (capa, titulo, autor, isbn, descricao, data_pub, genero)
            VALUES ('$capa', '$titulo', '$autor', '$isbn', '$descricao', '$data_pub', '$genero')";

    if ($conn->query($sql) === TRUE) {
        header("Local: index.php");
    } else {
        echo "Erro ao inserir os dados: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Adicionar Novo Livro</title>
</head>
<body>
    <h2>Adicionar Novo Livro</h2>
    <form action="" method="post" enctype="multipart/form-data">
        Capa: <input type="file" name="capa" required><br>
        Título: <input type="text" name="titulo" required><br>
        Autor: <input type="text" name="autor" required><br>
        ISBN: <input type="text" name="isbn" required><br>
        Descrição: <textarea name="descricao" required></textarea><br>
        Data de Publicação: <input type="date" name="data_pub" required><br>
        Gênero: <input type="text" name="genero" required><br>
        <input type="submit" value="Adicionar Livro">
    </form>
</body>
</html>
