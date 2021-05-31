<?php
session_start();
include("bd.php");
include("confirm.php");
?>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('head.php') ?>
  <?php if ($_SESSION['roleid'] == 1) {
    echo ' <title>Панель администратора | Группы</title>';
  } else {
    echo ' <title>Кабинет преподавателя | Группы</title>';
  } ?>
</head>

<body>
  <?php if ($_SESSION['roleid'] == 1) {
    include('headerAdmin.php');
  } else {
    include('headerTeacher.php');
  } ?>
    <section class="slice bg-section-secondary">
        <div class="content will-help-you">
            <div class="container" style="padding: 90px 0px;">
                <div class="row" style="flex-direction: column; align-items: center;">
                    <h2 class="display-5 text-shadow font-weight-bold" style="margin-bottom: 50px; color:#00090b;">
                        Группы учащихся</h2>
                    <?php
                    if ($_SESSION['roleid'] == 3) {
                        $query = "SELECT * FROM `groups` WHERE idteacher =  " . $_SESSION['idusers'] . "";
                    } else {
                        $query = "SELECT * FROM `groups`";
                    }
                    $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                    if ($result) {
                        $rows = mysqli_num_rows($result);

                        echo "
                      <div class = 'container-fluid p-2 '>
                      <div class = 'table-responsive-md mt-4'>
                      <table class = 'table '>
                      <thead><th>Идентификатор группы</th><th>Отделение</th><th>Специальность</th><th>Курс</th><th>Номер группы</th><th>Описание</th><th>Действия</th></thead>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['idgroups'] . "</td>";
                            $query2 = "SELECT * FROM `departments` WHERE iddepartments = " . $row['iddepartments'] . "";
                            $result2 = mysqli_query($GLOBALS['db'], $query2);
                            while ($row2 = mysqli_fetch_array($result2)) {
                                echo "<td>" . $row2['departmentname'] . "</td>";
                            }
                            $query4 = "SELECT * FROM `specialties` WHERE idspecialty = " . $row['idspecialty'] . "";
                            $result4 = mysqli_query($GLOBALS['db'], $query4);
                            while ($row4 = mysqli_fetch_array($result4)) {
                                echo "<td>" . $row4['namespec'] . "</td>";
                            }
                            $query3 = "SELECT * FROM `courses` WHERE idcourses = " . $row['idcourses'] . "";
                            $result3 = mysqli_query($GLOBALS['db'], $query3);
                            while ($row3 = mysqli_fetch_array($result3)) {
                                echo "<td>" . $row3['coursenumber'] . "</td>";
                            }
                            echo "<td>" . $row['groupnumber'] . "</td>";
                            echo "<td>" . $row['namegroup'] . "</td>";
                            echo "<td><button class='btn btn-primary' name='openButton' id='openButton' type='submit'><a href = 'groupOfStudents.php?idgroups=" . $row['idgroups'] . "'>Открыть</a></button></td>";
                            echo "</tr>";
                        }

                        echo "</table>
                       </div>
                      </div>";
                        mysqli_free_result($result);
                    }
                    ?>
                    <?php if (isset($_POST['openButton'])) {
                        header('location: groupOfStudents.php');
                    } ?>

                </div>
                <div class="card w-50 mb-4 box-shadow" style="float: right;">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Добавление групп</h4>
                    </div>
                    <div class="card-body">
                        <ul class="mt-3 mb-4">
                            <li>Перейдите на страницу создания нажав кнопку ниже</li>
                            <li>Выберите нужные параметры</li>
                            <li>Введите название(описание) группы</li>
                            <li>Добавьте студентов</li>
                            <li>Сохраните новые данные</li>
                        </ul>
                        <div class="col-md-12 text-center">
                            <a href='addgroups.php'><button class="btn btn-primary" name="createNew" id="createNew">Создать</button></a>
                        </div>
                    </div>
                </div>
                <label class="form-label" for="idgroups">Идентификатор группы:</label>
                <form class="form-validate d-flex" onsubmit="return confirmDesactiv()" method="post" style="width: 30% !important">
                    <input class="delete-id form-control" name="idgroups" id="idgroups" type="text" placeholder="1" autocomplete="off" required="" data-msg="Пожалуйста введите идентификатор">&nbsp;
                    <button class="btn btn-primary" name="deleteButton" id="deleteButton" type="submit">❌</button>
                </form>
                <?php
                if (isset($_POST["deleteButton"])) {
                    if (!empty($_POST['idgroups'])) {
                        $idgroups = htmlspecialchars($_POST['idgroups']);
                        $query = "DELETE FROM `groups` WHERE idgroups ='$idgroups';";
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