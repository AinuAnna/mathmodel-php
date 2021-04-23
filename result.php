<?php
session_start();
include ("bd.php");
?>
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
        <div class="row">
          <form method="post">
            <?php $query = "SELECT * FROM `test-results` WHERE idusers = " . $_SESSION['idusers'] . "";
            //Делаем запрос к БД, результат запроса пишем в $result:
            $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

            if ($result) {
              $rows = mysqli_num_rows($result); // количество полученных строк

              echo "
                    <div class = 'container-fluid p-2'>
                    <h4 style = 'margin-top: 40px; margin-top: 20px;'>Ваши результаты тестов:</h4>
                    <div class = 'table-responsive-md mt-4'>
                    <table class = 'table'>
                    <thead><th>Название теста</th><th>Оценка</th></thead>";
              while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                $query2 = "SELECT * FROM tests WHERE idtests = " . $row['idtests'] . "";
                $result2 = mysqli_query($GLOBALS['db'], $query2);
                while ($row2 = mysqli_fetch_array($result2)) {
                  echo "<td>" . $row2['testtitle'] . "</td>";
                }
                echo "<td>" . $row['mark'] . "</td></tr>";
              }
              echo "</table>
                    </div>
                    </div>";
              // очищаем результат
              mysqli_free_result($result);
            }
            ?>
        </div>
        </form>
</body>

</html>