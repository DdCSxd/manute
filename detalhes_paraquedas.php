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

// Verificar se o ID foi passado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar as informações detalhadas do paraquedas pelo ID
    $sql = "SELECT * FROM inspecao_inicial WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $paraquedas = $result->fetch_assoc();
    } else {
        die("Paraquedas não encontrado.");
    }
} else {
    die("ID do paraquedas não especificado.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Paraquedas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .button {
            padding: 8px 16px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            border: none;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Detalhes do Paraquedas</h1>

    <table>
        <tr>
            <th>Tipo de PQD</th>
            <td><?php echo $paraquedas['tipo_pqd']; ?></td>
        </tr>
        <tr>
            <th>Número do Velame</th>
            <td><?php echo $paraquedas['numero_velame']; ?></td>
        </tr>
        <tr>
            <th>Número do Invólucro</th>
            <td><?php echo $paraquedas['numero_involucro']; ?></td>
        </tr>
        <tr>
            <th>Data de Fabricação</th>
            <td><?php echo $paraquedas['data_fabricacao']; ?></td>
        </tr>
        <tr>
            <th>Inspecionado por</th>
            <td><?php echo $paraquedas['inspecionado_por']; ?></td>
        </tr>
        <tr>
            <th>Data de Inspeção</th>
            <td><?php echo $paraquedas['data_inspecao']; ?></td>
        </tr>
        <tr>
            <th>Observações</th>
            <td><?php echo $paraquedas['observacoes']; ?></td>
        </tr>

        <!-- Exibir detalhes de Remendo -->
        <tr>
            <th>Remendo</th>
            <td><?php echo ($paraquedas['remendo'] === 'sim') ? 'Sim' : 'Não'; ?></td>
        </tr>
        <?php if ($paraquedas['remendo'] === 'sim') : ?>
        <tr>
            <th>Painel do Remendo</th>
            <td><?php echo $paraquedas['remendo_painel']; ?></td>
        </tr>
        <tr>
            <th>Seção do Remendo</th>
            <td><?php echo $paraquedas['remendo_secao']; ?></td>
        </tr>
        <?php endif; ?>

        <!-- Exibir detalhes de Substituição -->
        <tr>
            <th>Substituição</th>
            <td><?php echo ($paraquedas['substituicao'] === 'sim') ? 'Sim' : 'Não'; ?></td>
        </tr>
        <?php if ($paraquedas['substituicao'] === 'sim') : ?>
        <tr>
            <th>Painel da Substituição</th>
            <td><?php echo $paraquedas['substituicao_painel']; ?></td>
        </tr>
        <tr>
            <th>Seção da Substituição</th>
            <td><?php echo $paraquedas['substituicao_secao']; ?></td>
        </tr>
        <?php endif; ?>

        <!-- Exibir detalhes de Recostura -->
        <tr>
            <th>Recostura</th>
            <td><?php echo ($paraquedas['recostura'] === 'sim') ? 'Sim' : 'Não'; ?></td>
        </tr>
        <?php if ($paraquedas['recostura'] === 'sim') : ?>
        <tr>
            <th>Painel da Recostura</th>
            <td><?php echo $paraquedas['recostura_painel']; ?></td>
        </tr>
        <tr>
            <th>Seção da Recostura</th>
            <td><?php echo $paraquedas['recostura_secao']; ?></td>
        </tr>
        <?php endif; ?>

        <!-- Exibir detalhes de Troca de Linha -->
        <tr>
            <th>Troca de Linha</th>
            <td><?php echo ($paraquedas['troca_linha'] === 'sim') ? 'Sim' : 'Não'; ?></td>
        </tr>
        <?php if ($paraquedas['troca_linha'] === 'sim') : ?>
        <tr>
            <th>Número da Linha Trocada</th>
            <td><?php echo $paraquedas['troca_linha_numero']; ?></td>
        </tr>
        <?php endif; ?>
    </table>

    <a href="paraquedas_manutencao.php" class="button">Voltar para a Lista de Manutenção</a>

</body>
</html>

<?php
$conn->close();
?>
