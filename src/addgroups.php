<?php
session_start();
include("bd.php");
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
                    <h2 class="display-5 text-shadow font-weight-bold" style="margin-bottom: 50px; color:#00090b;">
                        Добавление групп учащихся</h2>
                    <div class="col-md-8 order-md-1">
                        <form class="needs-validation" method="post" novalidate="">
                            <div class="row">
                                <div class="col-md-7 mb-3">
                                    <label for="department">Отделение</label>
                                    <select class="custom-select d-block w-100" id="department" name="department" required="">
                                        <option value="">Выберите...</option>
                                        <?php $query = "SELECT * FROM `departments`";
                                        $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                                        if ($result) {
                                            $rows = mysqli_num_rows($result);
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo "<p><option value = " . $row['iddepartments'] . ">" . $row['departmentname'] . "</p>";
                                            }
                                            mysqli_free_result($result);
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label for="groupnumber">Номер группы</label>
                                    <select class="custom-select d-block w-100" id="groupnumber" name="groupnumber" required="">
                                        <option value="">Выберите...</option>
                                        <?php $query = "SELECT * FROM `group-numbers`";
                                        $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                                        if ($result) {
                                            $rows = mysqli_num_rows($result);
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo "<p><option value = " . $row['idnumbers'] . ">" . $row['groupnumber'] . "</p>";
                                            }
                                            mysqli_free_result($result);
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label for="course">Номер курса</label>
                                    <select class="custom-select d-block w-100" name="course" id="course" required="">
                                        <option value="">Выберите...</option>
                                        <?php $query = "SELECT * FROM `courses`";
                                        $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                                        if ($result) {
                                            $rows = mysqli_num_rows($result);
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo "<p><option value = " . $row['idcourses'] . ">" . $row['coursenumber'] . "</p>";
                                            }
                                            mysqli_free_result($result);
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-7 mb-3">
                                    <label for="description">Описание</label>
                                    <input type="text" class="form-control" name="description" id="description" placeholder="" required="">
                                </div>
                            </div>

                            <div class="my-3 bg-white rounded box-shadow">
                                <h4 class="border-bottom border-gray pb-2 mb-0">Список учащихся</h4>
                                <?php
                                $query = "SELECT * FROM `users` WHERE `groupsid` IS NULL AND roleid = 2";
                                $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                                if ($result) {
                                    $rows = mysqli_num_rows($result);
                                    $count = 0;
                                    while ($row = mysqli_fetch_array($result)) {
                                        $id = $row['idusers'];
                                        echo ' <div class="media text-muted pt-3" >
                                        <input type = "text" style = " display: contents;" name = "user[' . $count . '][' . $id  . ']"/>
                                        <img alt="50x50" class="mr-3" src="';
                                        if ($row['avatar'] == '') {
                                            echo '../assets/user-avatar.svg';
                                        } else {
                                            echo $row['avatar'];
                                        }
                                        $email = $row['email'];
                                        $fullname = $row['fullname'];

                                        echo '"';
                                        echo 'style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%">
                                        <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                                        <div class="d-flex justify-content-between align-items-center w-100">
                                        <strong class="text-gray-dark">' . $email . '</strong>
                                        <input type = "checkbox" style = "height: 1rem; width: 1rem;" id = "check" name = "check[' . $count . ']"/>
                                        </div>
                                        <span class="d-block">' . $fullname . '</span>
                                        </div></div>';
                                        $count++;
                                    }
                                }
                                ?>
                            </div>

                            <button class="btn btn-primary btn-lg btn-block" id="saveGroup" type="submit" name="saveGroup">Сохранить группу</button>
                        </form>
                        <?php
                        if (isset($_POST['saveGroup'])) {
                            $users = $_POST['user'];
                            $check = $_POST['check'];
                            if (!$_POST["description"]) {
                                echo "Вы не ввели данные. Попробуйте еще раз";
                                exit();
                            }
                            $query = "INSERT INTO `groups` (iddepartments, idcourses, idnumbers, namegroup) VALUES('" . $_POST['department'] . "','" .  $_POST['course'] . "','" .  $_POST['groupnumber'] . "','" . $_POST['description'] . "');";
                            mysqli_query($GLOBALS['db'], $query);
                            $groupid = mysqli_insert_id($GLOBALS['db']);

                            for ($i = 0; $i < count($users); $i++) {
                                foreach ($users[$i] as $j => $key) {
                                    $user = intval($key);
                                    $sql .= "UPDATE `users` SET `groupsid` = '{$groupid}' WHERE `idusers` = '{$user}'; ";
                                }
                            }

                            if (mysqli_multi_query($GLOBALS['db'], $sql)) {
                                echo $sql;
                                echo "New records created successfully";
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($GLOBALS['db']);
                            }
                        } ?>
                    </div>
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