<?php
// inclui o arquivo de conexão
require_once '../modelo/conexao.php';

// Verifica se o ID da vacina foi passado na URL
if (isset($_GET['id_vacina'])) {
    // Obtém o ID da vacina a partir do parâmetro na URL
    $idVacina = $_GET['id_vacina'];

    // Deleta o registro da tabela "vacina_pessoa"
    $sql = "DELETE FROM vacina_pessoa WHERE id_vacina = '$idVacina'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Vacina excluída com sucesso!');
            window.location.href = '../page/vacinas.php';
        </script>";
    } else {
        echo "<script>
            alert('Erro ao excluir vacina: " . $conn->error . "');
            window.location.href = '../page/vacinas.php';
        </script>";
    }
} else {
    // Redireciona de volta para a página inicial se o ID da vacina não foi passado
    header("Location: ../page/vacinas.php");
    exit();
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
