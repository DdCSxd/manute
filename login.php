<?php
// Inicializar a sessão (se necessário, para manter o login ativo)
session_start();

// Se o formulário foi enviado, execute o código de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conectar ao banco de dados
    $host = 'localhost';
    $dbname = 'login_system';
    $user = 'root';
    $password = '';

    // Tentar conexão com o banco de dados
    $conn = new mysqli($host, $user, $password, $dbname);

    // Verificar se houve erro na conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Obter dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Usar prepared statements para evitar SQL injection
    $stmt = $conn->prepare("SELECT senha FROM users WHERE login = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Verificar se o usuário foi encontrado
    if ($stmt->num_rows > 0) {
        // Ligar o resultado da consulta ao PHP
        $stmt->bind_result($hash_senha);
        $stmt->fetch();

        // Verificar se a senha corresponde ao valor armazenado no banco
        if ($password === $hash_senha) {
            // Login bem-sucedido, redirecionar para o dashboard
            header("Location: /mnt/dashboard.php"); // Verifique se o arquivo está na pasta correta
            exit();
        } else {
            // Senha incorreta
            $error = "Login ou senha incorretos.";
        }
    } else {
        // Usuário não encontrado
        $error = "Login ou senha incorretos.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
</head>
</head>
<body>
    <div class = "login">Login<br/></div>

    <h2 >Login</h2>
    <img class = "imagemsl" src="login.jpeg" alt="imagem">
    
    <!-- Mostrar mensagem de erro, se houver -->
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="login.php" method="post">
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input class="botao" type="submit" value="Entrar">
    </form>
</body>
</html>
