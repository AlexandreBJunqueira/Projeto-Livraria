<?php
    session_start();
    include 'connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            if ($_SESSION['role'] == 'admin') {
                header("Location: admin/admin_home.php");
            } else {
                header("Location: users/index.html");
            }
        } else {
            $error = "Username or password is invalid";
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
    <div class="login-container">
        <h2>Entre na sua Conta</h2>
        <form id="login-form" action="login.php" method="post">
            <div class="form-group">
                <label for="username">Nome do Usuário:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <a href="index.html" class="back-btn">Voltar à página inicial</a>
    </div>
    <?php
    if (isset($error_message)) {
        echo "<div class='error-message'>$error_message</div>";
    }
    ?>
</body>
</html>