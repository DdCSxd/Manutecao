<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dinâmico</title>
    <link rel="stylesheet" href="dashboard.css">  
</head>
<body>

    

    <!-- Conteúdo de boas-vindas -->
    <div class="content">
        <h1>Manutenção</h1>
        <p>principal elo da engrenagem da atividade paraquedista.</p>
    </div>
    
    <!-- Barra lateral com os botões -->
    <div class="button-container">
        <a href="inspecao_inicial.php" class="button">Inspeção Inicial</a>
        <a href="inspecao_final.php" class="button">Inspeção Final</a>
        <a href="paraquedas_manutencao.php" class="button">Paraquedas em Manutenção</a>
        <a href="paraquedas_manutenidos.php" class="button">Paraquedas Manutenido</a>
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
