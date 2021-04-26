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
                    <h2 class="display-5 text-shadow font-weight-bold" style="margin-bottom: 50px; color:#00090b;">
                        Группы учащихся</h2>
                    <?php
                    $query = "SELECT * FROM `groups`";
                    $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                    if ($result) {
                        $rows = mysqli_num_rows($result);

                        echo "
                      <div class = 'container-fluid p-2'>
                      <div class = 'table-responsive-md mt-4'>
                      <table class = 'table'>
                      <thead><th>Идентификатор группы</th><th>Отделение</th><th>Курс</th><th>Номер группы</th><th>Описание</th><th>Действия</th></thead>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['idgroups'] . "</td>";
                            $query2 = "SELECT * FROM `departments` WHERE iddepartments = " . $row['iddepartments'] . "";
                            $result2 = mysqli_query($GLOBALS['db'], $query2);
                            while ($row2 = mysqli_fetch_array($result2)) {
                                echo "<td>" . $row2['departmentname'] . "</td>";
                            }
                            $query3 = "SELECT * FROM `courses` WHERE idcourses = " . $row['idcourses'] . "";
                            $result3 = mysqli_query($GLOBALS['db'], $query3);
                            while ($row3 = mysqli_fetch_array($result3)) {
                                echo "<td>" . $row3['coursenumber'] . "</td>";
                            }
                            $query4 = "SELECT * FROM `group-numbers` WHERE idnumbers = " . $row['idnumbers'] . "";
                            $result4 = mysqli_query($GLOBALS['db'], $query4);
                            while ($row4 = mysqli_fetch_array($result4)) {
                                echo "<td>" . $row4['groupnumber'] . "</td>";
                            }
                            echo "<td>" . $row['namegroup'] . "</td>";
                            echo "<td><button class='btn btn-primary' name='openButton' id='openButton' type='submit'>Открыть</button></td>";
                            echo "</tr>";
                        }
                        echo "</table>
                       </div>
                      </div>";
                        mysqli_free_result($result);
                    }
                    ?>

                </div>
                <label class="form-label" for="idgroups">Идентификатор группы:</label>
                <form class="form-validate" method="post">
                    <input class="delete-id" name="idgroups" id="idgroups" type="text" placeholder="1" autocomplete="off" required="" data-msg="Пожалуйста введите идентификатор">
                    <button class="btn btn-primary" name="deleteButton" id="deleteButton" type="submit">Удалить</button>
                </form>
                <?php
                if (isset($_POST["deleteButton"])) {
                    if (!empty($_POST['idgroups'])) {
                        $idgroups = htmlspecialchars($_POST['idgroups']);
                        $query = "DELETE FROM users WHERE idgroups ='$idgroups';";
                        $result = mysqli_query($GLOBALS["db"], $query);
                        include("notification.php");
                    } else echo "<div class=\"alert alert-warning alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Все поля должны быть заполнены!</div>";
                }
                ?>
            </div>

        </div>
        </div>
    </section>
</body>

</html>