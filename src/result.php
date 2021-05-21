<?php
session_start();
include("bd.php");
?>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
<script type='text/javascript'>
  document.addEventListener('DOMContentLoaded', function() {
    window.setTimeout(document.querySelector('svg').classList.add('animated'), 1000);
  })
</script>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('head.php') ?>
  <title>Личный кабинет | Результаты тестов</title>
</head>

<body>
  <?php include('headerStudent.php') ?>
  <section class="slice bg-section-secondary">
    <div class="content will-help-you">
      <div class="container">
        <div class="row" style="flex-direction: column; margin-bottom: 6rem;">
          <form method="post">
            <?php $query = "SELECT * FROM `test-results` WHERE idusers = " . $_SESSION['idusers'] . "";
            //Делаем запрос к БД, результат запроса пишем в $result:
            $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

            if ($result) {
              $rows = mysqli_num_rows($result); // количество полученных строк

              echo "
              <div style = 'height: 30rem;'>
              <div class=' position-relative'>
              <h2 class='display-5 text-shadow font-weight-bold' style='margin-bottom: 50px; color:#00090b; margin-bottom: 3rem;'>
              Результаты тестов</h2>
              <div class = 'table-responsive-md'>
              <table class = 'table' style = 'width: 40%;'>
              <thead><th>Название теста</th><th>Оценка</th></thead>";

              if ($result->num_rows) {

                while ($row = mysqli_fetch_array($result)) {

                  echo "<tr>";
                  $query2 = "SELECT * FROM tests WHERE idtests = " . $row['idtests'] . "";
                  $result2 = mysqli_query($GLOBALS['db'], $query2);
                  while ($row2 = mysqli_fetch_array($result2)) {
                    echo "<td>" . $row2['testtitle'] . "</td>";
                  }
                  echo "<td>" . $row['mark'] . "</td></tr>";
                }
              } else {
                echo "<tr><td colspan = '2' class = 'text-center text-muted'>Результатов нет</td></tr>";
              }
              echo "</table>
                      <div class='position-absolute d-md-block image-container' style = 'top: 0; right: 0;'>
                        <img alt='lecture image' src='../assets/professor-animate.svg' style = 'width: 40rem !important;'>
                      </div>
                    </div>
                  </div>
                </div>";
            }

            ?>
        </div>
        </form>


      </div>
      <div class="container">
        <div><?php echo "
              <div style = 'height: 30rem;'>
              <div class=' position-relative'>
              <h2 class='display-5 text-shadow font-weight-bold' style='margin-bottom: 50px; color:#00090b; margin-bottom: 3rem;'>
              Статистика</h2>
              <div class = 'table-responsive-md'>
              <table class = 'table' style = 'width: 40%;'>
              <thead><th>Название теста</th><th>Количество попыток</th><th>Лучший результат</th></thead>";
              $query1 = "SELECT idusers, `test-results`.idtests, testtitle, COUNT(*) AS total, MAX(mark) AS maxMark FROM `test-results`, `tests` WHERE idusers =  " . $_SESSION['idusers'] . " AND `test-results`.idtests =`tests`.idtests GROUP BY `test-results`.idtests;";
              $result1 = mysqli_query($GLOBALS['db'], $query1) or die(mysqli_error($GLOBALS['db']));
              if ($result1->num_rows) {
                while ($row1 = mysqli_fetch_array($result1)) {
                  echo "<tr><td>" . $row1['testtitle'] . "</td>";
                  echo "<td>" . $row1['total'] . "</td>";
                  echo "<td>" . $row1['maxMark'] . "</td></tr>";
                }
              } else {
                echo "<tr><td colspan = '3' class = 'text-center text-muted'>Результатов нет</td></tr>";
              }
              ?>
        </div>
      </div>
    </div>
  </section>

</body>

</html>