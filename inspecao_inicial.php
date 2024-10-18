<?php
// Verifica se há um parâmetro de status na URL e exibe o alerta
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'sucesso') {
        echo "<script>alert('Cadastro de inspeção realizado com sucesso!');</script>";
    } else if ($_GET['status'] == 'erro' && isset($_GET['message'])) {
        $error_message = urldecode($_GET['message']);
        echo "<script>alert('$error_message');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspeção Inicial</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0e0e0;
            padding: 20px;
        }

        h1, p {
            font-family: 'Arial Black', sans-serif;
            color: #000;
        }

        form {
            margin: 20px auto;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="text"], input[type="number"], input[type="date"], textarea {
            width: 100%;
            padding: 6px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .checkbox-group {
            margin: 10px 0;
        }

        .button {
            display: inline-block;
            padding: 12px 25px;
            margin-top: 20px;
            font-size: 16px;
            color: #000;
            background-color: #ffeb3b;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .button:hover {
            background-color: #fdd835;
        }

        /* Customização dos campos dinâmicos */
        .hidden-fields {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Inspeção Inicial</h1>
    <p>Aqui você pode realizar a inspeção inicial dos paraquedas.</p>

    <form action="process_inspection.php" method="post">
        <label>Tipo de PQD:</label>
        <div class="checkbox-group">
            <label><input type="checkbox" name="tipo_pqd[]" value="T10-B"> T10-B</label>
            <label><input type="checkbox" name="tipo_pqd[]" value="T10-R"> T10-R</label>
            <label><input type="checkbox" name="tipo_pqd[]" value="MC1-1C"> MC1-1C</label>
        </div>

        <label>Data de Fabricação:</label>
        <input type="number" name="data_fabricacao" placeholder="Digite o ano (ex: 02/2024)" required>

        <label>Número do Velame:</label>
        <input type="number" name="numero_velame" placeholder="Digite o número do velame" required>

        <label>Número do Invólucro:</label>
        <input type="number" name="numero_involucro" placeholder="Digite o número do invólucro" required>

        <label>Inspecionado por (Aux N):</label>
        <input type="number" name="inspecionado_por" placeholder="Digite o N Aux." required>

        <label>Data da Inspeção:</label>
        <input type="date" name="data_inspecao" required>

        <label>Observações:</label>
        <textarea name="observacoes" rows="4" placeholder="Digite as observações"></textarea>

        <!-- Opções de marcação (checkbox) -->
        <div class="checkbox-group">
            <!-- Remendo -->
            <label>
                <input type="checkbox" name="remendo" id="remendo_checkbox" onclick="toggleFields('remendo')"> Remendo
            </label>
            <div id="remendo_fields" class="hidden-fields">
                <label for="remendo_painel">Número do painel (1-30):</label>
                <input type="number" id="remendo_painel" name="remendo_painel" min="1" max="30">
                
                <label for="remendo_secao">Número da seção (1-4):</label>
                <input type="number" id="remendo_secao" name="remendo_secao" min="1" max="4">
            </div>

            <!-- Substituição -->
            <label>
                <input type="checkbox" name="substituicao" id="substituicao_checkbox" onclick="toggleFields('substituicao')"> Substituição
            </label>
            <div id="substituicao_fields" class="hidden-fields">
                <label for="substituicao_painel">Número do painel (1-30):</label>
                <input type="number" id="substituicao_painel" name="substituicao_painel" min="1" max="30">
                
                <label for="substituicao_secao">Número da seção (1-4):</label>
                <input type="number" id="substituicao_secao" name="substituicao_secao" min="1" max="4">
            </div>

            <!-- Recostura -->
            <label>
                <input type="checkbox" name="recostura" id="recostura_checkbox" onclick="toggleFields('recostura')"> Recostura
            </label>
            <div id="recostura_fields" class="hidden-fields">
                <label for="recostura_painel">Número do painel (1-30):</label>
                <input type="number" id="recostura_painel" name="recostura_painel" min="1" max="30">
                
                <label for="recostura_secao">Número da seção (1-4):</label>
                <input type="number" id="recostura_secao" name="recostura_secao" min="1" max="4">
            </div>

            <!-- Troca de Linhas -->
            <label>
                <input type="checkbox" name="troca_linha" id="troca_linha_checkbox" onclick="toggleFields('troca_linha')"> Troca de Linhas
            </label>
            <div id="troca_linha_fields" class="hidden-fields">
                <label for="troca_linha_numero">Número da linha (1-30):</label>
                <input type="number" id="troca_linha_numero" name="troca_linha_numero" min="1" max="30">
            </div>
        </div>

        <script>
            function toggleFields(type) {
                var checkbox = document.getElementById(type + '_checkbox');
                var fields = document.getElementById(type + '_fields');
                
                if (checkbox.checked) {
                    fields.style.display = 'block';
                } else {
                    fields.style.display = 'none';
                }
            }
        </script>

        <input type="submit" value="Enviar" class="button">
    </form>

    <a href="dashboard.php" class="button">Voltar para o Dashboard</a>
</body>
</html>
