<header class="header">
  <nav class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white">
    <div class="container-fluid">
      <div class="d-flex align-items-center"><a class="navbar-brand py-1" href="main.php">
          <img src="../assets/math.svg" width=30px style="margin-right: 21px;" alt="logo"></a>
      </div>
      <?php
      $query = "SELECT * FROM users WHERE idusers = " . $_SESSION['idusers'] . ";";
      $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
      $row = mysqli_fetch_array($result);
      if ($row['avatar'] == '') {
        echo '<span class = "account-user-avatar"><a href = "adminProfile.php"><img src = "../assets/user-avatar.svg" width= 32px; height= 32px;></a></span>
        <span class = "nav-user">
                <span class="account-user-name">' . $row['fullname'] . '</span>
                <span class="account-position">' . $row['email'] . '</span>
                </span>';
      } else {
        echo "<span class = 'account-user-avatar'><a href = 'adminProfile.php'><img src = '" . $row['avatar'] . "' width= 32px; height= 32px; style = 'object-fit: cover; border-radius: 50%'></a></span>
        <span class = 'nav-user'><span class='account-user-name'>" . $row['fullname'] . "</span>
        <span class='account-position'>" . $row['email'] . "</span>
    </span>";
      } ?>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a class="nav-link" href="adminProfile.php">Профиль</a></li>
          <li class="nav-item"><a class="nav-link" href="admin.php">Пользователи</a></li>
          <li class="nav-item"><a class="nav-link" href="groups.php">Группы</a></li>
          <li class="nav-item"><a class="nav-link" href="lecture.php">Лекции</a></li>
          <li class="nav-item"><a class="nav-link" href="tests.php">Тесты</a></li>
          <li class="nav-item"><a class="nav-link" href="resultAll.php">Результаты тестов</a></li>
          <li class="nav-item"><a class="nav-link" href="comments.php">Отзывы</a></li>
          <li class="nav-item"><a class="nav-link" href="requests.php">Заявки</a></li>
          <li class="nav-item"><a class="btn btn-primary" href="logout.php">Выйти</a></li>
        </ul>
      </div>
    </div>
  </nav>
</header>