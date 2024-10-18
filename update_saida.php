<?php
// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'login_system';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtendo os dados do formulário
$id = $_POST['id'];
$data_saida = $_POST['data_saida'];

// Atualizando a data de saída
$sql = "UPDATE inspecao_inicial SET data_saida = '$data_saida' WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    // Redirecionar para a página de inspeção final com uma mensagem de sucesso
    header("Location: inspecao_final.php?status=sucesso");
} else {
    // Redirecionar para a página de inspeção final com uma mensagem de erro
    $error_message = urlencode("Erro ao atualizar a data de saída: " . $conn->error);
    header("Location: inspecao_final.php?status=erro&message=$error_message");
}

$conn->close();
?>
