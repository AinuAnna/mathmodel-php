<?php
include('bd.php');
$query= "SELECT * FROM topics WHERE idtopics='".$_GET['idtopics']."'";
$result = mysqli_query($GLOBALS['db'], $query);
$row = mysqli_fetch_array($result);
header('Content-Type: text/html; charset=UTF-8');
            header('Cache-Control: no-store, no-cache, must-revalidate');
            header('Cache-Control: post-check=0, pre-check=0', FALSE);
            header('Pragma: no-cache');
            header('Content-transfer-encoding: binary');
            header('Content-Disposition: inline; filename='.$row['nametopic'].'.pdf');
            header('Content-Type: application/pdf');
echo $row['file'];
?>