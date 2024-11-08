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

// Verificar se o ID foi enviado
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Excluir o registro do banco de dados
    $sql = "DELETE FROM inspecao_inicial WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Paraquedas excluído com sucesso.";
    } else {
        echo "Erro ao excluir o paraquedas: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID não fornecido para exclusão.";
}

$conn->close();

// Redirecionar para a página de inspeção final
header("Location: inspecao_final.php");
exit();
?>
