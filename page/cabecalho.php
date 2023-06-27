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
</head>
<body>
<header class="bg-success text-white p-3 d-flex justify-content-between">
    <h3 class="text-center"><?php echo $title; ?></h3>
    <div class="ml-auto">
        <button class="btn btn-light" title='Para voltar a página Inicial' onclick="goBack()">Voltar</button>
        <button class="btn btn-danger" title='Para Sair do sistema' onclick="exit()">Sair</button>
    </div>
</header>



    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <?php include_once "log.php"; ?>
    <script>
        function goBack() {
            window.location.href = '../page/inicio.php';
        }
        const date = new Date().toLocaleDateString();
        document.write(date);

        function exit() {
            var confirmation = confirm("Tem certeza que deseja sair do sistema?");
            if (confirmation) {
                window.location.href = '../';
            }
        }

    </script>
</body>
</html>
