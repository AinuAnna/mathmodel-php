<h4 style="margin-top: 40px; margin-top: 20px;">Добавление теста:</h4>
<div class="w-100 position-relative">
    <form class="form-validate" method="post">
        <div class="form-group" id="addTest">
            <label class="form-label" for="questiontext">Выберите название лекции, которой пренадлежит тест:</label>
            <select class="custom-select" name="addtype"> -->
                <?php $query = "SELECT * FROM topics";
                $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                if ($result) {
                    $rows = mysqli_num_rows($result);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<p><option value = " . $row['idtopics'] . ">" . $row['nametopic'] . "</p>";
                    }
                }
                ?>
            </select>
            <label class="form-label" for="questiontext">Введите название теста:</label>
            <input class="form-control" type='text' name="testtitle" placeholder='тест №1'>
            <p class="add-question">Добавьте вопрос, нажав на кнопку ниже. <span id="group" class="text-muted">Ограничение - 100 вопросов</span></p>
            <div class="my-container-bigger">
                <div class="my-container-big" id='big_0'>
                    <div class='element' id='element_0'>
                        <input class="form-control" type='text' name="question[0]" placeholder='Введите текст вопроса:' id='txt_0'>&nbsp;<button class="btn btn-primary add">➕</button>
                    </div>
                    <div class='my-container' id='container_0'>
                        <div class='answer'>
                            <input type='radio' name="ischecked[0]" class="radio"><input class='form-control' type='text' name="answer[0][0]" placeholder='Введите вариант ответа:' id='input_0'>&nbsp;<button class='btn btn-primary add-answer' id='answerb_0'>🔻</button>&nbsp;<button id='remove-answer_0' class='btn btn-primary remove-answer'>❌</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<button class="btn btn-primary" name="save" id="save" type="submit">Сохранить</button>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php
include('bd.php');
if (isset($_POST['save'])) {

    $questions = $_POST['question'];
    $answers = $_POST['answer'];
    $corrects = $_POST['ischecked'];

    $saveTestSql = "INSERT INTO tests (idtests, testtitle, idtopics) VALUES (NULL, '" . $_POST['testtitle']  . "','" . $_POST['addtype'] . "' );";
    mysqli_query($GLOBALS['db'], $saveTestSql);
    $testId = mysqli_insert_id($GLOBALS['db']);

    for ($i = 0; $i < count($questions); $i++) {

        $question = mysqli_escape_string($GLOBALS['db'], $questions[$i]);
        $sql .= "INSERT INTO questions(idquestions, questiontext, idtests) VALUES (NULL, '{$question}', {$testId}); ";
        $sql .= "SET @questionId := last_insert_id();";
        for ($j = 0; $j < count($answers[$i]); $j++) {
            $answer = mysqli_escape_string($GLOBALS['db'], $answers[$i][$j]);
            $correct = mysqli_escape_string($GLOBALS['db'], $corrects[$j]);
            if($correct == NULL){
            $sql .= "INSERT INTO answers(idanswers, idquestions, answer, ischecked) VALUES (NULL, @questionId , '{$answer}', 0);";
            }
            else{
            $sql .= "INSERT INTO answers(idanswers, idquestions, answer, ischecked) VALUES (NULL, @questionId , '{$answer}', 1);"; 
            }
        }
    }
    if (mysqli_multi_query($GLOBALS['db'], $sql)) {
        echo $sql;
        echo "New records created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($GLOBALS['db']);
    }
} ?>