<?php
$servername = "localhost"; // nome do servidor MySQL
$username = "root"; // nome de usuário do MySQL
$password = ""; // senha do MySQL
$dbname = "cadastrocarteira"; // nome do banco de dados
$email = 'email';

// cria uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// verifica se houve algum erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
