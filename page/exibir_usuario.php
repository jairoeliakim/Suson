


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
    <title>Registro</title>
</head>
<header>
    <?php
    $title = "Cadastrar Usuário";
    include 'cabecalho.php';
    ?>
</header>

<body>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                require_once '../modelo/conexao.php';

                // Verifica se o ID do usuário está definido
                if (isset($_SESSION['id_pessoa'])) {
                    $id_pessoa = $_SESSION['id_pessoa'];

                    // Consulta para obter os dados do usuário
                    $query = "SELECT email, nome, sexo, data_nascimento, cep,senha FROM cadastrar_pessoa WHERE id_pessoa = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $id_pessoa);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Verifica se o usuário foi encontrado
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $email = $row['email'];
                        $nome = $row['nome'];
                        $sexo = $row['sexo'];
                        $senha = $row['senha'];
                        $data_nascimento = $row['data_nascimento'];
                        $cep = $row['cep'];

                        // Verifica se os campos devem ser editáveis ou não
                        $editavel = isset($_GET['editavel']) ? $_GET['editavel'] : false;

                        // Exibe o formulário para edição dos dados do usuário
                        echo '<form action="../controle/alterar_registro.php" method="post">';
                        echo '<div class="card">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">Dados do Usuário</h5>';
                        echo '<p class="card-text"><strong>E-mail:</strong> ' . ($editavel ? '<input type="text" name="email" value="' . $email . '">' : $email) . '</p>';
                        echo '<p class="card-text"><strong>Senha:</strong> ' . ($editavel ? '<input type="password" name="senha" value="' . $senha . '">' : $senha) . '</p>';
                        echo '<p class="card-text"><strong>Nome:</strong> ' . ($editavel ? '<input type="text" name="nome" value="' . $nome . '">' : $nome) . '</p>';
                        echo '<p class="card-text"><strong>Sexo:</strong> ' . ($editavel ? '<input type="text" name="sexo" value="' . $sexo . '">' : $sexo) . '</p>';
                        echo '<p class="card-text"><strong>Data de Nascimento:</strong> ' . ($editavel ? '<input type="text" name="data_nascimento" value="' . $data_nascimento . '">' : $data_nascimento) . '</p>';
                        echo '<p class="card-text"><strong>CEP:</strong> ' . ($editavel ? '<input type="text" name="cep" value="' . $cep . '">' : $cep) . '</p>';
                        echo '</div>';
                        echo '</div>';

                        // Botões de ação
                        if ($editavel) {
                            echo '<button type="submit" class="btn btn-primary">Salvar</button>';
                            echo '<a href="../page/exibir_usuario.php" class="btn btn-secondary">Cancelar</a>';
                        } else {
                            echo '<a href="' . $_SERVER['PHP_SELF'] . '?editavel=true" class="btn btn-primary">Editar</a>';
                        }
                        

                        echo '</form>';
                    } else {
                        echo "Usuário não encontrado.";
                    }

                    $stmt->close();
                } else {
                    echo "ID do usuário não fornecido.";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <footer>
        <?php require_once("rodape.php"); ?>
    </footer>
</body>
</html>
