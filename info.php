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
                    <div class=' position-relative'>
                        <div class='table-responsive-md'>
                            <?php $query = "SELECT * FROM users WHERE idusers = " . $_SESSION['idusers'] . "";
                            $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                            $row = mysqli_fetch_array($result);
                            $fullname = $row['fullname'];
                            $email = $row['email'];

                            if ($row["groupsid"]) {
                                $query2 = "SELECT * FROM `groups` WHERE idgroups = " . $row['groupsid'] . "";
                                $result2 = mysqli_query($GLOBALS['db'], $query2);
                                while ($row2 = mysqli_fetch_array($result2)) {
                                    $group =  "<a" . $row['idgroups'] . "'>" . $row2['namegroup'] . "</a>";
                                }
                            } else {
                                $group =   "<a style = 'color: #dc3545;'>!!! У вас пока нет группы !!!!</a>";
                            }
                            echo '
                            <div class="row featurette">
                                <div class="col-md-5">
                                <h2 class="featurette-heading" style = "margin-bottom: 25px;">Здравствуйте, <span id = "group" class="text-muted"> ' . $fullname . '.</span></h2>
                                <p class="lead">Данная программа обучения поможет Вам в освоении учебной дисциплины "Математическое моделирование". Ваша группа на протяжении курса —  <span id = "group" class="text-muted"> ' . $group . '.</span></p>
                                </div>
                            </div>
                                <div class="position-absolute d-md-block image-container" style = "top: 0; right: 0;">
                                    <img alt="lecture image" src="./assets/mathematics-animate (2).svg" style = "width: 40rem !important;"">
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
</body>

</html>