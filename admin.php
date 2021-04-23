<?php
session_start();
include ("bd.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('head.php') ?>
  <title>Панель администратора</title>
</head>

<body>
  <?php include('headerAdmin.php') ?>
  <section class="slice bg-section-secondary">
    <div class="content will-help-you">
      <div class="container">
        <div class="row">
          <form method="post">
            <h2 class="display-5 text-shadow font-weight-bold" style="margin-bottom: 50px; color:#00090b;">Добро пожаловать в панель администратора!</h2>
            <?php $query = "SELECT * FROM users";
            //Делаем запрос к БД, результат запроса пишем в $result:
            $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

            if ($result) {
              $rows = mysqli_num_rows($result); // количество полученных строк

              echo "
                    <div class = 'container-fluid p-0'>
                    <div class = 'table-responsive-md'>
                    <table class = 'table'>
                    <tr><th>Идентификатор</th><th>Имя</th><th>Почта</th><th>Пароль</th><th>Роль</th><th>Аватар</th></tr>";
              for ($i = 0; $i < $rows; ++$i) {
                $row = mysqli_fetch_row($result);
                echo "<tr>";
                for ($j = 0; $j < 6; ++$j) echo "<td>$row[$j]</td>";
                echo "</tr>";
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
        <label class="form-label" for="idusers">Идентификатор пользователя:</label>
        <form class="form-validate" method="post">
          <input class="delete-id" name="idusers" id="idusers" type="text" placeholder="1" autocomplete="off" required="" data-msg="Пожалуйста введите идентификатор">
          <button class="btn btn-primary" name="deleteButton" id="deleteButton" type="submit">Удалить</button>
        </form>
        <?php
        if (isset($_POST["deleteButton"])) {
          if (!empty($_POST['idusers'])) {
            $idusers = htmlspecialchars($_POST['idusers']);
            $query = "DELETE FROM users WHERE idusers ='$idusers';";
            $result = mysqli_query($GLOBALS["db"], $query);
            include("notification.php");
          } else echo "<div class=\"alert alert-warning alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Все поля должны быть заполнены!</div>";
        }
        ?>
      </div>
    </div>
  </section>
</body>

</html>