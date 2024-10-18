<?php
// Verifica se há um parâmetro de status na URL e exibe o alerta
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'sucesso') {
        echo "<script>alert('Data de saída atualizada com sucesso!');</script>";
    } else if ($_GET['status'] == 'erro' && isset($_GET['message'])) {
        $error_message = urldecode($_GET['message']);
        echo "<script>alert('$error_message');</script>";
    }
}

// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'login_system';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Buscar todos os paraquedas que já passaram pela inspeção final (ou seja, com data de saída preenchida)
$sql = "SELECT id, tipo_pqd, numero_velame, numero_involucro, data_inspecao, data_saida FROM inspecao_inicial WHERE data_saida IS NOT NULL";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paraquedas Manutenido</title>
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
        input[type="submit"] {
            padding: 8px 12px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Paraquedas Manutenido</h1>
    <p>Aqui você pode ver todos os paraquedas que já passaram por todas as inspeções.</p>

    <table>
        <tr>
            <th>Tipo de PQD</th>
            <th>Número do Velame</th>
            <th>Número do Invólucro</th>
            <th>Data de Inspeção Inicial</th>
            <th>Data de Saída</th>
            <th>Visualizar Detalhes</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['tipo_pqd'] . "</td>";
                echo "<td>" . $row['numero_velame'] . "</td>";
                echo "<td>" . $row['numero_involucro'] . "</td>";
                echo "<td>" . $row['data_inspecao'] . "</td>";
                echo "<td>" . $row['data_saida'] . "</td>";
                echo "<td>
                        <form action='ver_detalhes.php' method='get'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='submit' value='Ver Detalhes'>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum paraquedas manutenido encontrado.</td></tr>";
        }
        ?>
    </table>

    <a href="dashboard.php" class="button">Voltar para o Dashboard</a>

</body>
</html>

<?php
$conn->close();
?>
