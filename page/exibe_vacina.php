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
</head>
<style>
    .inf-label {
        color: red;
        font-size: smaller;
    }
</style>

<body>
    <div class="container text-center">
        <?php
        // verifica se o usuário está logado
        if (isset($_SESSION['id_pessoa'])) {
            $id_pessoa = $_SESSION['id_pessoa'];
            require_once '../modelo/conexao.php';
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Falha na conexão: " . $conn->connect_error);
            }

            // Obter os nomes dos vacinantes disponíveis
            $stmt_vacinantes = $conn->prepare("SELECT DISTINCT nome_vacinante FROM vacina_pessoa");
            $stmt_vacinantes->execute();
            $result_vacinantes = $stmt_vacinantes->get_result();
            $nomes_vacinantes = [];
            while ($row_vacinante = $result_vacinantes->fetch_assoc()) {
                $nomes_vacinantes[] = $row_vacinante['nome_vacinante'];
            }

            // para buscar pelo nome do vacinante
            if (isset($_POST['nome_vacinante'])) {
                $nome_vacinante = $_POST['nome_vacinante'];
                $stmt = $conn->prepare("SELECT vacina_pessoa.id_vacina, cadastrar_pessoa.nome, vacina_pessoa.proxima_vacina, 
                            vacina_pessoa.nome_vacina, nome_vacinante, vacina_pessoa.ultima_vacina
                        FROM vacina_pessoa
                        JOIN cadastrar_pessoa ON vacina_pessoa.id_pessoa = cadastrar_pessoa.id_pessoa
                        WHERE cadastrar_pessoa.id_pessoa = ?  AND vacina_pessoa.nome_vacinante = ?
                        ORDER BY vacina_pessoa.proxima_vacina");
                $stmt->bind_param("is", $id_pessoa, $nome_vacinante);
            } else {
                $stmt = $conn->prepare("SELECT vacina_pessoa.id_vacina, cadastrar_pessoa.nome, vacina_pessoa.proxima_vacina, 
                            vacina_pessoa.nome_vacina, nome_vacinante, vacina_pessoa.ultima_vacina
                        FROM vacina_pessoa
                        JOIN cadastrar_pessoa ON vacina_pessoa.id_pessoa = cadastrar_pessoa.id_pessoa
                        WHERE cadastrar_pessoa.id_pessoa = ? 
                        ORDER BY vacina_pessoa.proxima_vacina");
                $stmt->bind_param("i", $id_pessoa);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            // para buscar pelo nome do vacinante
            echo "<form method='POST' action=''>";
            echo "<div class='form-group'>";
            echo "<label for='nome_vacinante'>Buscar pelo nome do vacinante:</label>";
            echo "<select class='form-control' id='nome_vacinante' name='nome_vacinante'>";
            echo "<option value=''>Selecione o vacinante</option>";
            foreach ($nomes_vacinantes as $nome) {
                echo "<option value='" . $nome . "'>" . $nome . "</option>";
            }
            echo "</select>";
            echo "</div>";
            echo "<button type='submit' class='btn btn-primary'>Buscar</button>";
            

            if ($result->num_rows > 0) {
                echo "<table class='table table-striped mx-auto'>";
                echo "<thead><tr><th>Ultima Vacina</th><th>Próxima Vacina</th><th>Nome Vacina</th><th>Nome de vacinante</th></tr></thead>";
                echo "<tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    if (empty($row["ultima_vacina"])) {
                        echo "<td>Dose única</td>";
                    } else {
                        $formattedDate = date("d-m-Y", strtotime($row["ultima_vacina"]));
                        echo "<td>" . $formattedDate . "</td>";
                    }
                    if (empty($row["proxima_vacina"])) {
                        echo "<td>Dose única</td>";
                    } else {
                        $formattedDate = date("d-m-Y", strtotime($row["proxima_vacina"]));
                        echo "<td>" . $formattedDate . "</td>";
                    }
                    echo "<td>" . $row["nome_vacina"] . "</td>";
                    echo "<td>" . $row["nome_vacinante"] . "</td>";
                    //echo "<td><button class='btn btn-warning btn-transparent text-white' title='Editar Registro?' onclick='editarVacina(" . $row["id_vacina"] . ")'>Editar Vacina</button></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>Nenhuma vacina registrada.</p>";
            }
        } else {
            echo "<p>Você precisa estar logado para visualizar as vacinas.</p>";
        }
        echo "</form>";
        ?>

    </div>

    <script>
    function editarVacina(idVacina) {
        if (confirm("Tem certeza que deseja Editar  esta vacina?")) {
            window.location.href = "../controle/alterar_registro.php?id_vacina=" + idVacina;
        }
    }
</script>

<script>
    $(document).ready(function() {
        var proximaVacina = "<?php echo $row['proxima_vacina']; ?>";
        var dataVacina = new Date(proximaVacina);
        var diffMilissegundos = dataVacina - new Date();
        var diffDias = Math.floor(diffMilissegundos / (1000 * 60 * 60 * 24));
        if (diffDias === 1) {
            alert("Atenção! Sua próxima vacinação está agendada para amanhã.");
        }
    });
</script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 