<?php
$dblocation = "localhost";
$dbname = "mathmode";
$dbuser = "root";
$dbpasswd = "26021711";
$dbcnx = mysqli_connect($dblocation,$dbuser,$dbpasswd);
if (!$dbcnx)
{
echo( "<P>В настоящий момент сервер базы данных не доступен, поэтому корректное отображение страницы невозможно.</P>" );
exit();
}
if (!mysqli_select_db($dbcnx, $dbname))
{
echo( "<P>В настоящий момент база данных не доступна,
поэтому корректное отображение страницы невозможно.</P>" );
exit();
}
?>