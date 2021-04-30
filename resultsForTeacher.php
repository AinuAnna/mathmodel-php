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
    <title>Кабинет преподавателя | Результаты тестов</title>
</head>

<body>
    <?php include('headerTeacher.php') ?>
    <section class="slice bg-section-secondary">
        <div class="content will-help-you">
            <div class="container">
                <div class="row" style="flex-direction: column; ">
                    <form method="post">
                        <?php $query = "SELECT * FROM `test-results` WHERE idusers = " . $_GET['idusers'] . "";
                        $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                        $query2 = "SELECT * FROM `users` WHERE idusers = " . $_GET['idusers'] . "";
                        $result2 = mysqli_query($GLOBALS['db'], $query2) or die(mysqli_error($GLOBALS['db']));
                        if ($result) {
                            $rows = mysqli_num_rows($result);
                            $row2 = mysqli_fetch_array($result2);
                            echo "
              <div style = 'height: 30rem;'>
              <div class=' position-relative'>
              <h2 class='display-5 text-shadow font-weight-bold' style='margin-bottom: 50px; color:#00090b; margin-bottom: 3rem;'>
              Результаты тестов <span id = 'group' class='text-muted'>" . $row2['fullname'] . "</span></h2>
              <div class = 'table-responsive-md'>
              <table class = 'table' style = 'width: 40%;'>
              <thead><th>Название теста</th><th>Оценка</th></thead>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                $query2 = "SELECT * FROM tests WHERE idtests = " . $row['idtests'] . "";
                                $result2 = mysqli_query($GLOBALS['db'], $query2);
                                while ($row2 = mysqli_fetch_array($result2)) {
                                    echo "<td>" . $row2['testtitle'] . "</td>";
                                }
                                echo "<td>" . $row['mark'] . "</td></tr>";
                            }
                            echo "</table>
              <div class='position-absolute d-md-block image-container' style = 'top: 40px; right: 0;'>
                <img alt='lecture image' src='./assets/professor-animate.svg' style = 'width: 40rem !important;'>
              </div>
            </div>
           </div>
         </div>";
                            mysqli_free_result($result);
                        }
                        ?>
                </div>
                </form>
                <div class="row text-center">
                    <div class="col-md-4 ">
                        <h2>Луший результат</h2>
                        <p class="student-records"><?php $query = "SELECT MAX(mark) AS maxMark FROM `test-results` WHERE idusers = " . $_GET['idusers'] . " ";
                                                    $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                                                    $row = mysqli_fetch_array($result);
                                                    echo $row['maxMark'];
                                                    ?></p>

                    </div>
                </div>
                <section class="slice bg-section-secondary">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <h2>Название теста</h2>
                                <div><?php $query = "SELECT * FROM tests";
                                                            $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                                                            if ($result) {
                                                                while ($row = mysqli_fetch_array($result)) {
                                                                    echo "<p class='score'>" . $row['testtitle'] . "</p>";
                                                                }
                                                            } ?></div>
                            </div>
                            <div class="col-md-4">
                                <h2>Колличество попыток</h2>
                                <div><?php $query = "SELECT idusers, COUNT(*) AS total FROM `test-results` WHERE idusers = '" . $_GET['idusers'] . "'  GROUP BY idtests";
                                                            $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                echo "<p class='score'>" . $row['total'] . "</p>";
                                                            }
                                                            ?></p></div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </section>
</body>

</html>