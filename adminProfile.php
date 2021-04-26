<?php
session_start();
include ("bd.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head.php') ?>
    <title>Панель администратора | Профиль</title>
</head>

<body>
<?php include('headerAdmin.php') ?>
    <section class="slice bg-section-secondary">
        <div class="content will-help-you">
            <div class="container">
                <div class="row" style="flex-direction: column; align-items: center;">
                    <h2 class="display-5 text-shadow font-weight-bold" style="margin-bottom: 50px; color:#00090b;">Добро пожаловать в панель администратора!</h2>
                    <?php include('profile.php')?>
                </div>
            </div>
        </div>
        </div>
    </section>
</body>

</html>