<?php
include ('bd.php');
header("Content-type:application/pdf");
$query= "SELECT * FROM topics WHERE idtopics='".$_GET['idtopics']."'";
$result = mysqli_query($GLOBALS['db'], $query);
$row = mysqli_fetch_array($result);
echo $row['file'];
?>