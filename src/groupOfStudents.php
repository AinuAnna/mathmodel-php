<?php
session_start();
include("bd.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head.php') ?>
    <title>Кабинет преподавателя | Группы</title>
</head>

<body>
    <?php include('headerTeacher.php') ?>
    <section class="slice bg-section-secondary">
        <div class="content will-help-you">
            <div class="container" style="padding: 90px 0px;">
                <div class="row" style="flex-direction: column; align-items: center;">
                    <?php $query = "SELECT namegroup FROM `groups` WHERE idgroups =  " . $_GET['idgroups'] . "";
                    $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                    $row = mysqli_fetch_array($result);
                    echo '<h2 class="display-5 text-shadow font-weight-bold" style="margin-bottom: 50px; color:#00090b;">Название группы: <span id = "group" class="text-muted">
                       "' . $row['namegroup'] . '"</span></h2>'; ?>
                    <?php
                    $query2 = "SELECT * FROM `users` WHERE groupsid = ".$_GET['idgroups']."";
                    $result2 = mysqli_query($GLOBALS['db'], $query2) or die(mysqli_error($GLOBALS['db']));
                    if ($result2) {
                        $rows2 = mysqli_num_rows($result2);

                        echo "
                      <div class = 'container-fluid p-2'>
                      <div class = 'table-responsive-md mt-4'>
                      <table class = 'table'>
                      <thead><th>Идентификатор учащегося</th><th>Имя учащегося</th><th>Эл. Почта</th><th>Результаты тестов</th></thead>";
                      if ($result2->num_rows) {
                            while ($row2 = mysqli_fetch_array($result2)) {
                                if ($row2['groupsid'] != NULL) {
                                    echo "<tr>";
                                    echo "<td>" . $row2['idusers'] . "</td>";
                                    echo "<td>" . $row2['fullname'] . "</td>";
                                    echo "<td>" . $row2['email'] . "</td>";
                                    echo "<td><button class='btn btn-primary' name='openButton' id='openButton' type='submit'><a href = 'resultsForTeacher.php?idusers=" . $row2['idusers'] . "'>Открыть</a></button></td>";
                                    echo "</tr>";
                                }
                            }
                        } else {
                            echo "<tr><td colspan = '4' class = 'text-center text-muted'>Вы еще не добавили студентов в эту группу</td></tr>";
                        }
                        echo "</table>
                       </div>
                      </div>";
                    }
                    ?>
                    <?php if (isset($_POST['openButton'])) {
                        header('location: groupOfStudents.php');
                    } ?>

                </div>
            </div>
        </div>
    </section>
</body>

</html>