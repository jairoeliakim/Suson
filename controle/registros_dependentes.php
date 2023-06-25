<?php
//Configurações de conexão com banco de dados
require_once '../modelo/conexao.php';
require_once('../page/log.php');

// Usar a variável $id_pessoa


// Conexão com o banco de dados
// Verifica se houve algum erro na conexão

// Obter os valores do formulário
var_dump($_POST["id_pessoa"]);
$id_pessoa = isset($_POST["id_pessoa"]) ? $_POST["id_pessoa"] : null;
$nome_dependente = isset($_POST["nome_dependente"]) ? $_POST["nome_dependente"] : null;
$data_nascimento = isset($_POST["data_nascimento"]) ? $_POST["data_nascimento"] : null;
$parentesco = isset($_POST["parentesco"]) ? $_POST["parentesco"] : null;

// Validar e sanitizar os dados de entrada
if ($id_pessoa !== null) {
    $id_pessoa = mysqli_real_escape_string($conn, $id_pessoa);
}
if ($nome_dependente !== null) {
    $nome_dependente = mysqli_real_escape_string($conn, $nome_dependente);
    $nome_dependente = substr($nome_dependente, 0, 50); // Limitar o nome a 50 caracteres
}
if ($data_nascimento !== null) {
    $data_nascimento = strtotime($data_nascimento);
    if ($data_nascimento === false) {
        die("Data de nascimento inválida!");
    }
    $data_nascimento = date("Y-m-d", $data_nascimento);
}
if ($parentesco !== null) {
    $parentesco = mysqli_real_escape_string($conn, $parentesco);
}//

// Inserir os valores na tabela de dependentes usando declarações preparadas
$stmt = mysqli_prepare($conn, "INSERT INTO dependentes(id_pessoa, nome_dependente, data_nascimento, parentesco) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssss", $id_pessoa, $nome_dependente, $data_nascimento, $parentesco);
if (mysqli_stmt_execute($stmt)) {
  echo "<script>
  alert('Registrado  com sucesso!');
  window.location.href = '../page/dependentes.php';
</script>";
} else {
  echo "<script>
  alert('Erro ao cadastrar : " . $conn->error . "');
  window.location.href = '../page/dependentes.php';
</script>";
}

?>
<!--

  // inclui o arquivo de conexão
  require_once '../modelo/conexao.php';

  // verifica se o formulário foi enviado
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // obtém os dados do formulário
    $nome_dependente = $_POST['nome_dependente'];
    $data_nascimento = $_POST['data_nascimento'];
    $parentesco = $_POST['parentesco'];
    
    // verifica se o usuário está logado
    session_start();
    if (isset($_SESSION["id_pessoa"])) {
      $id_pessoa = $_SESSION["id_pessoa"];
      
      // prepara a instrução SQL para inserir os dados do dependente
      $stmt = $conn->prepare("INSERT INTO dependentes (id_pessoa, nome_dependente, data_nascimento, parentesco) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("isss", $id_pessoa, $nome_dependente, $data_nascimento, $parentesco);
      
      // executa a instrução SQL e verifica se foi bem sucedida
      if ($stmt->execute()) {
        echo "Dependente cadastrado com sucesso!";
        header("Location: ../controle/registros_dependentes.php");

        header("Location: ../page/dependentes.php");
      } else {
        echo "Ocorreu um erro ao cadastrar o dependente.";
      }
     
      
      // fecha a instrução SQL e a conexão com o banco de dados
      
    }
  }
?>
*/-->
