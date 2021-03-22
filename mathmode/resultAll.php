<?php
    session_start();
    include ("bd.php");
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "./style.css">
    <link rel="shortcut icon" href="assets/math.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <title>Личный кабинет | Результаты тестов</title>
</head>
<body>
<header class="header">
      <!-- Navbar-->
      <nav class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white">
        <div class="container-fluid">
          <div class="d-flex align-items-center"><a class="navbar-brand py-1" href="main.php">
           <img src="./assets/math.svg" width = 30px style = "margin-right: 21px;" alt="logo">Математическое моделирование</a>
          </div>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="student.php">Профиль</a></li>
              <li class="nav-item"><a class="nav-link" href="lectureStudent.php">Лекции</a></li>
              <li class="nav-item"><a class="nav-link" href="testsStudent.php">Тесты</a></li>
              <li class="nav-item"><a class="nav-link" href="result.php">Результаты тестов</a></li>
              <li class="nav-item"><a class="btn btn-primary" href="logout.php">Выйти</a></li>
            </ul>
          </div>
        </div>
      </nav>-
      </header>
      <section class="slice bg-section-secondary">
        <div class="content will-help-you">
          <div class="container">
            <div class="row">
            <form method="post">
              <?php $query = "SELECT * FROM `test-results`";
              //Делаем запрос к БД, результат запроса пишем в $result:
              $result = mysqli_query($GLOBALS['db'], $query) or die( mysqli_error($GLOBALS['db']));

                if($result)
                {
                    $rows = mysqli_num_rows($result); // количество полученных строк
                    
                    echo "
                    <div class = 'container-fluid p-2'>
                    <h4 style = 'margin-top: 40px; margin-top: 20px;'>Результаты тестов учащихся:</h4>
                    <div class = 'table-responsive-md mt-4'>
                    <table class = 'table'>
                    <thead><th>Название теста</th><th>Оценка</th><th>Пользователь</th></thead>";
                    while($row = mysqli_fetch_array($result))
                    {
                        echo"<tr>";
                        $query2 = "SELECT * FROM tests WHERE idtests = ".$row['idtests']."";
                        $result2 = mysqli_query($GLOBALS['db'], $query2);
                        while($row2 = mysqli_fetch_array($result2)){
                            echo "<td>".$row2['testtitle']."</td>";
                        }    
                        echo "<td>".$row['mark']."</td>"; 
                        $query3 = "SELECT * FROM users WHERE idusers = ".$row['idusers']."";
                        $result3 = mysqli_query($GLOBALS['db'], $query3);
                        while($row3 = mysqli_fetch_array($result3)){
                            echo "<td>".$row3['email']."</td></tr>";
                        }                                
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
</body>
</html>