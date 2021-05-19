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
  <title>Регистрация</title>
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
                  <div href="main.php"><a class="navbar-brand py-1" href="main.php" style="color:#00090b;">
                      <img src="../assets/math.svg" width="30px" style="margin-right: 21px;" alt="logo">Регистрация</a>
                    <p style="margin-bottom: 60px" class="text-muted">Войдите в свою учетную запись, чтобы продолжить.</p>
                  </div>
                  <form class="form-validate" method="post">
                    <div class="form-group">
                      <label class="form-label" for="email">Эл. почта:</label>
                      <input class="form-control" name="email" id="email" type="email" placeholder="name@address.com" autocomplete="on" required="" data-msg="Please enter your email">
                    </div>
                    <div class="form-group">
                      <label class="form-label" for="fullname">Логин</label>
                      <input class="form-control" name="fullname" id="fullname" type="text" placeholder="anna" autocomplete="on" required="" data-msg="Please enter your login">
                    </div>
                    <div class="form-group">
                      <label class="form-label" for="password">Пароль</label>
                      <input class="form-control" name="password" id="password" placeholder="Password" type="password" required="" data-msg="Please enter your password">
                    </div>
                    <button class="btn btn-lg btn-block btn-primary" name="regButton" id="regButton" type="submit">Зарегистрироваться</button>
                    <hr class="my-3 hr-text letter-spacing-2" data-content="OR">
                  </form>
                  <?php
                  if (isset($_POST['regButton'])) {
                    $email = $_POST["email"];
                    $pattern = "/^[А-ЯA-Z][а-яa-zА-ЯA-Z\-]{0,}\s[А-ЯA-Z][а-яa-zА-ЯA-Z\-]{1,}(\s[А-ЯA-Z][а-яa-zА-ЯA-Z\-]{1,})?$/";
                    if (!preg_match($pattern, $email)) {
                      $ErrMsg = "Неверный формат почты.";
                      echo  '<div class="error-msg">'.$ErrMsg.'</div>';
                    }
                    $name = $_POST["fullname"];
                    if (!preg_match("/^[a-zA-z]*$/", $name)) {
                      $ErrMsg = "Разрешены только буквы и пробелы!";
                      echo  '<div class="error-msg">'.$ErrMsg.'</div>';
                    }
                    $password = $_POST["password"];
                    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/", $password)) {
                      $ErrMsg = "Введите пароль, соответствующий правилам: минимум - 6 знаков, одна заглавная буква, одна строчная буква";
                      echo  '<div class="error-msg">'.$ErrMsg.'</div>';
                    }
                    if (isset($_POST['fullname'])) {
                      $fullname = $_POST['fullname'];
                      if ($fullname == '') {
                        unset($fullname);
                      }
                    }
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
                    if (empty($fullname) or empty($password) or empty($email)) {
                      exit("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
                    }
                    $fullname = stripslashes($fullname);
                    $fullname = htmlspecialchars($fullname);
                    $email = stripslashes($email);
                    $email = htmlspecialchars($email);
                    $password = stripslashes($password);
                    $password = htmlspecialchars($password);
                    $fullname = trim($fullname);
                    $password = trim($password);
                    $email = trim($email);
                    $result = mysqli_query($GLOBALS["db"], "SELECT idusers FROM users WHERE fullname='$fullname' AND WHERE email='$email' AND WHERE password='$password' ");
                    $myrow = mysqli_fetch_array($result);
                    if (!empty($myrow['fullname']) || !empty($myrow['email']) || !empty($myrow['password'])) {
                      $ErrMsg = "Извините, введённые вами данные уже зарегистрированы. Введите другие.";
                      echo  '<div class="error-msg">'.$ErrMsg.'</div>';
                    }
                    $result2 = mysqli_query($GLOBALS["db"], "INSERT INTO users (fullname, email, password) VALUES('$fullname','$email', '$password')");
                    if ($result2 == 'TRUE') {
                      header('location:  /src/login.php');
                    } else {
                      $ErrMsg = "Ошибка! Вы не зарегистрированы!";
                      echo  '<div class="error-msg">'.$ErrMsg.'</div>';
                    }
                  }
                  ?>
                  <a href="login.php" style="color:rgb(74, 134, 132);">Войти</a>
                </div>
              </div>
              <div class="position-absolute d-md-block image-container" style="top: 0; right: 0;">
                <img alt="lecture image" src="../assets/teacher-animate.svg" style="width: 40rem !important;"">
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