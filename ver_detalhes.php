<?php
// Conectar ao banco de dados
$host = 'localhost';
$dbname = 'login_system';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o ID foi passado corretamente
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Buscar informações detalhadas do paraquedas
    $sql = "SELECT * FROM inspecao_inicial WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Exibir as informações gerais
        echo "Tipo de PQD: " . $row['tipo_pqd'] . "<br>";
        echo "Número do Velame: " . $row['numero_velame'] . "<br>";
        echo "Número do Invólucro: " . $row['numero_involucro'] . "<br>";
        echo "Data de Fabricação: " . $row['data_fabricacao'] . "<br>";
        echo "Inspecionado por: " . $row['inspecionado_por'] . "<br>";
        echo "Data de Inspeção: " . $row['data_inspecao'] . "<br>";
        echo "Observações: " . $row['observacoes'] . "<br>";

        // Exibir as informações de Remendo
        if ($row['remendo'] === 'sim') {
            echo "Remendo: Sim <br>";
            echo "Painel do Remendo: " . $row['remendo_painel'] . "<br>";
            echo "Seção do Remendo: " . $row['remendo_secao'] . "<br>";
        } else {
            echo "Remendo: Não <br>";
        }

        // Exibir as informações de Substituição
        if ($row['substituicao'] === 'sim') {
            echo "Substituição: Sim <br>";
            echo "Painel da Substituição: " . $row['substituicao_painel'] . "<br>";
            echo "Seção da Substituição: " . $row['substituicao_secao'] . "<br>";
        } else {
            echo "Substituição: Não <br>";
        }

        // Exibir as informações de Recostura
        if ($row['recostura'] === 'sim') {
            echo "Recostura: Sim <br>";
            echo "Painel da Recostura: " . $row['recostura_painel'] . "<br>";
            echo "Seção da Recostura: " . $row['recostura_secao'] . "<br>";
        } else {
            echo "Recostura: Não <br>";
        }

        // Exibir as informações de Troca de Linhas
        if ($row['troca_linha'] === 'sim') {
            echo "Troca de Linha: Sim <br>";
            echo "Número da Linha Trocada: " . $row['troca_linha_numero'] . "<br>";
        } else {
            echo "Troca de Linha: Não <br>";
        }

    } else {
        echo "Nenhum detalhe encontrado para esse paraquedas.";
    }
} else {
    echo "ID não fornecido.";
}

$conn->close();
?>
