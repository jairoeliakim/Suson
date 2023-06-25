<?php
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

// Criptografar a senha
$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

// Atualizar os dados no banco de dados
$sql = "UPDATE cadastrar_pessoa SET email = '$email', senha = '$senhaCriptografada', nome = '$nome', data_nascimento = '$data_nascimento', sexo = '$sexo', cep = '$cep' WHERE id_pessoa = $_SESSION[id_pessoa]";
$resultado = mysqli_query($conexao, $sql);

if ($resultado) {
  // Atualização bem-sucedida, redirecionar para a página de exibição dos dados
  echo '<script>
  var count = 5; // Tempo em segundos
  alert("Dados atualizados com sucesso. Redirecionando em " + count + " segundos...");

  var countdown = setInterval(function() {
    count--;
    if (count <= 0) {
      clearInterval(countdown);
      window.location.href = "../page/exibir_usuario.php";
    }
  }, 1000); // 1000 milissegundos = 1 segundo
</script>';

} else {
  // Atualização falhou, exibir mensagem de erro
  echo '<script>alert("Erro ao atualizar os dados"); window.location.href = "exibir_dados.php";</script>';
}

?>
