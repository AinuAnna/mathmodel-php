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
        <source src="assets/video/math-space-5.mp4" type="video/mp4"></source>
        <source src="assets/video/math-space.webm" type="video/webm"></source>
    </video>
</div>
    <div class="container py-6 py-md-7 text-white" style = "z-index: 1000;">
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
  <section class="slice bg-section-secondary">
    <div class="content will-help-you">
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
    </div>
  </section>
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