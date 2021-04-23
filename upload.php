<?php
session_start();
include ('bd.php');
if (isset($_POST['saveButton'])) {
    if (!$_POST["dataup-label"]) {
        echo "Вы не добавлили аватар";
        exit();
    }
    $query = "INSERT INTO users SET avatar = '" . $_POST["dataup-label"] . "' WHERE idusers = '" . $_SESSION["idusers"] . "'";
    $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
    if ($result) {
        echo "Успешно добавлен аватар";
    } else {
        echo "Ошибка: " . $query . "<br>" . $GLOBALS["db"]->error;
    }
}
?>