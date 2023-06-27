<?php
// Configurações de conexão com banco de dados
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'cadastrocarteira';

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $database);

// Verifica se houve algum erro na conexão
if ($conn->connect_error) {
    die('Erro de conexão: ' . $conn->connect_error);
}

// Verifica se o formulário de envio foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $id_vacina = isset($_POST["id_vacina"]) ? $_POST["id_vacina"] : null;
    $ultima_vacina = $_POST['ultima_vacina'];
    $proxima_vacina = $_POST['proxima_vacina'];
    $nome_vacina = $_POST['nome_vacina'];
    $nome_vacinante = $_POST['nome_vacinante'];

    // Atualiza os dados na tabela "vacina_pessoa"
    $sql = "UPDATE vacina_pessoa SET ultima_vacina='$ultima_vacina', proxima_vacina='$proxima_vacina',
            nome_vacina='$nome_vacina', nome_vacinante='$nome_vacinante' WHERE id_vacina='$id_vacina'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Vacina atualizada com sucesso!');
            window.location.href = '../page/vacinas.php';
        </script>";
    } else {
        echo "<script>
            alert('Erro ao atualizar vacina!');
            window.location.href = '../page/vacinas.php';
        </script>";
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
