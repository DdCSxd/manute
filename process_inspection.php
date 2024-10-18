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

// Verificar se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Capturar os dados do formulário
    $tipo_pqd = is_array($_POST['tipo_pqd']) ? implode(', ', $_POST['tipo_pqd']) : $_POST['tipo_pqd'];
    $data_fabricacao = $_POST['data_fabricacao'];
    $numero_velame = $_POST['numero_velame'];
    $numero_involucro = $_POST['numero_involucro'];
    $inspecionado_por = $_POST['inspecionado_por'];
    $data_inspecao = $_POST['data_inspecao'];
    $observacoes = $_POST['observacoes'];

    // Tratamento de campos opcionais
    $remendo = isset($_POST['remendo']) ? $_POST['remendo'] : null;
    $remendo_painel = isset($_POST['remendo_painel']) ? $_POST['remendo_painel'] : null;
    $remendo_secao = isset($_POST['remendo_secao']) ? $_POST['remendo_secao'] : null;
    
    $substituicao = isset($_POST['substituicao']) ? $_POST['substituicao'] : null;
    $substituicao_painel = isset($_POST['substituicao_painel']) ? $_POST['substituicao_painel'] : null;
    $substituicao_secao = isset($_POST['substituicao_secao']) ? $_POST['substituicao_secao'] : null;

    $recostura = isset($_POST['recostura']) ? $_POST['recostura'] : null;
    $recostura_painel = isset($_POST['recostura_painel']) ? $_POST['recostura_painel'] : null;
    $recostura_secao = isset($_POST['recostura_secao']) ? $_POST['recostura_secao'] : null;
    
    $troca_linha = isset($_POST['troca_linha']) ? $_POST['troca_linha'] : null;
    $troca_linha_numero = isset($_POST['troca_linha_numero']) ? $_POST['troca_linha_numero'] : null;

    // Verificar se todos os campos obrigatórios foram preenchidos
    if (empty($tipo_pqd) || empty($data_fabricacao) || empty($numero_velame) || empty($numero_involucro) || empty($inspecionado_por) || empty($data_inspecao)) {
        header("Location: inspecao_inicial.php?status=erro&message=" . urlencode("Por favor, preencha todos os campos obrigatórios."));
        exit();
    }

    // Preparar a consulta SQL para inserir os dados
    $sql = "INSERT INTO inspecao_inicial (tipo_pqd, data_fabricacao, numero_velame, numero_involucro, inspecionado_por, data_inspecao, observacoes, remendo, remendo_painel, remendo_secao, substituicao, substituicao_painel, substituicao_secao, recostura, recostura_painel, recostura_secao, troca_linha, troca_linha_numero) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar a instrução SQL com segurança contra SQL Injection
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erro na preparação da consulta SQL: " . $conn->error);
    }

    // Vincular os parâmetros
    $stmt->bind_param("ssssssssssssssssss", $tipo_pqd, $data_fabricacao, $numero_velame, $numero_involucro, $inspecionado_por, $data_inspecao, $observacoes, $remendo, $remendo_painel, $remendo_secao, $substituicao, $substituicao_painel, $substituicao_secao, $recostura, $recostura_painel, $recostura_secao, $troca_linha, $troca_linha_numero);

    // Executar a consulta
    if ($stmt->execute()) {
        header("Location: inspecao_inicial.php?status=sucesso");
    } else {
        $error_message = urlencode("Erro ao realizar o cadastro: " . $stmt->error);
        header("Location: inspecao_inicial.php?status=erro&message=$error_message");
    }

    // Fechar a declaração
    $stmt->close();
}

// Fechar a conexão
$conn->close();
?>
