<?php
session_start();
include("bd.php");
?>
<script type='text/javascript'>
    document.addEventListener('DOMContentLoaded', function() {
        window.setTimeout(document.querySelector('svg').classList.add('animated'), 1000);
    })
</script>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
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
                            <form method="post">
                                <?php $query = "SELECT * FROM users WHERE idusers = " . $_SESSION['idusers'] . "";
                                $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                                $row = mysqli_fetch_array($result);
                                $fullname = $row['fullname'];
                                $email = $row['email'];
                                $numbergroup = $row['numbergroup'];
                               
                                if ($numbergroup == NULL) {
                                    $numbergroup =  "<a style = 'color:#bd2130;'>!!! Вы не указали его при регистрации, обратитесь к администратору !!!!</a>";
                                }
                                if ($row["groupsid"]) {
                                    $query2 = "SELECT * FROM `groups` WHERE idgroups = " . $row['groupsid'] . "";
                                    $result2 = mysqli_query($GLOBALS['db'], $query2);
                                    while ($row2 = mysqli_fetch_array($result2)) {
                                        $group =  "<a" . $row['idgroups'] . ">" . $row2['namegroup'] . "</a>";
                                        $query3 = "SELECT * FROM `departments` WHERE iddepartments = " . $row2['iddepartments'] . "";
                                        $result3 = mysqli_query($GLOBALS['db'], $query3);
                                        while ($row3 = mysqli_fetch_array($result3)) {
                                            $department =  "<a" . $row3['iddepartments'] . ">" . $row3['departmentname'] . "</a>";
                                        }
                                        $query4 = "SELECT * FROM `specialties` WHERE idspecialty = " . $row2['idspecialty'] . "";
                                        $result4 = mysqli_query($GLOBALS['db'], $query4);
                                        while ($row4 = mysqli_fetch_array($result4)) {
                                            $speciality =  "<a" . $row4['idspecialty'] . ">" . $row4['namespec'] . "</a>";
                                        }
                                        $groupnumber =  "<a" . $row2['idgroups'] . ">" . $row2['groupnumber'] . "</a>";
                                        $query8 = "SELECT * FROM `courses` WHERE idcourses = " . $row2['idcourses'] . "";
                                        $result8 = mysqli_query($GLOBALS['db'], $query8);
                                        while ($row8 = mysqli_fetch_array($result8)) {
                                            $course =  "<a" . $row8['idcourses'] . ">" . $row8['coursenumber'] . "</a>";
                                        }
                                    }
                                } else {
                                    $group = "<a style = 'color:#bd2130;'>!!! У вас пока нет группы !!!!</a>";
                                }                               
                                echo '
                            <div class="row featurette">
                                <div class="col-md-5">
                                <h2 class="featurette-heading" style = "margin-bottom: 25px;">Здравствуйте, <span id = "group" class="text-muted"> ' . $fullname . '.</span></h2>
                                <p class="lead">Данная программа обучения поможет Вам в освоении учебной дисциплины "Математическое моделирование". Ваша группа на протяжении курса —  <span id = "group" class="text-muted"> ' . $group . '.</span></p>';
                                if (!$row["groupsid"]) {
                                    $query10 = "SELECT user FROM `requests` WHERE user = " . $_SESSION['idusers'] . "";
                                    $result10 = mysqli_query($GLOBALS['db'], $query10) or die(mysqli_error($GLOBALS['db']));
                                    $row10 = mysqli_fetch_array($result10);
                                    if ($row10['user'] != NULL) {
                                        echo '<p><span style = "color:#4a8684!important" class="text-muted" >Вы уже подали заявку на вступление в группу. Подождите немного!</span></p>';
                                    } else {
                                        echo '
                                            <div style="margin-bottom: 1rem;">
                                                <input id="ratings-hidden" name="rating" type="hidden">
                                                <textarea class="form-control animated" cols="50" id="new-review" name="request" placeholder="Введите сюда текст заявки: курс, отделение, специальность." rows="5" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 54px;"></textarea>
                                            </div>
                                            <div class="text-right">
                                                <button class="btn btn-primary" id="sendRequest" type="submit" name="sendRequest">Подать заявку</button>
                                            </div>';
                                    }
                                    echo '<p class="lead">Ваш номер группы в колледже —  <span id = "group" class="text-muted"> ' . $numbergroup . '.</span> Вы можете подать заявку на вступление в группу учащихся, которые будут с вами на протяжении курса, а так же получить преподавателя, который будет вас курировать.</p>';

                                }

                                echo '</div>
                            </div>
                                <div class="position-absolute d-md-block image-container" style = "top: 0; right: 0;">
                                    <img alt="lecture image" src="../assets/mathematics-animate (2).svg" style = "width: 40rem !important;"">
                                </div>
                            </div>
                            </div>';
                                ?>
                        </div>
                        <?php if (isset($_POST['sendRequest'])) {
                            if (!$_POST["request"]) {
                                echo "Вы не ввели заявку. Попробуйте еще раз";
                                exit();
                            }
                            $query = "INSERT INTO requests (idrequest, textrequest, user)
                                    VALUES (NULL, '" . $_POST['request'] . "', '" . $_SESSION['idusers'] . "');";
                            $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                            include("notification.php");
                        } ?>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    if ($row["groupsid"]) {
        echo '<section class="slice bg-section-secondary">
                <div class="container">
                    <div class="row">
                      <div class="col-md-3">
                        <h4>Ваше отделение</h4>
                        <p class = "pinfo">' . $department . '</p>
                      </div>
                      <div class="col-md-3">
                      <h4>Ваш курс</h4>
                        <p class = "pinfo">' . $course . '</p>
                      </div>
                      <div class="col-md-3">
                      <h4>Ваш номер группы</h4>
                        <p class = "pinfo">' . $groupnumber . '</p>
                      </div>
                      <div class="col-md-3">
                      <h4>Ваша специальность</h4>
                      <p class = "pinfo">' . $speciality . '</p>
                    </div>
                    </div>
                    <hr>
                  </div>
                </section>';
    } ?>
</body>

</html>