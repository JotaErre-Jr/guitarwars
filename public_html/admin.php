<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require_once('appvars.php');
      require_once('connectvars.php');

      $db = mysqli_connect('localhost', 'root', '', 'gwdb')
      or die('Erro ao se conectar com o servidor MYSQL');

      $query = "SELECT * FROM guitarwars ORDER BY score DESC, date ASC";
      $data = mysqli_query($db, $query);

      echo '<table>';
      while ($row = mysqli_fetch_array($data)) {
          echo '<tr class ="scorerow"><td><strong>'.$row['name'].'</strong></td>';
          echo '<td>'.$row['date'].'</td>';
          echo '<td>'.$row['score'].'</td>';
          //Gera o link HTML para o script removescore.php, enviando a ele informações sobre a pontuaçõa a ser excluida
          echo '<td><a href = "removescore.php?id='.$row['id'].'&amp;date='.$row['date'].
          '&amp;name='.$row['name'].'&amp;score='.$row['score'].
          '&amp;screenshot='.$row['screenshot'].'">Remove</a></td></tr>';
      }
      echo '</table>';
      mysqli_close($db);
     ?>
  </body>
</html>
