<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
<?php
include('bd.php');
if ($result)
echo "<div class=\"alert alert-success alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Действия успешно выполнены!</div>";
else {
echo "<div class=\"alert alert-danger alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Ошибка выполнения...</div>";
}
?>