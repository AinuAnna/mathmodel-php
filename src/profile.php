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
<form class="form-validate" method="post" onsubmit="return confirmEdit()">
    <div class="profile">
        <div class="center-cont">
            <div class="card-body" id="user-avatar" name="upload" area-label="user avatar" style="background: url('<?php include("avatar.php"); ?>') center center/cover">
                <input id="upload" type="file" accept="image/*">
                <input class="dataup-label" id="dataup-label" type="text" style="display: none" data-browse="Выбрать" name="avatar">
                <label for="upload" onClick="renderAvatar();">
                    <span role="button" id="label" tabindex="0" aria-label="upload user profile">🡇</span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center">
        <button class="btn btn-primary" name="saveButton2" id="saveButton2" type="submit">Обновить</button>
    </div>
</form>
<form class="form-validate" method="post" onsubmit="return confirmEdit()">
    <div class="w-100 position-relative">
        <div class="form-group">
            <label class="form-label" for="fullname">Имя пользователя: </label>
            <input class="form-control" name="fullname" id="fullname" type="text" placeholder="Анна Андреевна Терешко" autocomplete="on" required="" data-msg="Пожалуйста введите новое имя" />
        </div>
    </div>
    <div class="w-100 position-relative">
        <div class="form-group">
            <label class="form-label" for="email">Эл. Почта: </label>
            <input class="form-control" name="email" id="email" type="email" placeholder="name@example.com" autocomplete="on" required="" data-msg="Пожалуйста введите новую почту" />
        </div>
    </div>
    <div class="w-100 position-relative">
        <div class="form-group">
            <label class="form-label" for="password1">Старый пароль: </label>
            <input class="form-control" name="password1" id="password1" type="password" autocomplete="off" required="" data-msg="Пожалуйста введите новый пароль">
            <label class="form-label" for="password2">Новый пароль: </label>
            <input class="form-control" name="password2" id="password2" type="password" autocomplete="off" required="" data-msg="Пожалуйста введите новый пароль">
        </div>
    </div>
    <div class="col-md-12 text-center">
        <button class="btn btn-primary" name="saveButton" id="saveButton" type="submit">Обновить</button>
    </div>
</form>
<?php
if (isset($_POST['saveButton'])) {
    if (!$_POST["password2"] && !$_POST["email"] && !$_POST["fullname"]) {
        echo "Вы не ввели новые данные";
        exit();
    }
    $query = "UPDATE users SET email = '" . $_POST["email"] . "', password = '" . $_POST["password2"] . "', fullname ='" . $_POST["fullname"] . "'  WHERE idusers = '" . $_SESSION["idusers"] . "'";
    $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
    include("notification.php");
}
?>
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