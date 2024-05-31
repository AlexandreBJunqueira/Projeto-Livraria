<?php
session_start();
include 'connection.php';

// Variável para armazenar mensagens de sucesso ou erro
$message = "";

// Verificar se o ID do livro foi passado na URL
if (isset($_GET['id'])) {
    $livro_id = $_GET['id'];

    // Consultar o banco de dados para obter os detalhes do livro
    $sql = "SELECT * FROM livros WHERE id = $livro_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obter os dados do livro
        $row = $result->fetch_assoc();
    } else {
        echo "<p>Livro não encontrado.</p>";
        exit;
    }
} else {
    echo "<p>ID do livro não fornecido.</p>";
    exit;
}

// Função para adicionar ao carrinho
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['livro_id'])) {
    // Verificar se o usuário está logado
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $livro_id = $_POST['livro_id'];

        // Verificar se o livro já está no carrinho do usuário
        $check_sql = "SELECT * FROM carrinho WHERE username = '$username' AND livro_id = $livro_id";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            $message = "Você já adicionou este livro ao carrinho.";
        } else {
            // Inserir o item no carrinho
            $insert_sql = "INSERT INTO carrinho (username, livro_id, quantidade) VALUES ('$username', $livro_id, 1)";
            if ($conn->query($insert_sql) === TRUE) {
                $message = "Livro adicionado ao carrinho com sucesso!";
            } else {
                $message = "Erro ao adicionar o livro ao carrinho: " . $conn->error;
            }
        }
    } else {
        // Redirecionar para a página de login
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['titulo']); ?></title>
    <link rel="stylesheet" href="style_modelo.css">
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($row['titulo']); ?></h1>
        <nav>
            <ul>
                <li><a href="index.html">Página Inicial</a></li>
                <li><a href="catalogo.php">Catálogo</a></li>
                <!-- Adicione mais links de navegação, se necessário -->
            </ul>
        </nav>
    </header>
    <main>
        <h2><?php echo htmlspecialchars($row['titulo']); ?></h2>
        <img src="../<?php echo htmlspecialchars($row['capa']); ?>" alt="<?php echo htmlspecialchars($row['titulo']); ?>">
        <div>
            <p class="author">Autor: <?php echo htmlspecialchars($row['autor']); ?></p>
            <p class="price">Gênero: <?php echo htmlspecialchars($row['genero']); ?></p>
            <p><?php echo htmlspecialchars($row['descricao']); ?></p>
            <p class="error-message"><?php echo $message; ?></p>
        </div>
        <form action="modelo_livro.php?id=<?php echo $livro_id; ?>" method="POST">
            <input type="hidden" name="livro_id" value="<?php echo $row['id']; ?>">
            <button type="submit">Incluir no Carrinho</button>
        </form>
        <!-- Exibir mensagens após o botão -->
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