<?php
session_start();
unset($_SESSION['fullname']);
unset($_SESSION['email']);
unset($_SESSION['idusers']);
unset($_SESSION['roleid']);
session_destroy();
header("location:login.php");
?>