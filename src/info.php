<?php
session_start();
include("bd.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head.php') ?>
    <title>Личный кабинет | Информация</title>
</head>

<body>
    <?php include('headerStudent.php') ?>
    <section class="slice bg-section-secondary">
        <div class="content will-help-you">
            <div class="container">
                <div class="row" style="flex-direction: column; align-items: center;">
                    <h2 class="display-5 text-shadow font-weight-bold" style="margin-bottom: 50px; color:#00090b;">Добро
                        пожаловать в личный кабинет!</h2>
                    <div class="position-relative">
                        <div class="table-responsive-md">
                            <?php $query = "SELECT * FROM users WHERE idusers = " . $_SESSION['idusers'] . "";
                            $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                            $row = mysqli_fetch_array($result);
                            $fullname = $row['fullname'];
                            $email = $row['email'];

                            if ($row["groupsid"]) {
                                $query3 = "SELECT * FROM `groups` WHERE idgroups = " . $row['groupsid'] . "";
                                $result3 = mysqli_query($GLOBALS['db'], $query3);
                                    while ($row3 = mysqli_fetch_array($result3)) {
                                        $query4 = "SELECT * FROM `departments` WHERE iddepartments = " . $row3['iddepartments'] . "";
                                        $result4 = mysqli_query($GLOBALS['db'], $query4);
                                            while ($row4 = mysqli_fetch_array($result4)) {
                                                $department =  "<a" . $row4['iddepartments'] . ">" . $row4['departmentname'] . "</a>";
                                            }
                                    }
                            } else {
                                $department =   "<a style = 'color:#bd2130;'>!!! Ваше отделение пока не записано!!!!</a>";
                            }
                            if ($row["groupsid"]) {
                                $query5 = "SELECT * FROM `groups` WHERE idgroups = " . $row['groupsid'] . "";
                                $result5 = mysqli_query($GLOBALS['db'], $query5);
                                    while ($row5 = mysqli_fetch_array($result5)) {
                                        $query6 = "SELECT * FROM `group-numbers` WHERE idnumbers = " . $row5['idnumbers'] . "";
                                        $result6 = mysqli_query($GLOBALS['db'], $query6);
                                            while ($row6 = mysqli_fetch_array($result6)) {
                                                $number =  "<a" . $row6['idnumbers'] . ">" . $row6['groupnumber'] . "</a>";
                                            }
                                    }
                            } else {
                                $number =   "<a style = 'color:#bd2130;'>!!! Ваш номер группы еще не записан!!!!</a>";
                            }
                            if ($row["groupsid"]) {
                                $query7 = "SELECT * FROM `groups` WHERE idgroups = " . $row['groupsid'] . "";
                                $result7 = mysqli_query($GLOBALS['db'], $query7);
                                    while ($row7 = mysqli_fetch_array($result7)) {
                                        $query8 = "SELECT * FROM `courses` WHERE idcourses = " . $row7['idcourses'] . "";
                                        $result8 = mysqli_query($GLOBALS['db'], $query8);
                                            while ($row8 = mysqli_fetch_array($result8)) {
                                                $course =  "<a" . $row8['idcourses'] . ">" . $row8['coursenumber'] . "</a>";
                                            }
                                    }
                            } else {
                                $course =   "<a style = 'color:#bd2130;'>!!! Ваш номер курса еще не записан!!!!</a>";
                            }
                            if ($row["groupsid"]) {
                                $query2 = "SELECT * FROM `groups` WHERE idgroups = " . $row['groupsid'] . "";
                                $result2 = mysqli_query($GLOBALS['db'], $query2);
                                while ($row2 = mysqli_fetch_array($result2)) {
                                    $group =  "<a" . $row['idgroups'] . ">" . $row2['namegroup'] . "</a>";
                                }
                            } else {
                                $group =   "<a style = 'color:#bd2130;'>!!! У вас пока нет группы !!!!</a>";
                            }
                            echo '
                            <div class="row featurette">
                                <div class="col-md-5">
                                <h2 class="featurette-heading" style = "margin-bottom: 25px;">Здравствуйте, <span id = "group" class="text-muted"> ' . $fullname . '.</span></h2>
                                <p class="lead">Данная программа обучения поможет Вам в освоении учебной дисциплины "Математическое моделирование". Ваша группа на протяжении курса —  <span id = "group" class="text-muted"> ' . $group . '.</span></p>
                                </div>
                            </div>
                                <div class="position-absolute d-md-block image-container" style = "top: 0; right: 0;">
                                    <img alt="lecture image" src="../assets/mathematics-animate (2).svg" style = "width: 40rem !important;"">
                                </div>
                            </div>
                            </div>';
                            ?>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="slice bg-section-secondary">
    <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h2>Ваше отделение</h2>
            <p><?php echo $department; ?></p>
          </div>
          <div class="col-md-4">
            <h2>Ваш курс</h2>
            <p><?php echo $number; ?> </p>
          </div>
          <div class="col-md-4">
            <h2>Ваш номер группы</h2>
            <p><?php echo $course; ?></p>
          </div>
        </div>
        <hr>
      </div>
    </section>
</body>

</html>