<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
<?php
include('bd.php');
if ($result)
echo "<div style = 'position: absolute;width: -webkit-fill-available;top: 6rem;left: 0;' class=\"alert alert-success alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Действия успешно выполнены! Обновите страницу!</div>";
else {
echo "<div style = 'position: absolute;width: -webkit-fill-available;top: 6rem;left: 0;' class=\"alert alert-danger alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Ошибка выполнения...</div>";
}
?>