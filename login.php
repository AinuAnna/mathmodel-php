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
  <title>Вход</title>
</head>

<body>
  <section class="slice bg-section-secondary">
    <div class="content will-help-you">
      <div class="container" id="reg">
        <div class="row" style="flex-direction: column;">
          <div class="position-relative">
            <div class='table-responsive-md'>
              <div class="row featurette">
                <div class="col-md-5">
                  <div href="main.php">
                    <a class="navbar-brand py-1" href="main.php" style="color:#00090b;">
                      <img src="./assets/math.svg" width="30px" style="margin-right: 21px;" alt="logo">Вход</a>
                    <p style="margin-bottom: 60px" class="text-muted">Войдите в свою учетную запись, чтобы продолжить.</p>
                  </div>
                  <form class="form-validate" method="post">
                    <div class="form-group">
                      <label class="form-label" for="email">Эл.Почта</label>
                      <input class="form-control" name="email" id="email" type="email" placeholder="name@address.com" autocomplete="off" required="" data-msg="Please enter your email">
                    </div>
                    <div class="form-group">
                      <label class="form-label" for="password">Пароль</label>
                      <input class="form-control" name="password" id="password" placeholder="Password" type="password" required="" data-msg="Please enter your password">
                    </div>
                    <button class="btn btn-lg btn-block btn-primary" name="loginButton" id="loginButton" type="submit">Войти</button>
                    <hr class="my-3 hr-text letter-spacing-2" data-content="OR">
                  </form>
                  <?php
                  if (isset($_POST['loginButton'])) {
                    if (isset($_POST['password'])) {
                      $password = $_POST['password'];
                      if ($password == '') {
                        unset($password);
                      }
                    }
                    if (isset($_POST['email'])) {
                      $email = $_POST['email'];
                      if ($email == '') {
                        unset($email);
                      }
                    }
                    if (empty($password) or empty($email)) {
                      exit("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
                    }
                    $email = stripslashes($email);
                    $email = htmlspecialchars($email);
                    $password = stripslashes($password);
                    $password = htmlspecialchars($password);
                    $password = trim($password);
                    $email = trim($email);

                    $result = mysqli_query($GLOBALS["db"], "SELECT * FROM users WHERE email='$email'");
                    $myrow = mysqli_fetch_array($result);
                    if (empty($myrow['password'])) {
                      exit("Извините, введённый вами логин или пароль неверный.");
                    } else {
                      if ($myrow['password'] == $password) {
                        $_SESSION['email'] = $myrow['email'];
                        $_SESSION['idusers'] = $myrow['idusers'];
                        $_SESSION['roleid'] = $myrow['roleid'];
                        if (isset($_SESSION['email'])) {
                          if ($_SESSION['roleid'] == 2) {
                            header('location: info.php');
                          } else if ($_SESSION['roleid'] == 3) {
                            header('location: teacher.php');
                          } else {
                            header('location: adminProfile.php');
                          }
                        }
                      } else {
                        exit("Извините, введённый вами логин или пароль неверный.");
                      }
                    }
                  }
                  ?>
                  <a href="reg.php" style="color:rgb(74, 134, 132);">Зарегистрироваться</a>
                </div>
              </div>
              <div class="position-absolute d-md-block image-container" style="top: 0; right: 0;">
                <img alt="lecture image" src="./assets/teacher-animate (1).svg" style="width: 40rem !important;"">
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>

</html>