<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revolta de Atlas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Dados Literários</h1>
        <nav>
            <ul>
                <li><a href="index.html">Início</a></li>
                <li><a href="about.html">Sobre nós</a></li>
                <li><a href="contact.html">Contate-nos</a></li>
            </ul>
        </nav>
    </header>
    <a href="login.html" class="login-btn">Login</a>
    <main>
        <h2>Revolta de Atlas</h2>
        <img src="Revolta_de_Atlas.jpg" alt="Revolta de Atlas">
        <div>
            <p class="author">Autor: Ayn Rand</p>
            <p class="price">Preço: R$ 89.90</p>
            <p>Na mitologia grega, o titã Atlas recebe de Zeus o castigo eterno de carregar nos ombros o peso dos céus. Neste clássico romance de Ayn Rand, os pensadores, os inovadores e os indivíduos criativos suportam o peso de um mundo decadente enquanto são explorados por parasitas que não reconhecem o valor do trabalho e da produtividade e que se valem da corrupção, da mediocridade e da burocracia para impedir o progresso individual e da sociedade. Mas até quando eles vão aguentar? Considerado o livro mais influente nos Estados Unidos depois da Bíblia, segundo a Biblioteca do Congresso americano, A revolta de Atlas é um romance monumental. A história se passa numa época imprecisa, quando as forças políticas de esquerda estão no poder. Último baluarte do que ainda resta do capitalismo num mundo infestado de repúblicas populares, os Estados Unidos estão em decadência e sua economia caminha para o colapso.</p>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Dados Literários. Todos os direitos reservados.</p>
    </footer>
</body>
<form action="adicionar_ao_carrinho.php" method="POST">
    <input type="hidden" name="livro_id" value="<?php echo $livro_id; ?>">
    <button type="submit">Incluir no Carrinho</button>
</form>
</html>

<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$livro_id = $_POST['livro_id'];
$quantidade = 1; // ou use um input para quantidade

$conn = new mysqli("localhost", "seu_usuario", "sua_senha", "sua_base_de_dados");
$sql = "INSERT INTO carrinho (usuario_id, livro_id, quantidade) VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE quantidade = quantidade + 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $usuario_id, $livro_id, $quantidade);
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: pagina_do_livro.php?livro_id=" . $livro_id);
?>