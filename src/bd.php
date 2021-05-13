<?php
	$db = mysqli_connect("mathmodel.mysql.database.azure.com", "notroot@mathmodel", "26021711Q!", "mathmodel", 3306);

   if (!$db) {
       echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
       echo "Код ошибки error: " . mysqli_connect_errno() . PHP_EOL;
       echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
       exit;
}
?>
