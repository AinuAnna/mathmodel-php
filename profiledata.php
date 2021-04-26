<?php
session_start();
include("bd.php");
?>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<div class="container-fluid p-0">
    <form class="form-validate" method="post">
        <div class="w-50 position-relative">
            <div class="form-group">
                <label class="form-label" for="fullname">Имя пользователя: </label>
                <input class="form-control" name="fullname" id="fullname" type="text" placeholder="Анна Андреевна Терешко" autocomplete="on" required="" data-msg="Пожалуйста введите новое имя" />
            </div>
        </div>
        <div class="w-50 position-relative">
            <div class="form-group">
                <label class="form-label" for="email">Эл. Почта: </label>
                <input class="form-control" name="email" id="email" type="email" placeholder="name@example.com" autocomplete="on" required="" data-msg="Пожалуйста введите новую почту" />
            </div>
        </div>
        <div class="w-50 position-relative">
            <div class="form-group">
                <label class="form-label" for="password1">Старый пароль: </label>
                <input class="form-control" name="password1" id="password1" type="password" autocomplete="off" required="" data-msg="Пожалуйста введите новый пароль">
                <label class="form-label" for="password2">Новый пароль: </label>
                <input class="form-control" name="password2" id="password2" type="password" autocomplete="off" required="" data-msg="Пожалуйста введите новый пароль">
            </div>
        </div>
        <button class="btn btn-primary" name="saveButton" id="saveButton" type="submit">Обновить</button>
    </form>
</div>
<?php if (isset($_POST['saveButton2'])) {
    if (!$_POST["avatar"]) {
        echo "Вы не добавили новый аватар";
        exit();
    }
    $query2 = "UPDATE users SET avatar = '" . $_POST["avatar"] . "' WHERE idusers = '" . $_SESSION["idusers"] . "'";
    $result2 = mysqli_query($GLOBALS['db'], $query2) or die(mysqli_error($GLOBALS['db']));
    include("notification.php");
}
?>