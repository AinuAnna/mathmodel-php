<?php
session_start();
include ('bd.php');
$query= "SELECT * FROM users WHERE idusers='".$_SESSION['idusers']."'";
$result = mysqli_query($GLOBALS['db'], $query);
$row = mysqli_fetch_array($result);
$content = $row['avatar'];
header("Content-type: image/jpeg");
echo $content;
?>