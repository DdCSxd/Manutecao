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

// Buscar todos os paraquedas que já passaram pela inspeção inicial
$sql = "SELECT id, tipo_pqd, numero_velame, numero_involucro, data_inspecao, data_saida FROM inspecao_inicial WHERE status = 0";
$result = $conn->query($sql);

if ($result === false) {
    die("Erro na consulta SQL: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspeção Final</title>
    <link rel="stylesheet" href="inspecao_final.css"> <!-- Link para o CSS externo -->
</head>
<body>
    <h1>Inspeção Final</h1>
    <p>Selecione o paraquedas para alterar a data de saída ou excluí-lo.</p>

    <table>
        <tr>
            <th>Tipo de PQD</th>
            <th>Número do Velame</th>
            <th>Número do Invólucro</th>
            <th>Data de Inspeção Inicial</th>
            <th>Data de Saída</th>
            <th>Alterar Data de Saída</th>
            <th >Excluir</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['tipo_pqd'] . "</td>";
                echo "<td>" . $row['numero_velame'] . "</td>";
                echo "<td>" . $row['numero_involucro'] . "</td>";
                echo "<td>" . $row['data_inspecao'] . "</td>";
                echo "<td>" . ($row['data_saida'] ? $row['data_saida'] : "Não definida") . "</td>";
                echo "<td>
                        <form action='update_saida.php' method='post'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='date' name='data_saida' required>
                            <input type='submit' value='Atualizar'>
                        </form>
                      </td>";
                echo "<td>
                        <form action='delete.php' method='post' onsubmit=\"return confirm('Tem certeza que deseja excluir este paraquedas?');\">
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='submit' value='Excluir' class='delete-button'>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Nenhum paraquedas encontrado.</td></tr>";
        }
        ?>
    </table>

    <a href="dashboard.php" class="button">Voltar para o Dashboard</a>
</body>
</html>

<?php
$conn->close();
?>
