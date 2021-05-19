<?php
include('bd.php');
$query3 = "SELECT idusers FROM `comments`";
$result3 = mysqli_query($GLOBALS['db'], $query3) or die(mysqli_error($GLOBALS['db']));
$arr = array();
while ($row3 = mysqli_fetch_assoc($result3)) {
  array_push($arr, $row3);
}
shuffle($arr);
foreach ($arr as $key => $value) {
  foreach ($value as $k => $new) {
    $query = "SELECT * FROM `comments` WHERE idusers = $new";
  }
}
$result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
$row = mysqli_fetch_array($result);
$textcomment = $row['textcomment'];

$id =  $row['idusers'];
$query2 = "SELECT * FROM `users` WHERE idusers = $id";
$result2 = mysqli_query($GLOBALS['db'], $query2) or die(mysqli_error($GLOBALS['db']));
$row2 = mysqli_fetch_array($result2);
$fullname =  $row2['fullname'];
$avatar = $row2['avatar'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('head.php') ?>
  <title>Математическое моделирование</title>
</head>

<body>
  <header class="header">
    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white">
      <div class="container-fluid">
        <div class="d-flex align-items-center"><a class="navbar-brand py-1" href="main.php">
            <img src="../assets/math.svg" width=30px style="margin-right: 21px;" alt="logo">Математическое моделирование</a>
        </div>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="reg.php">Зарегистрироваться</a></li>
            <li class="nav-item mt-3 mt-lg-0 ml-lg-3 d-lg-none d-xl-inline-block"><a class="btn btn-primary" href="login.php">Войти</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- /Navbar -->
  </header>
  <section class="hero-home">
    <div id="video-bg">
      <video width="100%" autoplay muted loop>
        <source src="../assets/video/math-space-5.mp4" type="video/mp4">
        </source>
        <source src="../assets/video/math-space.webm" type="video/webm">
        </source>
      </video>
    </div>
    <div class="container py-6 py-md-7 text-white" style="z-index: 1000;">
      <div class="row">
        <div class="col-xl-10">
          <div class="text-center text-lg-left">
            <h1 class="display-3 font-weight-bold text-shadow">Математическое моделирование</h1>
            <p class="subtitle letter-spacing-4 mb-2 text-shadow">Изучайте предмет быстро и легко</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="container">
    <div class="row">
      <h2 class="display-5 text-shadow font-weight-bold" style="margin-bottom: 50px; color:#00090b;">Где угодно и когда удобно</h2>
      <ul class="large-list">
        <li>Занимайтесь из дома,
          на работе или в путешествии — с компьютера или смартфона.</li>
        <li>Бесплатный доступ</li>
        <li>Обучение в тестах и лекциях</li>
        <li>Отслеживание прогресса</li>
        <li>И многое другое</li>
      </ul>
    </div>
  </div>

  <div class="container" style="max-width: 700px">
    <div class="card bg-transparent shadow-none">
      <div class="row">
        <div class="col-lg-3 d-none d-lg-block">
          <?php if ($avatar == '') {
        echo '<img class = "rounded-circle" src = "../assets/user-avatar.svg" width= 100px; height= 100px; style = "margin: 2rem">';
      } else {
        echo "<img class = 'rounded-circle' src = '" . $avatar. "' width= 100px; height= 100px; style = 'object-fit: cover; border-radius: 50%; margin: 2rem'>";
      }?>
        </div>

        <div class="col-lg-9">
          <!-- Card Body -->
          <div class="card-body h-100 rounded-lg p-0 p-md-4">
            <!-- SVG Quote -->
            <figure class="mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 8 8">
                <path fill="#bece5f" d="M3,1.3C2,1.7,1.2,2.7,1.2,3.6c0,0.2,0,0.4,0.1,0.5c0.2-0.2,0.5-0.3,0.9-0.3c0.8,0,1.5,0.6,1.5,1.5c0,0.9-0.7,1.5-1.5,1.5
                      C1.4,6.9,1,6.6,0.7,6.1C0.4,5.6,0.3,4.9,0.3,4.5c0-1.6,0.8-2.9,2.5-3.7L3,1.3z M7.1,1.3c-1,0.4-1.8,1.4-1.8,2.3
                      c0,0.2,0,0.4,0.1,0.5c0.2-0.2,0.5-0.3,0.9-0.3c0.8,0,1.5,0.6,1.5,1.5c0,0.9-0.7,1.5-1.5,1.5c-0.7,0-1.1-0.3-1.4-0.8
                      C4.4,5.6,4.4,4.9,4.4,4.5c0-1.6,0.8-2.9,2.5-3.7L7.1,1.3z"></path>
              </svg>
            </figure>
            <!-- End SVG Quote -->

            <div class="row">
              <div class="mb-3 mb-lg-0" style="padding-right: 15px; padding-left: 15px;">
                <div class="pr-lg-5">
                  <blockquote class="h6 font-weight-normal mb-4"><?php echo $textcomment; ?></blockquote>
                  <div class="media">
                    <div class="media-body">
                      <span class="text-dark font-weight-bold"><?php echo $fullname; ?></span>
                      <span class="font-size-1">— студент(ка) курса</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Card Body -->
        </div>
      </div>
    </div>
  </div>
  <footer class="position-relative z-index-10 d-print-none">
    <div class="py-4 font-weight-light bg-gray-800 text-gray-300" style="margin-top: 150px; background-color:#00090b; color: white;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 text-center text-md-left">
            <p class="text-sm mb-md-0">© 2021, Минск, Анна Терешко </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>