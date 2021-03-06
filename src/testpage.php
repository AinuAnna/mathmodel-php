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
    <title>Личный кабинет | Тесты</title>
</head>

<body>
    <section class="slice bg-section-secondary">
        <div class="content will-help-you">
            <div class="container">
                <div class="row" style="display:inline;">
                    <div class="col-md-12 text-center">
                        <div class="display-4 text-shadow font-weight-bold" style="font-size: 26px; margin-bottom: 20px;color:#00090b;">
                            <?php
                            $query = "SELECT* FROM tests WHERE idtests='" . $_GET['idtests'] . "'";
                            $result = mysqli_query($GLOBALS['db'], $query);
                            $row = mysqli_fetch_array($result);
                            echo $row['testtitle'];
                            ?>
                        </div>
                        <b>
                            <p>Максимальный балл за тест — <span id="group" class="text-muted"><?php
                                                                                                $query = "SELECT `questions`.idquestions,  `answers`.idquestions, COUNT(*) AS total, SUM(COUNT(*)) OVER() AS total_count FROM `answers`,  `questions` WHERE idtests = '" . $_GET['idtests'] . "' AND ischecked = 1 AND `answers`.idquestions =`questions`.idquestions GROUP BY `answers`.idquestions;";
                                                                                                $result = mysqli_query($GLOBALS['db'], $query);
                                                                                                $row = mysqli_fetch_array($result);
                                                                                                echo $row['total_count'];
                                                                                                ?></span></p>
                        </b>
                    </div>

                    <form method="post" onsubmit="return confirmConfirm()">
                        <?php $query = "SELECT * FROM questions WHERE idtests ='" . $_GET['idtests'] . "' ;";

                        $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                        if ($result) {
                            $rows = mysqli_num_rows($result);

                            echo "
                    <div class = 'container-fluid p-3'>
                    <ol class='list-group'>";
                            $count = 0;
                            $for = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<li style = 'margin: 20px; font-size: 20px;'>" . $row['questiontext'] . "</li>";
                                if ($row["idtests"] != null) {
                                    $query2 = "SELECT * FROM answers WHERE idquestions = " . $row['idquestions'] . "";
                                    $result2 = mysqli_query($GLOBALS['db'], $query2);
                                    echo "<div>";

                                    while ($row2 = mysqli_fetch_array($result2)) {
                                        echo "
                                <div><label class = 'list-group-item' for = 'answer" . $for . "''><input id = 'answer" . $for . "' type = 'checkbox' value = " . $row2['ischecked'] . " name = 'answer" . $count . "'/><span id = 'answer' style = 'margin-left: 10px'>" . $row2['answer'] . "</span></label></div>";
                                        $for++;
                                    }
                                    echo "</div>";
                                }
                                $count++;
                            }
                            echo "</ol>
                    </div>";

                            mysqli_free_result($result);
                        }
                        ?>
                        <div class="col-md-12 text-center">
                            <button class="btn btn-primary" <?php if ($_SESSION['roleid'] == 3) {
                                                                echo 'disabled';
                                                            } ?> name="sendButton" id="sendButton" type="submit">Отправить</button>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['sendButton'])) {

                        $query = "SELECT * FROM questions WHERE idtests ='" . $_GET['idtests'] . "' ;";

                        $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                        if ($result) {
                            $rows = mysqli_num_rows($result);
                            $count = 0;
                            $correct = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                if ($row["idtests"] != null) {
                                    $query2 = "SELECT * FROM answers WHERE idquestions = " . $row['idquestions'] . "";
                                    $result2 = mysqli_query($GLOBALS['db'], $query2);
                                    while ($row2 = mysqli_fetch_array($result2)) {
                                        $name = "answer" . $count . "";
                                        if (isset($_POST[$name]) && $_POST[$name] == 1 && $row2['ischecked'] == 1) {
                                            $correct++;
                                        }
                                    }
                                }
                                $count++;
                            }
                            $query3 = "INSERT INTO `test-results` (idtestResults, mark, idusers, idtests) VALUES (NULL, '" . $correct . "', '" . $_SESSION['idusers'] . "', '" . $_GET['idtests'] . "');";
                            $result3 = mysqli_query($GLOBALS['db'], $query3) or die(mysqli_error($GLOBALS['db']));
                            if ($result3) {
                                echo "<script>document.location.replace(' /src/result.php')</script>";
                            } else {
                                echo "Ошибка: " . $query3 . "<br>" . $GLOBALS["db"]->error;
                            }
                            mysqli_free_result($result);
                        }
                    } ?>
                </div>
            </div>
        </div>
    </section>

</body>

</html>