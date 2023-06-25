<?php
// inclui o arquivo de conexão
require_once '../modelo/conexao.php';

// define a mensagem de erro inicialmente como vazia
$error = "";

// função para autenticar o usuário
function autenticarUsuario($conn, $email, $senha) {
    // prepara a instrução SQL para selecionar o usuário pelo email e senha
    $stmt = $conn->prepare("SELECT id_pessoa, email, senha FROM cadastrar_pessoa WHERE email = ? AND senha = ?");
    $stmt->bind_param("ss", $email, $senha);

    // executa a instrução SQL e obtém o resultado
    $stmt->execute();
    $stmt->store_result();

    // verifica se o usuário foi encontrado
    if ($stmt->num_rows == 1) {
        // inicia a sessão e armazena o ID do usuário na variável de sessão
        session_start();
        $stmt->bind_result($id_pessoa, $email, $senha);
        $stmt->fetch();
        $_SESSION["id_pessoa"] = $id_pessoa;

        // fecha a instrução SQL
        $stmt->close();

        return true;
    } else {
        // fecha a instrução SQL
        $stmt->close();

        return false;
    }
}

// verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // obtém os valores do formulário e realiza a validação
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
    $senha = trim(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING));

    // realiza a verificação do login
    if (!empty($email) && !empty($senha)) {
        $login_sucesso = autenticarUsuario($conn, $email, $senha);

        if ($login_sucesso) {
            // redireciona para a página de saudação ou redirecionamento
            header("Location: ../page/inicio.php");
            exit();
        } else {
            // exibe uma mensagem de erro
            $error = "Email ou senha incorretos, verifique os dados digitados.";
            echo '<script>alert("Suson Informa: Email ou senha incorretos, verifique os dados digitados."); window.location.href = "../index.php";</script>';
        }
    } else {
        // exibe uma mensagem de erro
        $error = "Usuário não encontrado ou campo vazio, revise os dados informados";
        echo '<script>alert("Suson informa: Usuário não encontrado ou campo vazio, revise os dados informados"); window.location.href = "../index.php";</script>';
    }
}
?>
