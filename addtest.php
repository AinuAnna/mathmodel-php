<h4 style="margin-top: 40px; margin-top: 20px;">Добавление теста:</h4>
<div class="w-100 position-relative">
    <form class="form-validate" method="post">
        <div class="form-group" id="addTest">
            <label class="form-label" for="questiontext">Введите название теста:</label>
            <input class="form-control" name="question" id="question" type="text" placeholder="Матричные игры" autocomplete="off">
            <p class="add-question">Добавьте вопрос, нажав на кнопку ниже. <span id = "group" class="text-muted">Ограничение - 10 вопросов</span></p>
            <div id="inp">
            </div>
            <button class="btn btn-primary" id="add">+</button>
        </div>
</div>
<button class="btn btn-primary" name="editButton" id="editButton" type="submit">Обновить</button>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>