<?php
session_start();
include("bd.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head.php') ?>
    <title>Личный кабинет | Профиль</title>
</head>

<body>
    <?php include('headerStudent.php') ?>
    <section class="slice bg-section-secondary">
        <div class="content will-help-you">
            <div class="container">
                <div class="row" style="flex-direction: column;">
                    <h2 class="display-5 text-shadow font-weight-bold text-center" style="margin-bottom: 50px; color:#00090b;">Мой профиль</h2>
                    <?php include('profile.php'); ?>
                </div>
            </div>
        </div>
    </section>
</body>

</html>