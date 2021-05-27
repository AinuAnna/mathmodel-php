<?php
session_start();
include("bd.php");
include("confirm.php");
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
      <div class="container" style="padding: 90px 0px;">
        <div class="row" style="flex-direction: column; align-items: center;">
          <h2 class="display-5 text-shadow font-weight-bold" style="margin-bottom: 50px; color:#00090b;">
            Пользователи</h2>
          <?php $query = "SELECT * FROM users";
          $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
          if ($result) {
            $rows = mysqli_num_rows($result);
            echo "
              <div class = 'container-fluid p-0'>
              <div class = 'table-responsive-md'>
              <table class = 'table'>";
            echo "<tr><th>Идентификатор</th><th>Имя</th><th>Почта</th><th>Роль</th><th>Доступ</th><th>Группа</th><th>Описание группы</th><th>Номер группы</th><th>Аватар</th></tr>";
            $count = 0;
            while ($row = mysqli_fetch_array($result)) {
              echo "<tr><td>" . $row['idusers'] . "</td>";
              echo "<td>" . $row['fullname'] . "</td>";
              echo "<td>" . $row['email'] . "</td>";
              echo "<td data-item = '" . $row['idusers'] . "'>" . $row['roleid'] . "<span class = 'inpcont'><input class='btn btn-primary' style = 'margin-left: 2rem; margin-bottom: 0;' name='changeRole[$count]' id='changeRole' value = '✏️' type='button'></span></td>";
              if ($row["roleid"] != null) {
                $query2 = "SELECT * FROM role WHERE idrole = " . $row['roleid'] . "";
                $result2 = mysqli_query($GLOBALS['db'], $query2);
                echo "<td>";
                while ($row2 = mysqli_fetch_array($result2)) {
                  echo "<a" . $row['idrole'] . "'>" . $row2['rus'] . "</a>";
                }
                echo "</td>";
              }
              if ($row["groupsid"] != '') {
                $query2 = "SELECT * FROM `groups` WHERE idgroups = " . $row['groupsid'] . "";
                $result2 = mysqli_query($GLOBALS['db'], $query2);
                while ($row2 = mysqli_fetch_array($result2)) {
                  echo "<td><a" . $row['idgroups'] . "'>" . $row2['groupnumber'] . "</a></td>";
                  echo "<td><a" . $row['idgroups'] . "'>" . $row2['namegroup'] . "</a></td>";
                }
              } else {
                echo "<td>➖</td>";
                echo "<td>➖</td>";
              }
              if ($row['numbergroup'] == NULL) {
                echo "<td>➖</td>";
              } else {
                echo "<td>" . $row['numbergroup'] . "</td>";
              }
              if ($row['avatar'] == '') {
                echo '<td><img src = "../assets/user-avatar.svg" width= 50px; height= 50px;></td></tr>';
              } else {
                echo "<td><img src = '" . $row['avatar'] . "' width= 50px; height= 50px; style = 'object-fit: cover; border-radius: 50%'></td></tr>";
              }
              $count++;
            }
            echo "</tr>
              </table>
                      </div>
                      </div>";
          }
          ?>
        </div>
        </form>
        <label class="form-label" for="idusers">Идентификатор пользователя:</label>
        <form class="form-validate d-flex" onsubmit="return confirmDesactiv()" method="post" style="width: 30% !important">
          <input class="delete-id form-control" name="idusers" id="idusers" type="text" placeholder="1" autocomplete="off" required="" data-msg="Пожалуйста введите идентификатор">&nbsp;
          <button class="btn btn-primary" name="deleteButton" id="deleteButton" type="submit">❌</button>
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
<script>
  count = 0;
  $(document).on("click", "#changeRole", (e) => {
    const container = $(e.target).closest(".inpcont");
    const data = $(e.target).closest('td').text();
    const data2 = $(e.target).closest('td').attr('data-item');
    container.append(`<form method = "post" class = "form" style = "display: inherit;"><input class = "form-control" style = "width: 30%; margin: auto 1rem; display: inherit" type = "text" value = "${data}" name = "editRole[${count}]"/><input type = "text" style = "display:none" name = "idUserForRole[${count}]" value = "${data2}"/><button class='btn btn-primary' style = 'margin: 0;' id = 'saveRole' name='saveRole[${count}]' type='submit'>✔️</button></form>`);
    count++;
    e.preventDefault();
  });
</script>
<?php
if (isset($_POST["saveRole"])) {
  $editRole = $_POST['editRole'];
  $idUserForRole = $_POST['idUserForRole'];

  for ($i = 0; $i < count($editRole); $i++) {
    $roleid = intval($editRole[$i]);
    for ($j = 0; $j < count($idUserForRole); $j++) {
      $user = intval($idUserForRole[$j]);
      $sql .= "UPDATE `users` SET `roleid` = '{$roleid}' WHERE `idusers` = '{$user}'; ";
    }
  }

  if (mysqli_multi_query($GLOBALS['db'], $sql)) {
    echo "New records created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($GLOBALS['db']);
  }
}
?>