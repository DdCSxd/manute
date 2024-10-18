<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dinâmico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            height: 100vh; /* Faz com que a página ocupe toda a altura da janela */
        }

        /* Barra lateral fixa à esquerda */
        .sidebar {
            background-color: #f0f0f0;
            width: 250px;
            padding: 20px;
            border-right: 2px solid #ccc;
            height: 100vh; /* Altura total da tela */
            position: fixed; /* Barra lateral fixa */
        }

        .sidebar .button {
            display: block;
            padding: 15px 25px;
            margin: 15px 0;
            font-size: 18px;
            color: #000;
            background-color: #ffeb3b;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }

        .sidebar .button:hover {
            background-color: #fdd835;
        }

        /* Área de conteúdo que será alterada */
        .content {
            margin-left: 270px; /* Margem para a área de conteúdo não ficar atrás da barra lateral */
            padding: 20px;
            width: calc(100% - 270px); /* O conteúdo ocupa o resto da tela */
            background-color: #e0e0e0; /* Fundo da área de conteúdo */
        }

        h1 {
            font-family: 'Arial Black', sans-serif;
            font-size: 36px;
            color: #000;
        }

        p {
            font-family: 'Arial Black', sans-serif;
            font-size: 24px;
            color: #000;
        }
    </style>
</head>
<body>

    <!-- Barra lateral com os botões -->
    <div class="sidebar">
        <a href="#" class="button" onclick="loadPage('inspecao_inicial.php')">Inspeção Inicial</a>
        <a href="#" class="button" onclick="loadPage('inspecao_final.php')">Inspeção Final</a>
        <a href="#" class="button" onclick="loadPage('paraquedas_manutencao.php')">Paraquedas em Manutenção</a>
        <a href="#" class="button" onclick="loadPage('paraquedas_manutenidos.php')">Paraquedas Manutenido</a>
    </div>

    <!-- Área de conteúdo que será modificada -->
    <div class="content" id="content">
        <h1>Bem-vindo ao Dashboard</h1>
        <p>Clique em uma das opções ao lado para visualizar os detalhes.</p>
    </div>

    <script>
        // Função para carregar a página dinamicamente na área de conteúdo
        function loadPage(page) {
            fetch(page)
            .then(response => response.text())
            .then(data => {
                document.getElementById('content').innerHTML = data;
            })
            .catch(error => {
                console.error('Erro ao carregar a página:', error);
            });
        }
    </script>

</body>
</html>
