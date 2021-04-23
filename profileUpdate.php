<?php
session_start();
include("bd.php");
if (isset($_POST['saveButton'])) {
    if (!$_POST["avatar"] && !$_POST["password2"] && !$_POST["email"] && !$_POST["fullname"]) {
        echo "Вы не ввели новые данные";
        exit();
    }
    $query = "UPDATE users SET avatar = '" . $_POST["avatar"] . "', email = '" . $_POST["email"] . "', password = '" . $_POST["password2"] . "', fullname ='" . $_POST["fullname"] . "'  WHERE idusers = '" . $_SESSION["idusers"] . "'";
    $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
    if ($result) {
        echo "Данные успешно обновлены";
    } else {
        echo "Ошибка: " . $query . "<br>" . $GLOBALS["db"]->error;
    }
}
