<!DOCTYPE html>
<html lang="pt-br">

<head>
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
    <title>Registros de Vacinas</title>
</head>
<style>
    .inf-label {
        color: red;
        font-size: smaller;
    }
</style>

<header>
    <?php
    $title = "Registros de Vacinas";
    include 'cabecalho.php';
    ?>
</header>

<body>
    <div class="container text-center">
        <?php
        // verifica se o usuário está logado
        if (isset($_SESSION['id_pessoa'])) {
            $id_pessoa = $_SESSION['id_pessoa'];

            // inclui o arquivo de conexão
            require_once '../modelo/conexao.php';

            // cria a conexão com o banco de dados
            $conn = new mysqli($servername, $username, $password, $dbname);

            // verifica se há erros na conexão
            if ($conn->connect_error) {
                die("Falha na conexão: " . $conn->connect_error);
            }

            // selecionar os dados das vacinas do usuário logado
            $stmt = $conn->prepare("SELECT vacina_pessoa.id_vacina, cadastrar_pessoa.nome, vacina_pessoa.proxima_vacina, 
                            vacina_pessoa.nome_vacina, nome_vacinante
                        FROM vacina_pessoa
                        JOIN cadastrar_pessoa ON vacina_pessoa.id_pessoa = cadastrar_pessoa.id_pessoa
                        WHERE cadastrar_pessoa.id_pessoa = ? AND vacina_pessoa.proxima_vacina > CURDATE()
                        ORDER BY vacina_pessoa.proxima_vacina");
            $stmt->bind_param("i", $id_pessoa);

            // executa a instrução SQL e obtém o resultado
            $stmt->execute();
            $result = $stmt->get_result();
            
             

            // verifica se há linhas de resultado
            if ($result->num_rows > 0) {
                // Exibe os dados das vacinas do usuário logado
                echo "<table class='table table-striped mx-auto'>";
                echo "<thead><tr><th>Próxima Vacina</th><th>Nome Vacina</th><th>Nome de vacinante</th><th>Ação</th></tr></thead>";
                echo "<tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    if (empty($row["proxima_vacina"])) {
                        echo "<td>Não informado</td>";
                    } else {
                        $formattedDate = date("d-m-Y", strtotime($row["proxima_vacina"]));
                        echo "<td>" . $formattedDate . "</td>";
                    }
                    echo "<td>" . $row["nome_vacina"] . "</td>";
                    echo "<td>" . $row["nome_vacinante"] . "</td>";
                    echo "<td><button class='btn btn-danger'title='Excluir Vacina?' onclick='excluirVacina(" . $row["id_vacina"] . ")'>Excluir Vacina</button></td>";
                    echo "</tr>";

                  
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>Nenhuma vacina registrada.</p>";
            }
            

        } else {
            // exibe mensagem caso o usuário não esteja logado
            echo "<p>Você precisa estar logado para visualizar as vacinas.</p>";
        }
        
        ?>

          <div class="mb-3 form-check">
            <button type="button" class="btn btn-success" id="toggleForm">Deseja Registrar uma nova vacina?</button>
        </div>


        <form class="" action="../controle/registrosdevacinas.php" method="POST">


        <div class="newvacina" style="display: none;">
                <h3>Registrando uma nova vacina</h3>
                <!--Adicionar vacina-->                   
                <div class="mb-3 form-group">
                <input type="hidden" name="id_pessoa" value="<?php echo $id_pessoa; ?>">               
                    <label for="nome_vacina" class="form-label" required>Nome da vacina:</label>
                    <select id="nome_vacina" name="nome_vacina" class="form-select">
                        <option value="">Selecione uma opção</option>
                        <option value="vacina1">Hepatite A</option>
                        <option value="vacina2">Hepatite B</option>
                        <option value="vacina3">Triplice Viral (Vacina contra o sarampo, caxumba e rubéola) </option>
                        <option value="vacina4">Varicela (Vacina contra a catapora)</option>
                        <option value="vacina5">Poliomielite (Vacina contra a paralisia infantil)</option>
                        <option value="vacina6">Febre amarela</option>
                        <option value="vacina7">HPV (Vacina contra o papilomavírus humano)</option>
                        <option value="vacina8">Pneumocócica (Vacina contra a pneumonia)</option>
                        <option value="vacina9">DT - (Vacina contra o tétano e a difteria)</option>
                        <option value="vacina10">Meningocócica (Vacina contra a meningite)</option>
                        <option value="vacina11">Pneumocócica 23 Valente</option>
                        <option value="vacina12">Gripe (influenza)cócica C</option>
                        <option value="vacina13">dTPa (Tríplice bacteriana acelular do tipo adulto)</option>
                        <option value="vacina14">Pfizer-BioNTech COVID-19 Vaccine</option>
                        <option value="vacina15">Moderna COVID-19 Vaccine</option>
                        <option value="vacina16">Johnson & Johnson's Janssen COVID-19 Vaccine</option>
                        <option value="vacina17">Oxford-AstraZeneca COVID-19 Vaccine</option>
                        <option value="vacina18">Sinovac COVID-19 Vaccine</option>
                        <option value="vacina19">Sinopharm COVID-19 Vaccine</option>
                        <option value="vacina20">Sputnik V COVID-19 Vaccine</option>
                        <!-- Adionar mais vacinas se necessário -->
                        <option value="outra">Outra</option>
                    </select>
                </div>
                <div id="outra_vacina" style="display: none;" class="mb-3 form-group">
                    <label for="nova_vacina" class="form-label">Nova vacina:</label>
                    <input type="text" id="nova_vacina" name="nova_vacina" class="form-control">
                </div>
                <div class="mb-3 form-group">
                    <label for="local" class="form-label">UBS:</label>
                    <input type="text" id="local" name="local" class="form-control" required>
                </div>

                <div class="mb-3 form-group">
                    <label for="ultima_vacina" class="form-label">Data de vacinação:</label>
                    <label for="Inf" class="inf-label">Se ainda não tiver tomada 1ª dose, deixar campo vazio.</label>
                    <input type="date" id="ultima_vacina" name="ultima_vacina" class="form-control">
                </div>

                <div class="mb-3 form-group">
                    <label for="proxima_vacina" class="form-label">Próxima dose:</label>
                    <input type="date" id="proxima_vacina" name="proxima_vacina" class="form-control" required>
                </div>
                
                

                <?php              
                           
                  
                   // Verificar se há dependentes associados ao usuário logado
                $pessoa_dependente = $conn->prepare("SELECT cp.nome, dp.nome_dependente, dp.parentesco 
                    FROM cadastrar_pessoa cp
                    JOIN dependentes dp ON dp.id_pessoa = cp.id_pessoa
                    WHERE cp.id_pessoa = ?");
                    $pessoa_dependente->bind_param("i", $id_pessoa);
                    $pessoa_dependente->execute();
                    $result_dependentes = $pessoa_dependente->get_result();

                    // Array para armazenar os dependentes
                    $dependentes = array();

                    while ($row = $result_dependentes->fetch_assoc()) {
                    $nome_dependente = $row['nome_dependente'];
                    $dependentes[] = $nome_dependente;
                    }
                    $possui_dependentes = (count($dependentes) > 0);

                    $nome_pessoa = ""; // Declaração da variável $nome_pessoa

                    echo "<label for='nome_vacinante'>Buscar pelo nome do vacinante:</label>";
                    echo "<select class='form-control' id='nome_vacinante' name='nome_vacinante'>";
                    echo "<option value=''>Selecione o vacinante</option>";
                    foreach ($dependentes as $dependente) {
                    echo "<option value='" . $dependente . "'>" . $dependente . "</option>";
                    }
                    echo "</select>";

                    if (isset($_SESSION["nome"])) {
                    $nome = $_SESSION["nome"];
                    $nome_pessoa = $nome; // Atribuir o valor de $nome a $nome_pessoa
                    }
                    ?>

                    <!-- Se houver dependentes, exibir o campo de seleção -->
                    <div class="mb-3 form-group">
                    <?php
                    if ($possui_dependentes) {
                        echo "<select id='nome_vacinante' name='nome_vacinante' class='form-select'>";
                        echo "<option value=''>Selecione uma opção</option>";
                        foreach ($dependentes as $dependente) {
                            echo "<option value='$dependente'>$dependente</option>";
                        }
                        echo "</select>";
                    } else {
                        echo "<input type='text' id='nome_vacinante' name='nome_vacinante' value='" . (!empty($nome_pessoa) ? $nome_pessoa : "&nome") . "' readonly>";
                    }
                    ?>
                    
       </div>
                
                
                <input type="submit" value="Registrar vacina" class="btn btn-success">


                </div>

            </div>
            <?php
             // Verifica se o formulário de envio foi submetido
             if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Recebe o valor selecionado do formulário
                $nome_vacina = $_POST['nome_vacina'];

                // Verifica se o valor foi selecionado
                if (!empty($nome_vacina)) {
                    // O valor da vacina foi selecionado, você pode usá-lo como desejado
                    echo "Nome da vacina selecionada: " . $nome_vacina;
                } else {
                    // Nenhum valor de vacina foi selecionado
                    echo "Por favor, selecione uma vacina.";
                }
            }
            ?>
        </form>          


    </div>

    <script>
    function excluirVacina(idVacina) {
        // Exibe uma caixa de diálogo de confirmação
        if (confirm("Tem certeza que deseja excluir esta vacina?")) {
            // Redirecionar para o arquivo excluir_vacina.php com o ID da vacina selecionada
            window.location.href = "../controle/excluirvacinas.php?id_vacina=" + idVacina;
        }
    }

    $(document).ready(function() {
    $("#toggleForm").click(function() {
        $(".newvacina").toggle();
    });
});


</script>

<script>
    // Função para validar a data de vacinação
    function validarDataVacina() {
        var ultimaVacina = document.getElementById("ultima_vacina").value;
        var proximaVacina = document.getElementById("proxima_vacina").value;

        if (ultimaVacina !== "" && proximaVacina !== "" && ultimaVacina > proximaVacina) {
            alert("A próxima vacina não pode ser menor que a última vacina.");
            return false;
        }

        return true;
    }

    // Adicione a função de validação ao formulário
    document.querySelector("form").addEventListener("submit", function(event) {
        if (!validarDataVacina()) {
            event.preventDefault();
        }
    });
</script>

</body>

</html>