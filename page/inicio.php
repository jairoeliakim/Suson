<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/reset.css">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  <title>Carteira de Vacinas</title>
</head>

<?php $title = "Inicio";
include 'cabecalho.php';
?>

<body>
  <?php include_once "agenda.php"?>
  <div class="d-flex justify-content-center mt-2">
    <button class="btn btn-success btn-lg btn-md mx-1"title="Exibir vacinas" onclick="window.location.href='./vacinas.php'">
      <i class="fas fa-syringe"></i><br>Vacinas
    </button>

    <button class="btn btn-success btn-lg btn-md mx-1"title="Exibir dependentes" onclick="window.location.href='./dependentes.php'">
      <i class="fas fa-family"></i><br>Dependentes
    </button>

    <button class="btn btn-success btn-lg btn-md mx-1"title="Exibir informações devacinas" onclick="window.location.href='./campanhas.php'">
      <i class="fas fa-info"></i><br>Informativo
    </button>

    <button class="btn btn-success btn-lg btn-md mx-1"title="Alterar dados" onclick="window.location.href='./exibir_usuario.php'">
    <i class="bi bi-gear"></i><br>+ Cadastro
    </button>
  </div>
</body>


<footer>
  <?php 
    include_once "mapa.php";
    require_once("rodape.php");
  ?>
</footer>

</html>
