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
    <title>Informações de Vacinas</title>
	<style>
        .table td,
        .table th {
            color: black;
        }
    </style>
</head>
	<header>		
        <?php 
			$title = "Informativo";
			include 'cabecalho.php'; 
		?>
    </header>

<body>
	<div class="menu">
		<h3>Lista de vacinas no Brasil</h3>
		<p>Atualizações podem ser necessárias para vacinas desconhecidas</p>		
	</div>
	
    <div class="container">      
        <div class="table-responsive">
            <div class= "cadastrar">
				<div class="lista-vacina">
				<div class="search-bar align-left">
					<input type="text" id="search-input" placeholder="Buscar uma vacina">
					<button class="btn btn-success" title="Buscar vacina" onclick="searchTable()">Pesquisar</button>
				</div>

				<table class="table table-border">
                <thead class="thead-light">
					
                    <tr>
                        <th>Tipo de Vacina</th>
                        <th>Efeitos Colaterais Comuns</th>
                        <th>Efeitos Colaterais Raros</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Vacina contra a gripe (influenza)</td>
                        <td>Dor no local da injeção, febre baixa, dor muscular leve.</td>
                        <td></td>
                    </tr>
                    
					<tr>
						<td>Vacina tríplice viral</td>
						<td>Febre baixa, erupção cutânea, dor no local da injeção</td>
						<td></td>
					</tr>
					
					<tr>
						<td>Vacina contra o tétano, difteria e coqueluche:</td>
						<td>Dor muscular, vermelhidão no local da aplicação</td>
						<td></td>
					</tr>
					
					<tr>
						<td>Vacina Pfizer-BioNTech (Comirnaty):</td>
						<td>Dor no local da injeção, fadiga, dor de cabeça, dores musculares e articulares, calafrios, febre leve.</td>
						<td>Reações alérgicas graves (anafilaxia)</td>
					</tr>
					
					<tr>
						<td>Vacina Moderna (Spikevax)</td>
						<td>Dor no local da injeção, fadiga, dor de cabeça, dores musculares e articulares, calafrios, febre leve.</td>
						<td>Reações alérgicas graves (anafilaxia).</td>
					</tr>
					
					<tr>
						<td>Vacina AstraZeneca (Vaxzevria):</td>
						<td>Dor no local da injeção, fadiga, dor de cabeça, dores musculares e articulares, calafrios, febre leve.</td>
						<td>Coágulos sanguíneos (trombose) com plaquetas baixas (TTS), principalmente em mulheres jovens.</td>
					</tr>
					
					<tr>
						<td>Vacina Janssen (Johnson & Johnson):</td>
						<td>Dor no local da injeção, fadiga, dor de cabeça, dores musculares e articulares, calafrios, febre leve.</td>
						<td>Coágulos sanguíneos (trombose) com plaquetas baixas (TTS).</td>
					</tr>
					
					<tr>
						<td>Vacina contra difteria, tétano e coqueluche (DTP ou DTPa)</td>
						<td>Dor e vermelhidão no local da injeção, febre, irritabilidade, sonolência, perda temporária de apetite.</td>
						<td>Choro inconsolável, convulsões febris.</td>
					</tr>
					
					<tr>
						<td>Vacina contra poliomielite (VOP ou VIP):</td>
						<td>Dor e vermelhidão no local da injeção.</td>
						<td>Fraqueza muscular temporária.</td>
					</tr>
					
					<tr>
						<td>Vacina contra sarampo, caxumba e rubéola (MMR ou tríplice viral):</td>
						<td>Febre, erupção cutânea leve, dor e inchaço dos gânglios linfáticos.</td>
						<td>Dor nas articulações, convulsões febris.</td>
					</tr>
					
					<tr>
						<td>Vacina contra varicela:</td>
						<td>vermelhidão, sensibilidade e inchaço no local da injeção, erupção cutânea leve, febre.</td>
						<td>reações alérgicas graves</td>
					</tr>
					
					<tr>
						<td>Vacina contra hepatite B:</td>
						<td>Dor no local da injeção, fadiga, febre leve.</td>
						<td>Reações alérgicas</td>
					</tr>
					
					<tr>
						<td>Vacina contra Haemophilus influenzae tipo b (Hib):</td>
						<td>Vermelhidão, inchaço e dor no local da injeção, febre</td>
						<td>Reações alérgicas</td>
					</tr>
					
					<!-- Adicione mais linhas conforme necessário
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					-->
				</tbody>
			</table>
					
				</div>

			</div>
        </div>

        <?php require_once("rodape.php"); ?>
    </div>
	<script>
		function searchTable() {
    var input = document.getElementById("search-input").value.toLowerCase();
    var table = document.querySelector(".lista-vacina table");
    var rows = table.getElementsByTagName("tr");

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        var rowText = "";

        for (var j = 0; j < cells.length; j++) {
            rowText += cells[j].textContent.toLowerCase();
        }

        if (rowText.includes(input)) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}

	</script>
</body>

</html>


