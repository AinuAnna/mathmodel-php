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
         echo '<title>Панель администратора | Заявки</title>';
    } else {
       echo '<title>Кабинет преподавателя | Заявки</title>';
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
                        Заявки учащихся</h2>
                    <?php
                    $query2 = "SELECT * FROM `requests`;";
                    $result2 = mysqli_query($GLOBALS['db'], $query2) or die(mysqli_error($GLOBALS['db']));
                    $count = 0;
                    while ($row2 = mysqli_fetch_array($result2)) {
                        $request = $row2['textrequest'];
                        $query = "SELECT * FROM users WHERE idusers = " . $row2['user'] . "";
                        $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                        $row = mysqli_fetch_array($result);
                        $fullname = $row['fullname'];
                        $email = $row['email'];
                        $avatar = $row['avatar'];
                        $idrequest = $row2['idrequest'];
                        echo ' <form method="post" action ="" style = "width:70%" onsubmit="return confirmDesactiv()">
                        <div class="row align-items-center py-3 border-top border-bottom"> 
                        <span style = "display:none" id = req>' . $idrequest . '</span>
                        <input id = "reqNew" style = "display:none" type="text" />
                        <div class="col-auto">
                        <div class="avatar avatar-lg">
                            <img src="';
                        echo $avatar;
                        if ($avatar == NULL) {
                            echo " ../assets/user-avatar.svg";
                        }
                        echo '" style = "object-fit: cover;" class="avatar-img rounded-circle" width = 40px height = 40px>
                        </div>
                    </div>
                    <div class="col ms-n5">
                        <h6 class="text-uppercase mb-0">';
                        echo $fullname;
                        echo '</h6>
                        <span class="text-muted mb-0">';
                        echo $email;
                        echo '</span>
                    </div>
                    <div class="col-auto">
                        <span class="h6 text-uppercase text-muted d-none d-md-inline me-4">
                        <input class="review-block-description" style = "display:none" id = "idrequest" name = "requestid[' . $idrequest . ']">' . $request . '</input>';
                        echo '</span>
                    </div>
                    <button class="btn btn-primary" name="reqyes[' . $count . ']" id="reqtyes" type = "submit">✔️</button>
            </div>
            </form>
           ';
                        $count++;
                    } ?>
                </div>
            </div>
    </section>
</body>
<?php
if (isset($_POST["reqyes"])) {
    $newReq = $_POST['requestid'];

    foreach ($newReq as $i => $value) {
        $query = "DELETE FROM `requests` WHERE idrequest =" . $i . "";
    }
    $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
    include("notification.php");
}
?>
</html>