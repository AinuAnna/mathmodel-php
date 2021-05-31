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
    echo ' <title>Панель администратора | Отзывы</title>';
  } else if ($_SESSION['roleid'] == 3){
    echo ' <title>Кабинет преподавателя | Отзывы</title>';
  }else {
    echo ' <title>Личный кабинет | Отзывы</title>';
  }  ?>
</head>

<body>
<?php if ($_SESSION['roleid'] == 1) {
    include('headerAdmin.php');
  } else if($_SESSION['roleid'] == 3){
    include('headerTeacher.php');
  }
  else{
    include('headerStudent.php');  
  } ?>
    <section class="slice bg-section-secondary">
        <div class="content will-help-you">
            <div class="container">
                <div class="row" style="flex-direction: column; align-items: center;">
                    <h2 class="display-5 text-shadow font-weight-bold" style="margin-bottom: 50px; color:#00090b;">Отзывы о курсе</h2>
                    <?php
                    $query = "SELECT * FROM `comments`";
                    $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                    $count = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        $query2 = "SELECT * FROM `users` WHERE idusers = " . $row['idusers'] . "";
                        $result2 = mysqli_query($GLOBALS['db'], $query2) or die(mysqli_error($GLOBALS['db']));
                        $row2 = mysqli_fetch_array($result2);
                        $avatar = $row2['avatar'];
                        $textcomment =  $row['textcomment'];
                        $idcomments =  $row['idcomments'];
                        $fullname = $row2['fullname'];
                        $datatime = $row['datatime'];
                        $dt = new DateTime($datatime, new DateTimeZone('UTC'));
                        $dt->setTimezone(new DateTimeZone('Europe/Minsk'));
                        echo '<div class="col-sm-7">
                        <hr>
                        <form method="post" onsubmit="return confirmDesactiv()">
                        <div class="review-block"><div class="row">
                        <div class="col-sm-3">';
                        if ($_SESSION['roleid'] == 2) {
                            if ($avatar == '') {
                                echo '<img src="../assets/user-avatar.svg" class="rounded-circle" width = 70px height = 70px style = "object-fit: cover;">';
                            } else {
                                echo '<img src="' . $avatar . '" class="rounded-circle" width = 70px height = 70px style = "object-fit: cover;">';
                            }
                            echo '<div class="review-block-name"><span id = "group" class="text-muted">' . $fullname . '</span></div>
                            <div class="review-block-date">' . $dt->format('Y-m-d H:i:s') . '</div>
                        </div>
                        <div class="col-sm-9">
                            <div class="review-block-description">' . $textcomment . '</div>
                        </div>
                    </div>
                    </div> </form>
                    </div>';
                        } else {
                            if ($avatar == '') {
                                echo '<img src="../assets/user-avatar.svg" class="rounded-circle" width = 70px height = 70px style = "object-fit: cover;">';
                            } else {
                                echo '<img src="' . $avatar . '" class="rounded-circle" width = 70px height = 70px style = "object-fit: cover;">';
                            }
                            echo '<div class="review-block-name"><span id = "group" class="text-muted">' . $fullname . '</span></div>
                            <div class="review-block-date">' . $dt->format('Y-m-d H:i:s') . '</div>
                        </div>
                      
                        <div class="col-sm-9">
                            <input class="review-block-description" style = "display:none" id = idcomments name = "comments[' . $idcomments . ']">' . $textcomment . '</input>
                            <button class="btn btn-primary" style = "margin-top: 3rem; float: right" name="deleteComment[' . $count . ']" id="deleteComment" type = "submit">❌</button>
                            </div>
                    </div>
                    </div></form>
                    </div>';
                        }
                        $count++;
                    } ?>

                </div>
                <div class="container" style="margin: 0; padding-top: 20px !important;">
                    <div class="row" style="flex-direction: column; align-items: center;">
                            <form style = "width: 60%" accept-charset="UTF-8" action="" method="post">
                                <div style="margin-bottom: 1rem;">
                                    <input id="ratings-hidden" name="rating" type="hidden">
                                    <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Введите сюда свой отзыв..." rows="5" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 54px;"></textarea>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary" id="saveComments" type="submit" name="saveComments">Отправить</button>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['saveComments'])) {
                                if (!$_POST["comment"]) {
                                    echo "Вы не ввели отзыв. Вернитесь назад и попробуйте еще раз";
                                    exit();
                                }
                                $query = "INSERT INTO comments (idcomments, textcomment, idusers, datatime)
                                VALUES (NULL, '" . $_POST['comment'] . "', '" . $_SESSION['idusers'] . "', now());";
                                $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                                include("notification.php");
                            }
                            ?>
                        <?php if ($_SESSION['roleid'] == 1 or $_SESSION['roleid'] == 3 ) {
                            if (isset($_POST["deleteComment"])) {
                                $comments = $_POST['comments'];
                                foreach ($comments as $j => $key) {
                                    $sql .= "DELETE FROM comments WHERE idcomments ='$j'; ";
                                }
                                $result = mysqli_multi_query($GLOBALS['db'], $sql);
                                include('notification.php');
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
