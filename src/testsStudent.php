<?php
session_start();
include("bd.php");
?>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
<script type='text/javascript'>
  document.addEventListener('DOMContentLoaded', function() {
    window.setTimeout(document.querySelector('svg').classList.add('animated'), 1000);
  })
</script>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('head.php') ?>
  <title>Личный кабинет | Тесты</title>
</head>

<body>
  <?php include('headerStudent.php') ?>
  <section class="slice bg-section-secondary">
    <div class="content will-help-you">
      <div class="container">
        <div class="row" style="flex-direction: column; margin-bottom: 6rem;">
          <div class="input-group mb-3">
            <form method="post">
              <div class="input-group-prepend" heigth="38px">
                <span class="input-group-text" id="basic-addon1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                  </svg>
                </span>
                <input type="search" id="search" name="searchtype" class="form-control" placeholder="Поиск" aria-label="search" autocomplete="on" aria-describedby="basic-addon1">
              </div>
            </form>
          </div>
          <?php $query = "SELECT * FROM topics";
          $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

          if ($result) {
            $rows = mysqli_num_rows($result);

            echo "
            <div style = 'height: 30rem;'>
            <div class=' position-relative'>
            <h2 class='display-5 text-shadow font-weight-bold' style='margin-bottom: 50px; color:#00090b; margin-bottom: 3rem;'>
            Тесты</h2>
            <div class = 'table-responsive-md'>
                    <ol>";
                    while ($row = mysqli_fetch_array($result)) {
                      $search = "";
                      $query2 = "SELECT * FROM tests WHERE idtopics = ".$row['idtopics']."";
                      $result2 = mysqli_query($GLOBALS['db'], $query2) or die(mysqli_error($GLOBALS['db']));
                      echo "<li>" . $row['nametopic'] . "</li>";
                      while ($row2 = mysqli_fetch_array($result2)) {
                        $id = $row2['idtests'];
                        if (isset($_POST['searchtype'])) $search = " AND testtitle LIKE '%" . $_POST['searchtype'] . "%'";
                        $query3 = "SELECT * FROM tests WHERE idtests = " . $id . $search;
                        $result3 = mysqli_query($GLOBALS['db'], $query3);
                        while ($row3 = mysqli_fetch_array($result3)) {
                          echo "<ul><li><a href = '   testpage.php?idtests=" . $row2['idtests'] . "'>" . $row2['testtitle'] . "</a></li></ul>";
                        }
                    }
                    }
            echo "</ul>
            <div class='position-absolute d-md-block image-container' style = 'top: 0; right: 0;'>
              <img alt='lecture image' src='../assets/mathematics-animate (1).svg' style = 'width: 40rem !important;'>
            </div>
          </div>
         </div>
       </div>";
            mysqli_free_result($result);
          }
          ?>
        </div>
      </div>
    </div>
  </section>
</body>

</html>