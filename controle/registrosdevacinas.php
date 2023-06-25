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
    $id_pessoa = isset($_POST["id_pessoa"]) ? $_POST["id_pessoa"] : null;
    $ultima_vacina = $_POST['ultima_vacina'];
    $proxima_vacina = $_POST['proxima_vacina'];
    $nome_vacina = $_POST['nome_vacina'];
    $nome_vacinante = $_POST['nome_vacinante'];

    // Insere os dados na tabela "vacinas"
    $sql = "INSERT INTO vacina_pessoa (ultima_vacina, proxima_vacina, nome_vacina, nome_vacinante,id_pessoa)
            VALUES ('$ultima_vacina', '$proxima_vacina', '$nome_vacina', '$nome_vacinante','$id_pessoa')";

    if ($conn->query($sql) === TRUE) {
       
        echo "<script>
            alert('Vacina registrada com sucesso!');
            window.location.href = '../page/vacinas.php';

           
        </script>";
    } else {
    
        echo "<script>
            alert('Vacina não registrada!');
            window.location.href = '../page/vacinas.php';
        </script>"; 
         $conn->error;

    }
}

// Fecha a conexão com o banco de dados

?>