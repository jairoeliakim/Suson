<!DOCTYPE html>
<html>
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
    <title>Suson </title>
    <link rel="stylesheet" href="../style/reset.css">

    <style>
        body {
            background-color:rgb(26, 165, 119);
            font-family: Arial, sans-serif;
        }
        
        form {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin: auto;
            margin-top: 12vw;
            max-width: 400px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
        }
        
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        
        button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
           
            margin-bottom: 10px;
            width: 100%;
                        
        }
        
        button[type="submit"]:hover {
            background-color: #3e8e41;

        }
        
        .error {
            color: #f00;
            font-weight: bold;
            margin-bottom: 20px;
        }
    
        .atualizarcadastro .botao-amarelo {
        background-color: yellow;
        color: black;
        width: 48%;
        }

        .atualizarcadastro .botao-vermelho {
        background-color: rgb(255, 99, 71);
        color: white;
        width: 48%;
        }
        
        .atualizarcadastro .botao-amarelo:hover {
        background-color: orange;
        color: white;
        width: 50%;
        }

        .atualizarcadastro .botao-vermelho:hover {
        background-color: rgb(259, 0, 100);
        color: black;
        width: 50%;
        }

    </style>

</head>
<body>
    <header>
    <h3 style="text-align: center; display: flex; justify-content: center; align-items: center; flex-direction: column;">Suson - Carteira de Vacinas</h3>

    <h3 style="text-align: center; display: flex; justify-content: center; align-items: center; flex-direction: column;">Login</h3>
    </header>
    

    <form method="POST" action="./controle/validar_login.php">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <button type="submit">Entrar</button>     
        <div class="atualizarcadastro">
            <a href="./page/cadastro.php"><button type="button"  class="botao-amarelo">Criar Conta</button></a>
            <a href="./controle/recuperar_senha.php"> <button type="button"  class="botao-vermelho">Esqueci senha</button></a>
        </div> 

    </form>

    <footer>
   
        <?php require_once("rodape.php"); ?>
    </footer>
</body>
</html>
