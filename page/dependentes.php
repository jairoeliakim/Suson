<!DOCTYPE html>
<html lang="pt-br">
<head>
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

    <title>Registros de dependentes</title>
</head>
<header>
    <?php
    $title = "Registros de dependentes";
    include 'cabecalho.php';
    ?>
</header>
<body >
<?php
        // verifica se o usuário está logado
        if (isset($_SESSION["id_pessoa"])) {
            // obtém o ID do usuário da variável de sessão
            $id_pessoa = $_SESSION["id_pessoa"];
       

            // inclui o arquivo de conexão
            require_once '../modelo/conexao.php';

            // prepara a instrução SQL para selecionar os dados das vacinas do usuário logado
            $dependentes = $conn->prepare("SELECT cp.nome, dp.nome_dependente, dp.parentesco 
            FROM cadastrar_pessoa cp
            JOIN dependentes dp ON dp.id_pessoa = cp.id_pessoa
            WHERE cp.id_pessoa =  ?");
            $dependentes->bind_param("i", $id_pessoa);

            

            // executa a instrução SQL e obtém o resultado
            $dependentes->execute();
           

            $result = $dependentes->get_result();

            // exibe os dados do dependente 
            if ($result->num_rows > 0) {
                echo '<table class="table">';
                echo '<thead><tr><th>Usuário</th><th>Nome do dependente</th><th>Parentesco</th></tr></thead>';
                echo '<tbody>';
              
                while ($row = $result->fetch_assoc()) {
                  if (!empty($row["nome_dependente"])) {
                    echo "<tr><td>" . $row["nome"] . "</td><td>" . $row["nome_dependente"] . "</td><td>" . $row["parentesco"] . "</td></tr>";
                  }
                }
              
                echo '</tbody>';
                echo '</table>';
              } else {
                echo "Nenhum dependente encontrado.";
              }
            // fecha o resultado antes de executar uma nova consulta
            $result->close();
             // fecha a consulta
              $dependentes->close();
        }
        ?>
        
    
    <form action="../controle/registros_dependentes.php" method="POST">
        
        <button type="button" class="btn btn-success" id="toggleFormButton" title='Se desejas registrar um novo dependente, clique aqui!'>Registrar novo dependente?</button>
       
        
        <br><br>
        
        <div > 
        <div id="formdependentes" style="display: none;">
        
        <p>Você esta registrando um novo dependente</p>
        <p>Para concluir, preencha os dados abaixo:</p>

        <input type="hidden" name="id_pessoa" value="<?php echo $id_pessoa; ?>">


        <label for="nome_dependente">Nome do dependente:</label>
        <input type="text" name="nome_dependente" required>

        <label for="data_nascimento">Data Nascimento:</label>
        <input type="date" name="data_nascimento" required>

        <label for="parentesco">Selecione sua relação:</label>
        <select name="parentesco" id="parentesco">
            <option value="filho(a)">Filho(a)</option>
            <option value="pai">Pai</option>
            <option value="mae">Mãe</option>
            <option value="avo">Avó</option>
            <option value="avo">Avô</option>
            <option value="outro">Outro</option>
        </select>

        <input type="submit"  class="btn btn-success" value="Salvar ">
    </div>

        </div>
    </form>
    
    <script>
        $(document).ready(function() {
            $('#toggleFormButton').click(function() {
                $('#formdependentes').toggle();
            });
        });
    </script>

</body>

<?php require_once("rodape.php")?>
</html>