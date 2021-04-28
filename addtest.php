<h4 style="margin-top: 40px; margin-top: 20px;">Добавление теста:</h4>
<div class="w-100 position-relative">
    <form class="form-validate" method="post">
        <div class="form-group" id="addTest">

            <label class="form-label" for="questiontext">Выберите название лекции, которой пренадлежит тест (это будет название теста):</label>
            <select class="custom-select" name="addtype">
                <?php $query = "SELECT * FROM topics";
                $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                if ($result) {
                  $rows = mysqli_num_rows($result);
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<p><option value = " . $row['idtopics'] . ">" . $row['nametopic'] . "</p>";
                  }
                  mysqli_free_result($result);
                }
                ?>
              </select>

            <p class="add-question">Добавьте вопрос, нажав на кнопку ниже. <span id="group" class="text-muted">Ограничение - 10 вопросов</span></p>
            <div class="my-container-bigger">
                <div class="my-container-big" id='big_0'>
                    <div class='element' id='element_0'>
                        <input class="form-control" type='text' placeholder='Введите текст вопроса:' id='txt_0'>&nbsp;<button class="btn btn-primary add">➕</button>
                    </div>
                    <div class='my-container' id='container_0'>
                        <div class='answer' id='answer_0'>
                            <input class='form-control' type='text' placeholder='Введите вариант ответа:' id='input_0'>&nbsp;<button class='btn btn-primary add-answer' id='answerb_0'>🔻</button>&nbsp;<button id='remove-answer_0' class='btn btn-primary remove-answer'>❌</button>
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

    $query2 = "INSERT INTO tests (idtests, testtitle, idtopics)
    VALUES (NULL, '" . $_POST['addtype'] . "','" . $_POST['idtopics'] . "' );";
    $result2 = mysqli_query($GLOBALS['db'], $query2) or die(mysqli_error($GLOBALS['db']));

   
    $query1 = "INSERT INTO questions (idquestions, questiontext, idtests)
    VALUES (NULL, '" . $_POST['question'] . "', );";
    $result1 = mysqli_query($GLOBALS['db'], $query1) or die(mysqli_error($GLOBALS['db']));
    include("notification.php");
}?>