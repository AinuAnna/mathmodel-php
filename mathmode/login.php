<?php
    session_start();
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <title>Sign in</title>
</head>
<body>
<div class="row min-vh-100">
        <div class="col-md-8 col-lg-6 col-xl-5 d-flex align-items-center">
    <div class="w-100 py-5 px-md-5 px-xl-6 position-relative">
            <div href="main.php"><a class="navbar-brand py-1" href="main.php" style = "color:#00090b;">
           <img src="./assets/math.svg" width="30px" style="margin-right: 21px;" alt="logo">Вход</a>
              <p style = "margin-bottom: 60px" class="text-muted">Войдите в свою учетную запись, чтобы продолжить.</p>
            </div>
            <form class="form-validate" method="post">
              <div class="form-group">
                <label class="form-label" for="email">Эл.Почта</label>
                <input class="form-control" name="email" id="email" type="email" placeholder="name@address.com" autocomplete="off" required="" data-msg="Please enter your email">
              </div>
              <div class="form-group">
                <label class="form-label" for="fullname">Логин</label>
                <input class="form-control" name="fullname" id="fullname" type="text" placeholder="anna" autocomplete="off" required="" data-msg="Please enter your email">
              </div>
              <div class="form-group">
                <label class="form-label" for="password">Пароль</label>
                <input class="form-control" name="password" id="password" placeholder="Password" type="password" required="" data-msg="Please enter your password">
              </div>
              <button class="btn btn-lg btn-block btn-primary" name = "loginButton" id = "loginButton" type="submit">Войти</button>
              <hr class="my-3 hr-text letter-spacing-2" data-content="OR">
            </form>
            <?php
            if(isset($_POST['loginButton'])){
    if (isset($_POST['fullname'])) { $fullname = $_POST['fullname'];
    if ($fullname == '') { unset($fullname);} } 
    if (isset($_POST['password'])) { $password=$_POST['password'];
    if ($password =='') { unset($password);} }
    if (isset($_POST['email'])) { $email=$_POST['email'];
        if ($email =='') { unset($email);} }
    if (empty($fullname) or empty($password) or empty($email))
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
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
    include ("bd.php");
 
    $result = mysqli_query($GLOBALS["db"], "SELECT * FROM users WHERE fullname='$fullname'"); 
    $myrow = mysqli_fetch_array($result);
    if (empty($myrow['password']))
    {
    exit ("Извините, введённый вами логин или пароль неверный.");
    }
    else {
    if ($myrow['password']==$password) {
    $_SESSION['fullname']=$myrow['fullname']; 
    $_SESSION['email']=$myrow['email']; 
    $_SESSION['idusers']=$myrow['idusers'];
    $_SESSION['roleid'] = $myrow['roleid'];
    if(isset($_SESSION['fullname'])) {
      if($_SESSION['roleid'] == 2){
        header('location: student.php');
      }
      else{
          header('location: admin.php');
      } 
    }
    }
 else {
    exit ("Извините, введённый вами логин или пароль неверный.");
    }
    }
  }
    ?>
            <a href="login.php" style = "color:rgb(74, 134, 132);">Зарегистрироваться</a> 
          </div>
        </div>
        <div class="col-md-4 col-lg-6 col-xl-7 d-none d-md-block">
          <!-- Image-->
          <div class="bg-cover h-100 mr-n3" style="background-image: url(https://st2.depositphotos.com/1340907/6714/v/950/depositphotos_67148421-stock-illustration-triangles.jpg);"></div>
        </div>
      </div>
    </body>
    </html>