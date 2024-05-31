<?php

session_start();
include 'connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['username'];
$sql = "SELECT l.titulo, l.autor, p.preco, c.quantidade 
        FROM carrinho c
        JOIN livros l ON c.livro_id = l.id 
        JOIN pre__os p ON l.id = p.id_livro
        WHERE c.username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="style_carrinho.css">
</head>
<body>
    <h1>Seu Carrinho de Compras</h1>
    <table>
        <tr>
            <th>Livro</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Total</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['titulo']); ?></td>
            <td><?php echo number_format($row['preco'], 2); ?></td>
            <td><?php echo htmlspecialchars($row['quantidade']); ?></td>
            <td><?php echo number_format($row['preco'] * $row['quantidade'], 2); ?></td>
            <td>
                <form action="editar_carrinho.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="number" name="quantidade" value="<?php echo $row['quantidade']; ?>" min="1">
                    <button type="submit">Atualizar</button>
                </form>
                <form action="excluir_do_carrinho.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="index.html" style="display: inline-block; margin-left: 33%;">Continuar Comprando</a>
    <a href="concluir_compra.php" style="display: inline-block; margin-bottom: 80px;">Concluir Compra</a>
    <footer>
        <p>&copy; 2024 Dados Literários. Todos os direitos reservados.</p>
    </footer>
</body>
</html>


<?php
$stmt->close();
$conn->close();
?>
