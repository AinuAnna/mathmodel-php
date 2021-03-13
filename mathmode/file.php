<?php
header("Content-Type: application/pdf");
include ('bd.php');
$result= "SELECT* FROM topics WHERE idtopics='".$_GET['idtopics']."'";
$result = mysql_query($result);
$row = mysql_fetch_array($result);
echo $row['file'];
?>