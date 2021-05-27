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
    <title>Кабинет преподавателя | Группы</title>
</head>

<body>
    <?php include('headerTeacher.php') ?>
    <section class="slice bg-section-secondary">
        <div class="content will-help-you">
            <div class="container" style="padding: 90px 0px;">
                <div class="row" style="flex-direction: column; align-items: center;">
                    <form class="form-validate" method="post">
                        <?php $query = "SELECT namegroup FROM `groups` WHERE idgroups =  " . $_GET['idgroups'] . "";
                        $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                        $row = mysqli_fetch_array($result);
                        echo '<h2 class="display-5 text-shadow font-weight-bold" style="margin-bottom: 50px; color:#00090b;">Название группы: <span id = "group" class="text-muted">
                       "' . $row['namegroup'] . '"</span></h2>'; ?>
                        <?php
                        $query2 = "SELECT * FROM `users` WHERE groupsid = " . $_GET['idgroups'] . "";
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
                        <button class='btn btn-primary' name='addStudent' id='addStudent' type='submit'>Добавить студента в группу</button>
                        <button class='btn btn-primary' name='deleteStudent' id='deleteStudent' style = "float:right;" type='submit'>Удалить студента из группы</button>
                        </form>
                        <?php if (isset($_POST['addStudent'])) {
                            echo '<form class="form-validate" method="post" style = "width:66%"  onsubmit="return confirmActiv()"><div class="my-3 bg-white rounded box-shadow">
                       <h4 class="border-bottom border-gray pb-2 mb-0">Список учащихся</h4>';
                            $query = "SELECT * FROM `users` WHERE `groupsid` IS NULL AND roleid = 2";
                            $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                            if ($result) {
                                $rows = mysqli_num_rows($result);
                                $count = 0;
                                while ($row = mysqli_fetch_array($result)) {
                                    $id = $row['idusers'];
                                    echo ' <div class="media text-muted pt-3" >
                              
                               <img alt="50x50" class="mr-3" src="';
                                    if ($row['avatar'] == '') {
                                        echo '../assets/user-avatar.svg';
                                    } else {
                                        echo $row['avatar'];
                                    }
                                    $email = $row['email'];
                                    $fullname = $row['fullname'];
                                    $numbergroup = $row['numbergroup'];
                                    echo '"';
                                    echo 'style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%">
                               <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                               <div class="d-flex justify-content-between align-items-center w-100">
                               <strong class="text-gray-dark">' . $email . '</strong>
                               <input type = "checkbox" style = "height: 1rem; width: 1rem;" id = "check" name = "user[' . $count . '][' . $id  . ']"/>
                               </div>
                               <span class="d-block">' . $fullname . '</span><span class="d-block">' . $numbergroup . '</span>
                               </div></div>';
                                    $count++;
                                }
                            }
                            echo '</div><button class="btn btn-primary" id="saveStudent" type="submit" name="saveStudent">Добавить</button></form>';
                        } ?>
                        <?php if (isset($_POST['deleteStudent'])) {
                            echo '<form class="form-validate" style = "width:66%" method="post" onsubmit="return confirmDesactiv()"><div class="my-3 bg-white rounded box-shadow">
                       <h4 class="border-bottom border-gray pb-2 mb-0">Список учащихся</h4>';
                            $query = "SELECT * FROM `users` WHERE `groupsid` = {$_GET['idgroups']}";
                            $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                            if ($result) {
                                $rows = mysqli_num_rows($result);
                                $count = 0;
                                while ($row = mysqli_fetch_array($result)) {
                                    $id = $row['idusers'];
                                    echo ' <div class="media text-muted pt-3" >
                              
                               <img alt="50x50" class="mr-3" src="';
                                    if ($row['avatar'] == '') {
                                        echo '../assets/user-avatar.svg';
                                    } else {
                                        echo $row['avatar'];
                                    }
                                    $email = $row['email'];
                                    $fullname = $row['fullname'];
                                    $numbergroup = $row['numbergroup'];
                                    echo '"';
                                    echo 'style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%">
                               <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                               <div class="d-flex justify-content-between align-items-center w-100">
                               <strong class="text-gray-dark">' . $email . '</strong>
                               <input type = "checkbox" style = "height: 1rem; width: 1rem;" id = "check" name = "user[' . $count . '][' . $id  . ']"/>
                               </div>
                               <span class="d-block">' . $fullname . '</span><span class="d-block">' . $numbergroup . '</span>
                               </div></div>';
                                    $count++;
                                }
                            }
                            echo '</div><button class="btn btn-primary" id="delStudent" type="submit" name="delStudent">Удалить</button></form>';
                        } ?>
               
                    <?php
                        if (isset($_POST['saveStudent'])) {
                            $users = $_POST['user'];
                            $groupid = $_GET['idgroups'];

                            foreach ($users as $j => $key) {
                                foreach ($key as $i => $value) {
                                    $sql .= "UPDATE `users` SET `groupsid` = '{$groupid}' WHERE `idusers` = '{$i}'; ";
                                    $query10 = "SELECT * FROM `requests` WHERE user = '{$i}'";
                                    $result10 = mysqli_query($GLOBALS['db'], $query10);
                                    if ($result10 != NULL) {
                                        $sql .= "DELETE FROM `requests` WHERE user =" . $i . "";
                                    }
                                }
                            }

                            if (mysqli_multi_query($GLOBALS['db'], $sql)) {
                                echo "New records created successfully";
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($GLOBALS['db']);
                            }
                        } ?>
                         <?php
                        if (isset($_POST['delStudent'])) {
                            $users = $_POST['user'];
                            $groupid = $_GET['idgroups'];

                            foreach ($users as $j => $key) {
                                foreach ($key as $i => $value) {
                                    $sql .= "UPDATE `users` SET `groupsid` = NULL WHERE `idusers` = '{$i}'; ";
                                }
                            }

                            if (mysqli_multi_query($GLOBALS['db'], $sql)) {
                                echo "New records created successfully";
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($GLOBALS['db']);
                            }
                        } ?>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<script>
    $(document).ready(function() {
        var $check = $('#check');
        $check.click(function(e) {
            if ($('input[type=checkbox]:on')) {
                $(e.target).closest("input[type=checkbox]").prop('value', '1');
                $("input[type=checkbox]:not(:on)").prop('value', '0');
            }
        });
    });
</script>