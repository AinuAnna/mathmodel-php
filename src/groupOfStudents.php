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
                    $query = "SELECT * FROM `users`";
                    $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                    if ($result) {
                        $rows = mysqli_num_rows($result);

                        echo "
                      <div class = 'container-fluid p-2'>
                      <div class = 'table-responsive-md mt-4'>
                      <table class = 'table'>
                      <thead><th>Идентификатор учащегося</th><th>Имя учащегося</th><th>Результаты тестов</th></thead>";
                        while ($row = mysqli_fetch_array($result)) {
                            if($row['groupsid'] != NULL){
                            echo "<tr>";
                            echo "<td>" . $row['idusers'] . "</td>";
                            echo "<td>" . $row['fullname'] . "</td>";
                            echo "<td><button class='btn btn-primary' name='openButton' id='openButton' type='submit'><a href = '/src/resultsForTeacher.php?idusers=" . $row['idusers'] . "'>Открыть</a></button></td>";
                            echo "</tr>";
                        }
                    }
                        echo "</table>
                       </div>
                      </div>";
                        mysqli_free_result($result);
                    }
                    ?>
                    <?php if(isset($_POST['openButton'])){
                          header('location: /src/groupOfStudents.php');
                    }?>

                </div>
            </div>
        </div>
    </section>
</body>

</html>