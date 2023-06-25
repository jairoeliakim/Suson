function filtrarVacinas() {
    var input, filtro, opcoes, opcao, i;
    input = document.getElementById("nome_vacina");
    filtro = input.value.toUpperCase();
    opcoes = document.getElementsByTagName("option");
    for (i = 0; i < opcoes.length; i++) {
      opcao = opcoes[i];
      if (opcao.innerHTML.toUpperCase().indexOf(filtro) > -1) {
        opcao.style.display = "";
      } else {
        opcao.style.display = "none";
      }
    }
  }
  