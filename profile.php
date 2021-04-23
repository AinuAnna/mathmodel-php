<?php
session_start();
include("bd.php");
?>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<script src="avatar.js"></script>
<div class="container-fluid p-0">
    <div class="student-profile__right">
        <div class="center-cont">
            <div class="card-body" id="user-avatar" name="upload" area-label="user avatar" style="background: url('<?php echo "avatar.php"; ?>') center center/cover">
                <input id="upload" type="file" accept="image/*">
                <label for="upload" onClick="renderAvatar();">
                    <span role="button" id="label" tabindex="0" aria-label="upload user profile">🡇</span>
                </label>
            </div>
            <form class="form-validate" method="post">
                <input class="dataup-label" id="dataup-label" type="text" data-browse="Выбрать" name="avatar">
                <button class="btn btn-primary" name="saveButton" id="saveButton" type="submit">add avatar</button>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST['saveButton'])) {
    if (!$_POST["avatar"]) {
        echo "Вы не добавлили аватар";
        exit();
    }
    $query = "UPDATE users SET avatar = '" . $_POST["avatar"] . "' WHERE idusers = '" . $_SESSION["idusers"] . "'";
    $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
    if ($result) {
        echo "Успешно добавлен аватар";
    } else {
        echo "Ошибка: " . $query . "<br>" . $GLOBALS["db"]->error;
    }
}
?>
<div class="w-50 position-relative">
    <form class="form-validate" method="post">
        <div class="form-group">
            <label class="form-label" for="fullname">Имя пользователя: </label>
            <input class="form-control" name="fullname" id="fullname" type="text" placeholder="Анна Андреевна Терешко" autocomplete="on" required="" data-msg="Пожалуйста введите новое имя" />
        </div>
        <button class="btn btn-primary" name="editButton1" id="editButton1" type="submit">Изменить</button>
    </form>
</div>
<div class="w-50 position-relative">
    <form class="form-validate" method="post">
        <div class="form-group">
            <label class="form-label" for="email">Эл. Почта: </label>
            <input class="form-control" name="" id="email" type="email" placeholder="name@example.com" autocomplete="on" required="" data-msg="Пожалуйста введите новую почту" />
        </div>
        <button class="btn btn-primary" name="editButton2" id="editButton2" type="submit">Изменить</button>
    </form>
</div>
<div class="w-50 position-relative">
    <form class="form-validate" method="post">
        <div class="form-group">
            <label class="form-label" for="password1">Старый пароль: </label>
            <input class="form-control" name="password1" id="password1" type="password" autocomplete="off" required="" data-msg="Пожалуйста введите новый пароль">
            <label class="form-label" for="password2">Новый пароль: </label>
            <input class="form-control" name="password2" id="password2" type="password" autocomplete="off" required="" data-msg="Пожалуйста введите новый пароль">
        </div>
        <button class="btn btn-primary" name="editButton3" id="editButton3" type="submit">Изменить</button>
    </form>
</div>