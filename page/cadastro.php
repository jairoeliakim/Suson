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
    <title>Cadastro</title>
</head>

<body>
<header class="bg-success text-white p-3 d-flex justify-content-between">
    <h3 style="text-align: center; display: flex; justify-content: center; align-items: center; flex-direction: column; ">Bem Vindo a Suson</h3>
    <div>
        <button class="btn btn-danger" title='Para Sair do sistema' onclick="exit()">Sair</button>
    </div>
</header>


    <div class="container">
    <p>    Sua nova carteira de vacinação, para acessos realize o cadastro:</p>
        <form action="../controle/registrar.php" method="POST">
            
        <p>Para registrar um novo usuário, preencha todos os dados corretamente!</p>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" name="senha" required>
            </div>
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" required>
            </div>
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select id="sexo" class="form-control" name="sexo" required>
                    <option value="">Selecione</option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="data_nascimento">Data de nascimento:</label>
                <input type="date" id="data_nascimento" class="form-control" name="data_nascimento" required>
            </div>
            <div class="form-group">
                <label for="cep">CEP:</label>
                <input type="text" id="cep" class="form-control" name="cep" required>
            </div>

            <button type="submit" class="btn btn-success" title="Salvar formulário?">Registrar</button>
            <button type="reset" class="btn btn-warning" title="Limpar formulário?" style="color: white;" value="Limpar formulário">Limpar</button>

    <script>
     function exit() {
            var confirmation = confirm("Tem certeza que deseja sair do sistema? \nTodas as alterações serão perdidas");
            if (confirmation) {
                window.location.href = '../';
            }
        }    
    </script>
        </form>
    </div>

    <footer>
        <?php require_once("rodape.php"); ?>
    </footer>
</body>

</html>
