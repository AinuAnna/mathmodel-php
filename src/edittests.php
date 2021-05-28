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
                    <div class = 'container-fluid p-3'>";
                            $count = 0;
                            $for = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<input class='form-control' type='text' name='question[" . $count . "][" . $row['idquestions'] . "]' value='" . $row['questiontext'] . "'>";
                                if ($row["idtests"] != null) {
                                    $query2 = "SELECT * FROM answers WHERE idquestions = " . $row['idquestions'] . "";
                                    $result2 = mysqli_query($GLOBALS['db'], $query2);
                                    echo "<div>";

                                    while ($row2 = mysqli_fetch_array($result2)) {
                                        if (intval($row2['ischecked']) == 1) {
                                            echo "
                                    <div><label class = 'list-group-item' for = 'answer" . $for . "''><input id = 'ischecked" . $for . "' style = 'width: 1rem;
                                    position: absolute;
                                    top: 1.5rem;
                                    left: 0.5rem;
                                    height: 1rem;' type = 'checkbox' checked name = 'ischecked[" . $row2['idanswers'] . "]'/><input class = 'form-control' id = 'answer' name = answer[" . $row['idquestions'] . "][" . $row2['idanswers'] . "]' style = 'margin-left: 10px' value = '" . $row2['answer'] . "'></label></div>";
                                        } else {
                                            echo "
                                            <div><label class = 'list-group-item' for = 'answer" . $for . "''><input id = 'ischecked' style = 'width: 1rem;
                                            position: absolute;
                                            top: 1.5rem;
                                            left: 0.5rem;
                                            height: 1rem;' type = 'checkbox' name = 'ischecked[" . $row2['idanswers'] . "]'/><input class = 'form-control' id = 'answer' name = answer[" . $row['idquestions'] . "][" . $row2['idanswers'] . "]' style = 'margin-left: 10px' value = '" . $row2['answer'] . "'></label></div>";
                                        }
                                        $for++;
                                    }
                                    echo "</div>";
                                }
                                $count++;
                            }
                            echo "</div>";

                            mysqli_free_result($result);
                        }
                        ?>
                        <div class="col-md-12 text-center">
                            <button class="btn btn-primary" name="updateButton" id="updateButton" type="submit">Обновить</button>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['updateButton'])) {
                        $questions = $_POST['question'];
                        $answers = $_POST['answer'];
                        $checked = $_POST['ischecked'];

                        $sql = "";
                        for ($i = 0; $i < count($questions); $i++) {
                            foreach ($questions[$i] as $j => $que) {
                                $question = mysqli_escape_string($GLOBALS['db'], $que);
                                $sql .= "UPDATE questions SET questiontext = '{$question}' WHERE idtests = {$_GET['idtests']} AND idquestions = {$j};";
                                foreach ($answers[$j] as $k => $value) {
                                    $answer = mysqli_escape_string($GLOBALS['db'], $value);
                                    if ($checked[$k] == "on") {
                                        foreach ($checked[$k] as $a => $new) {
                                            $correct = mysqli_escape_string($GLOBALS['db'], $new);
                                            $sql .= "UPDATE answers SET answer = '{$answer}' WHERE idanswers = {$k} AND ischecked = 0; ";
                                        }
                                    } else {
                                        $sql .= "UPDATE answers SET answer = '{$answer}' WHERE idanswers = {$k} AND ischecked = 1; ";
                                    }
                                }
                            }
                        }

                        $result = mysqli_multi_query($GLOBALS['db'], $sql);
                        while (mysqli_next_result($GLOBALS['db'])) {;
                        }
                        include('notification.php');

                        $error = mysqli_error($GLOBALS['db']);
                        if ($error) {
                            echo "Error: " . $sql . "<br>" . $error;
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
        var $check = $('#ischecked');
        $check.click(function(e) {
            $('input[type=checkbox]').prop("checked", true);
        });
    });
</script>