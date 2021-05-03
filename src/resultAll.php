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
<?php if ($_SESSION['roleid'] == 1) {
    echo ' <title>Панель администратора | Результаты тестов</title>';
  } else {
    echo ' <title>Кабинет преподавателя | Результаты тестов</title>';
  } ?>
</head>

<body>
<?php if ($_SESSION['roleid'] == 1) {
    include('headerAdmin.php');
  } else {
    include('headerTeacher.php');
  } ?>
  <section class="slice bg-section-secondary">
  <div class="content will-help-you">
    <div class="container">
      <div class="row" style="flex-direction: column;">
          <form method="post">
            <?php $query = "SELECT * FROM `test-results`";
            $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

            if ($result) {
              $rows = mysqli_num_rows($result);

              echo "
              <div class=' position-relative'>
              <h2 class='display-5 text-shadow font-weight-bold' style='margin-bottom: 50px; color:#00090b; margin-bottom: 3rem;'>
              Результаты тестов</h2>
              <div class = 'table-responsive-md'>
                    <table class = 'table' style = 'width: 61%'>
                    <thead><th>Идентификатор результата</th><th>Название теста</th><th>Оценка</th><th>Пользователь</th></thead>";
              while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                $query2 = "SELECT * FROM `test-results` WHERE idtestResults = " . $row['idtestResults'] . "";
                $result2 = mysqli_query($GLOBALS['db'], $query2);
                while ($row2 = mysqli_fetch_array($result2)) {
                  echo "<td>" . $row2['idtestResults'] . "</td>";
                }
                $query2 = "SELECT * FROM tests WHERE idtests = " . $row['idtests'] . "";
                $result2 = mysqli_query($GLOBALS['db'], $query2);
                while ($row2 = mysqli_fetch_array($result2)) {
                  echo "<td>" . $row2['testtitle'] . "</td>";
                }
                echo "<td>" . $row['mark'] . "</td>";
                $query3 = "SELECT * FROM users WHERE idusers = " . $row['idusers'] . "";
                $result3 = mysqli_query($GLOBALS['db'], $query3);
                while ($row3 = mysqli_fetch_array($result3)) {
                  echo "<td>" . $row3['email'] . "</td></tr>";
                }
              }
                  echo "</table>
                  <div class='position-absolute d-md-block image-container' style = 'top: 0; right: -200px;'>
                  <img alt='lecture image' src='../assets/professor-animate.svg' style = 'width: 40rem !important;'>
                  </div>
                </div>
            </div>";
              mysqli_free_result($result);
            }
            ?>
        </div>
        </form>
        <label class="form-label" for="idtestResults">Идентификатор результата:</label>
        <form class="form-validate" method="post">
          <input class="delete-id" name="idtestResults" id="idtestResults" type="text" placeholder="1" autocomplete="off" required="" data-msg="Пожалуйста введите идентификатор">
          <button class="btn btn-primary" name="deleteButton" id="deleteButton" type="submit">Удалить</button>
        </form>
        <?php
        if (isset($_POST["deleteButton"])) {
          if (!empty($_POST['idtestResults'])) {
            $idtestResults = htmlspecialchars($_POST['idtestResults']);
            $query = "DELETE FROM `test-results` WHERE idtestResults ='$idtestResults';";
            $result = mysqli_query($GLOBALS["db"], $query);
            include("notification.php");
          } else echo "<div class=\"alert alert-warning alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Все поля должны быть заполнены!</div>";
        }
        ?>
</body>

</html>