<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require_once('connectvars.php');
    $id = $_GET['id'];
    $date = $_GET['date'];
    $name = $_GET['name'];
    $score = $_GET['score'];
    $screeshot = $_GET['screenshot'];

    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $query = "SELECT * FROM guitarwars";

    mysqli_query($db, $query);

    echo '<form method="get" action="removeteste.php">';
    echo '<input type="radio" name="confirm" value="Yes"/> Yes';
    echo '<input type="radio" name="confirm" value="No" checked="checked"/> No<br/>';
    echo '<input type="submit" value="submit" name="submit"/></br>';
    echo '<input type="text" name="id" value="'.$id.'"/></br>';
    echo '<input type="text" name="date" value="'.$date.'"/></br>';
    echo '<input type="text" name="name" value="'.$name.'"/></br>';
    echo '<input type="text" name="score" value="'.$score.'"/></br>';
    echo '<input type="text" name="screenshot" value="'.$screeshot.'"/>';
    echo '</form>';
     ?>
  </body>
</html>
