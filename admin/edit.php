<?php
include '../connection.php';

$id = $_GET['id'];
$sql = "SELECT * FROM livros WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $isbn = $_POST['isbn'];
    $descricao = $_POST['descricao'];
    $data_pub = $_POST['data_pub'];
    $genero = $_POST['genero'];

    $capa = $_FILES['capa']['name'];
    $diretorio_destino = "capas/";
    $caminho_destino = $diretorio_destino . basename($_FILES["capa"]["name"]);
    move_uploaded_file($_FILES["capa"]["tmp_name"], $caminho_destino);

    $sql = "UPDATE livros SET 
                capa='$capa', 
                titulo='$titulo', 
                autor='$autor', 
                isbn='$isbn', 
                descricao='$descricao', 
                data_pub='$data_pub', 
                genero='$genero' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Erro ao atualizar registro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Livro</title>
</head>
<body>
    <h2>Editar Livro</h2>
    <form action="" method="post" enctype="multipart/form-data">
        Capa: <input type="file" name="capa"><br>
        Título: <input type="text" name="titulo" value="<?php echo $row['titulo']; ?>" required><br>
        Autor: <input type="text" name="autor" value="<?php echo $row['autor']; ?>" required><br>
        ISBN: <input type="text" name="isbn" value="<?php echo $row['isbn']; ?>" required><br>
        Descrição: <textarea name="descricao" required><?php echo $row['descricao']; ?></textarea><br>
        Data de Publicação: <input type="date" name="data_pub" value="<?php echo $row['data_pub']; ?>" required><br>
        Gênero: <input type="text" name="genero" value="<?php echo $row['genero']; ?>" required><br>
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>

