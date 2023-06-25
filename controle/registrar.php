<?php
//Conectar ao banco de dados
require_once '../modelo/conexao.php';

session_start();

$conexao = new mysqli($servername, $username, $password, $dbname);


// Processar os dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];
$nome  = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$sexo = $_POST['sexo'];
$cep  = $_POST['cep'];


// Inserir os dados no banco de dados
// Criptografar a senha
$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO cadastrar_pessoa (email, senha,nome	,data_nascimento, sexo, cep) VALUES ('$email', '$senha','$nome'	,'$data_nascimento', '$sexo', '$cep' )";
$resultado = mysqli_query($conn, $sql);

if ($resultado) {
  // Registro bem-sucedido, redirecionar para a página de login 
  echo '<script>
  alert("Registro bem-sucedido. Redirecionando a pagina de login);

  var countdown = setInterval(function() {
    count--;
    if (count <= 0) {
      clearInterval(countdown);
      window.location.href = "../index.php";
    }
  }, 1000); // 1000 milissegundos = 1 segundo
</script>';

} else {
  // Registro falhou, exibir mensagem de erro
  echo '<script>alert("Erro ao registrar novo usuário"); window.location.href = "../index.php";</script>';
}

?>