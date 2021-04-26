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
        <button class="btn btn-primary" name="saveButton2" id="saveButton2" type="submit">Обновить</button>
    </form>
</div>
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