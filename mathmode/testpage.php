<?php
    session_start();
    include ("bd.php");
    ?>
<script>
if ( window.history.replaceState ) {
window.history.replaceState( null, null, window.location.href );
}
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "./style.css">
    <link rel="shortcut icon" href="assets/math.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <title>Личный кабинет | Тесты</title>
</head>
<body>
<section class="slice bg-section-secondary">
        <div class="content will-help-you">
          <div class="container">
            <div class="row">
            <div class="col-md-12 text-center">
            <div class="display-4 text-shadow font-weight-bold" style = "font-size: 26px; margin-bottom: 20px;color:#00090b;">
<?php
$query = "SELECT* FROM tests WHERE idtests='".$_GET['idtests']."'";
$result = mysqli_query($GLOBALS['db'], $query);
$row = mysqli_fetch_array($result);
echo $row['testtitle'];
?>
</div></div>
<form method = "post">
 <?php $query = "SELECT * FROM questions WHERE idtests ='".$_GET['idtests']."' ;";
              //Делаем запрос к БД, результат запроса пишем в $result:
              $result = mysqli_query($GLOBALS['db'], $query) or die( mysqli_error($GLOBALS['db']));

                if($result)
                {
                    $rows = mysqli_num_rows($result); // количество полученных строк
                    
                    echo "
                    <div class = 'container-fluid p-3'>
                    <ol class='list-group'>";
                    $count = 0;
                    while($row = mysqli_fetch_array($result)){
                        echo "<li style = 'margin: 20px; font-size: 20px;'>".$row['questiontext']."</li>";
                        if($row["idtests"] != null){
                            $query2 = "SELECT * FROM answers WHERE idquestions = ".$row['idquestions']."";
                            $result2 = mysqli_query($GLOBALS['db'], $query2);
                            echo "<div>";
                          
                            while($row2 = mysqli_fetch_array($result2)){
                                echo "
                                <div><label class = 'list-group-item' for = 'answer'><input id = 'answers' type = 'radio' value = ".$row2['ischecked']." name = 'answer".$count."'/><span style = 'margin-left: 10px'>".$row2['answer']."</span></label></div>";
                            }
                            echo "</div>";
                        }
                        $count++;
                    }
                    echo "</ol>
                    </div>";
                    // очищаем результат
                    mysqli_free_result($result);
                }
                ?> 
            <div class="col-md-12 text-center">
                <button class="btn btn-primary" name = "sendButton" id = "sendButton" type = "submit">Отправить</button>
            </div>
            </form>
            <?php
            if(isset($_POST['sendButton'])){

                $query = "SELECT * FROM questions WHERE idtests ='".$_GET['idtests']."' ;";
              //Делаем запрос к БД, результат запроса пишем в $result:
              $result = mysqli_query($GLOBALS['db'], $query) or die( mysqli_error($GLOBALS['db']));

                if($result)
                {
                    $rows = mysqli_num_rows($result); // количество полученных строк
                    $count = 0;
                    $correct = 0;
                    while($row = mysqli_fetch_array($result)){
                        if($row["idtests"] != null){
                            $query2 = "SELECT * FROM answers WHERE idquestions = ".$row['idquestions']."";
                            $result2 = mysqli_query($GLOBALS['db'], $query2);                      
                            while($row2 = mysqli_fetch_array($result2)){
                                $name = "answer".$count."";
                                if(isset($_POST[$name]) && $_POST[$name] == 1 && $row2['ischecked'] == 1 ){
                                $correct++;
                                }          
                            }
                        }
                        $count++;
                    }
                    $query3 = "INSERT INTO `test-results` (idtestResults, mark, idusers, idtests) VALUES (NULL, '".$correct."', '".$_SESSION['idusers']."', '".$_GET['idtests']."');";
                    $result3 = mysqli_query($GLOBALS['db'], $query3) or die( mysqli_error($GLOBALS['db']));
                    if ($result3) {
                       header ("location: result.php");
                    } else {
                       echo "Ошибка: " . $query3 . "<br>" . $GLOBALS["db"]->error;
                    }
                    mysqli_free_result($result);
                }                  
            }?>
</div></div></div></section>
</body>
</html>