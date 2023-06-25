<?php
require_once '../modelo/conexao.php';
session_start();

if (isset($_POST['email'])) {
  // Processar os dados do formulário
  $email = $_POST['email'];

  // Verificar se o email existe no banco de dados
  $sql = "SELECT * FROM cadastrar_pessoa WHERE email = '$email'";
  $resultado = mysqli_query($conexao, $sql);

  if (mysqli_num_rows($resultado) > 0) {
    // Gerar uma nova senha aleatória
    $novaSenha = gerarNovaSenha();

    // Criptografar a nova senha
    $senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);

    // Atualizar a senha no banco de dados
    $sql = "UPDATE cadastrar_pessoa SET senha = '$senhaCriptografada' WHERE email = '$email'";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
      // Envie a nova senha por email para o usuário
      enviarEmailSenha($email, $novaSenha);

      // Redirecionar para a página de login com uma mensagem de sucesso
      header('Location: ../index.php?senha_resetada=1');
      exit();
    } else {
      // Ocorreu um erro ao atualizar a senha no banco de dados
      header('Location: ../index.php?erro=1');
      exit();
    }
  } else {
    // O email não está cadastrado no banco de dados
    header('Location: ../recuperar_senha.php?email_invalido=1');
    exit();
  }
}

// Função para gerar uma nova senha aleatória
function gerarNovaSenha() {
  $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  $novaSenha = '';
  $tamanhoSenha = 8;

  for ($i = 0; $i < $tamanhoSenha; $i++) {
    $index = rand(0, strlen($caracteres) - 1);
    $novaSenha .= $caracteres[$index];
  }

  return $novaSenha;
}

// Função para enviar a nova senha por email
function enviarEmailSenha($email, $novaSenha) {
  $to = $email;
  $subject = 'Recuperação de Senha';
  $message = 'Sua nova senha é: ' . $novaSenha;
  $headers = 'From: jairoeliakin51@gmail.com' . "\r\n" .
             'Reply-To: jairo.costa@estudante.iftm.edu.br' . "\r\n" .
             'X-Mailer: PHP/' . phpversion();

  if (mail($to, $subject, $message, $headers)) {
    // O email foi enviado com sucesso
    echo 'Email enviado com a nova senha.';
  } else {
    // Ocorreu um erro ao enviar o email
    echo 'Ocorreu um erro ao enviar o email.';
  }
}
?>
