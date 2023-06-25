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
  <title>Agenda</title>

  <style>
    .day.prev-day {
      background-color: orange;
    }
    .day.past-day {
      background-color: #ffa500;
    }
  </style>
</head>

<body>
  <div class="calendar">
    <div class="header">
      <div class="prev-btn">&lt;</div>
      <div class="month"></div>
      <div class="next-btn">&gt;</div>
    </div>
    <div class="weekdays"></div>
    <div class="days"></div>
  </div>

  <script>
    <?php
    require_once '../modelo/conexao.php';
    require_once '../page/log.php';
    if (isset($_SESSION['id_pessoa'])) {
      $id_pessoa = $_SESSION['id_pessoa'];
      echo "const idPessoa = $id_pessoa;";
    }
    ?>

document.addEventListener('DOMContentLoaded', function () {
  const calendar = document.querySelector('.calendar');
  const monthDisplay = calendar.querySelector('.month');
  const weekdaysDisplay = calendar.querySelector('.weekdays');
  const daysDisplay = calendar.querySelector('.days');
  const prevBtn = calendar.querySelector('.prev-btn');
  const nextBtn = calendar.querySelector('.next-btn');

  const months = [
    'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
    'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
  ];

  const weekdays = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];

  let currentMonth = new Date().getMonth();
  let currentYear = new Date().getFullYear();

  function updateCalendar() {
  monthDisplay.textContent = months[currentMonth] + ' ' + currentYear;

  weekdaysDisplay.innerHTML = '';
  for (let i = 0; i < 7; i++) {
    const weekday = document.createElement('div');
    weekday.classList.add('weekday');
    weekday.textContent = weekdays[i];
    weekdaysDisplay.appendChild(weekday);
  }

  daysDisplay.innerHTML = '';
  const firstDayOfMonth = new Date(currentYear, currentMonth, 1);
  const lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);
  const prevMonthDays = firstDayOfMonth.getDay();
  const totalDays = lastDayOfMonth.getDate();

  for (let i = prevMonthDays - 1; i >= 0; i--) {
    const day = document.createElement('div');
    day.classList.add('day');
    day.classList.add('prev-month');
    day.textContent = new Date(currentYear, currentMonth, -i).getDate();
    daysDisplay.appendChild(day);
  }

  for (let i = 1; i <= totalDays; i++) {
    const day = document.createElement('div');
    day.classList.add('day');
    day.textContent = i;

    const currentDate = new Date();
    const currentDay = new Date(currentYear, currentMonth, i);

    if (currentDay < currentDate) {
      day.classList.add('past-day');
    } else if (currentDay.toDateString() === currentDate.toDateString()) {
      day.classList.add('today');
    }

    if (currentDay.getMonth() !== currentMonth) {
      day.classList.add('next-month');
    }

    daysDisplay.appendChild(day);
  }

  markEventDates(); // Marcar as datas com eventos novamente após a atualização do calendário
}




  function prevMonth() {
    if (currentMonth === 0) {
      currentMonth = 11;
      currentYear--;
    } else {
      currentMonth--;
    }
    updateCalendar();
  }

  function nextMonth() {
    if (currentMonth === 11) {
      currentMonth = 0;
      currentYear++;
    } else {
      currentMonth++;
    }
    updateCalendar();
  }

  function markEventDates() {
    if (idPessoa) {
      fetch(`obter_eventos.php?id_pessoa=${idPessoa}`)
        .then(response => response.json())
        .then(data => {
          const events = data.events;

          const days = daysDisplay.querySelectorAll('.day');

          days.forEach(day => {
            const date = new Date(currentYear, currentMonth, parseInt(day.textContent));
            const dateString = date.toISOString().split('T')[0];

            if (events.includes(dateString)) {
              day.classList.add('event');
              day.classList.add('bg-success');
            }
          });
        })
        .catch(error => {
          console.error('Ocorreu um erro ao obter os eventos:', error);
        });
    }
  }

  prevBtn.addEventListener('click', prevMonth);
  nextBtn.addEventListener('click', nextMonth);

  updateCalendar();

  markEventDates(); // Marcar as datas com eventos ao carregar inicialmente o calendário
});

  </script>

</body>

</html>
