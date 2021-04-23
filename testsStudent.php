<?php
session_start();
include("bd.php");
?>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include('head.php') ?>
  <title>Личный кабинет | Тесты</title>
</head>

<body>
<?php include('headerStudent.php') ?>
  <section class="slice bg-section-secondary">
    <div class="content will-help-you">
      <div class="container">
        <div class="row">
          <?php $query = "SELECT * FROM tests";
          //Делаем запрос к БД, результат запроса пишем в $result:
          $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

          if ($result) {
            $rows = mysqli_num_rows($result); // количество полученных строк

            echo "
                    <div class = 'container-fluid p-0'>
                    <div class = 'table-responsive-md'>
                    <h4 style = 'margin-top: 40px; margin-top: 20px;'>Тесты:</h4>
                    <ol>";
            while ($row = mysqli_fetch_array($result)) {
              echo "<li><a href = 'testpage.php?idtests=" . $row['idtests'] . "'>" . $row['testtitle'] . "</a></li>";
            }
            echo "</ul>
                    </div>
                    </div>";
            // очищаем результат
            mysqli_free_result($result);
          }
          ?>
        </div>
      </div>
    </div>
  </section>
</body>

</html>