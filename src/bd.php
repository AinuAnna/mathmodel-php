<?php
if ($_SERVER['SERVER_NAME'] == "https://math-model-php.herokuapp.com") {
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
	$host = $url["host"];
	$username = $url["user"];
	$password = $url["pass"];
	$dbname = substr($url["path"], 1);
} else {
	$db = mysqli_connect("3306", "root", "26021711", "mathmode");

   if (!$db) {
       echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
       echo "Код ошибки error: " . mysqli_connect_errno() . PHP_EOL;
       echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
       exit;
   }
}
?>
