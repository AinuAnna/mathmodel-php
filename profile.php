<?php
session_start();
include("bd.php");
?>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
<script src="avatar.js"></script>
<div class="container-fluid p-0">
<form class="form-validate" method="post">
    <div class="profile">
        <div class="center-cont">
                <div class="card-body" id="user-avatar" name="upload" area-label="user avatar" style="background: url('<?php include("avatar.php"); ?>') center center/cover">
                    <input id="upload" type="file" accept="image/*">
                    <input class="dataup-label" id="dataup-label" type="text"  style = "display: none" data-browse="Выбрать" name="avatar">
                    <label for="upload" onClick="renderAvatar();">
                        <span role="button" id="label" tabindex="0" aria-label="upload user profile">🡇</span>
                    </label>
                </div>
        </div>
    </div>
</div>
<button class="btn btn-primary" name="saveButton" id="saveButton" type="submit">Обновить</button>
<div class="w-50 position-relative">
        <div class="form-group">
            <label class="form-label" for="fullname">Имя пользователя: </label>
            <input class="form-control" name="fullname" id="fullname" type="text" placeholder="Анна Андреевна Терешко" autocomplete="on" required="" data-msg="Пожалуйста введите новое имя" />
        </div>
</div>
<div class="w-50 position-relative">
        <div class="form-group">
            <label class="form-label" for="email">Эл. Почта: </label>
            <input class="form-control" name="email" id="email" type="email" placeholder="name@example.com" autocomplete="on" required="" data-msg="Пожалуйста введите новую почту" />
        </div>
</div>
<div class="w-50 position-relative">
        <div class="form-group">
            <label class="form-label" for="password1">Старый пароль: </label>
            <input class="form-control" name="password1" id="password1" type="password" autocomplete="off" required="" data-msg="Пожалуйста введите новый пароль">
            <label class="form-label" for="password2">Новый пароль: </label>
            <input class="form-control" name="password2" id="password2" type="password" autocomplete="off" required="" data-msg="Пожалуйста введите новый пароль">
        </div>
</div>
<button class="btn btn-primary" name="saveButton" id="saveButton" type="submit">Обновить</button>
</form></div>
<?php include('profileUpdate.php');?>