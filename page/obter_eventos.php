<?php
require_once '../modelo/conexao.php';

// Obtenha os eventos do banco de dados com base no parâmetro id_pessoa
$id_pessoa = $_GET['id_pessoa'];

// Verifica se o parâmetro id_pessoa foi passado na URL
if (isset($_GET['id_pessoa'])) {
  // Obtém o valor do id_pessoa da URL
  $id_pessoa = $_GET['id_pessoa'];

  // Agora você pode usar o $id_pessoa em sua consulta SQL
  $query = "SELECT ultima_vacina, proxima_vacina FROM vacina_pessoa WHERE id_pessoa = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $id_pessoa);
  $stmt->execute();
  $result = $stmt->get_result();

  $events = [];

  while ($row = $result->fetch_assoc()) {
   // $dataValidade = $row['ultima_vacina'];
    $proximaVacina = $row['proxima_vacina'];
    //$events[] = $dataValidade;
    $events[] = $proximaVacina;
  }

  $stmt->close();
}

$conn->close();

// Retorne os eventos como uma resposta JSON
header('Content-Type: application/json');
echo json_encode(['events' => $events]);
?>
