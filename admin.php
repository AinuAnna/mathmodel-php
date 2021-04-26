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
  <title>Панель администратора | Пользователи</title>
</head>

<body>
  <?php include('headerAdmin.php') ?>
  <section class="slice bg-section-secondary">
    <div class="content will-help-you">
      <div class="container">
        <div class="row">
          <form method="post">
            <h2 class="display-5 text-shadow font-weight-bold" style="margin-bottom: 50px; color:#00090b;">Пользователи </h2>
            <?php $query = "SELECT * FROM users";
            $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
            if ($result) {
              $rows = mysqli_num_rows($result); 
              echo "
              <div class = 'container-fluid p-0'>
              <div class = 'table-responsive-md'>
              <table class = 'table'>";
              echo "<tr><th>Идентификатор</th><th>Имя</th><th>Почта</th><th>Пароль</th><th>Роль</th><th>Доступ</th><th>Аватар</th></tr>";
              while ($row = mysqli_fetch_array($result)) {
                echo "<tr><td>" . $row['idusers'] . "</td>";
                echo "<td>" . $row['fullname'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $row['roleid'] . "</td>";
                if ($row["roleid"] != null) {
                  $query2 = "SELECT * FROM role WHERE idrole = " . $row['roleid'] . "";
                  $result2 = mysqli_query($GLOBALS['db'], $query2);
                  echo "<td>";
                  while ($row2 = mysqli_fetch_array($result2)) {
                    echo "<a" . $row['idrole'] . "'>" . $row2['type'] . "</a>";
                  }
                  echo "</td>";
                }
                if($row['avatar'] == ''){
                  echo '<td><img src = "./assets/user-avatar.svg" width= 50px; height= 50px;></td></tr>';
                }
                else{
                  echo "<td><img src = '" . $row['avatar'] . "' width= 50px; height= 50px; style = 'object-fit: cover; border-radius: 50%'></td></tr>";
                }
              }
              echo "</tr>
              </table>
                      </div>
                      </div>";
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