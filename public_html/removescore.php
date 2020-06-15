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
      if (isset($_GET['id']) && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['score']) && isset($_GET['screenshot'])){
        //Pega os dados de GET
        $id = $_GET['id'];
        $date = $_GET['date'];
        $name = $_GET['name'];
        $score = $_GET['score'];
        $screeshot = $_GET['screenshot'];
      }
      else if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['score']) && isset($_POST['screenshot'])){
        // Pega os daos de POST
        $id = $_POST['id'];
        $name = $_POST['name'];
        $score = $_POST['score'];
        $screeshot = $_POST['screenshot'];
      }
      else {
        echo '<p>Deculpe, nem uma pontuação foi especifivada para ser removida!</p>';
      }
      if (isset($_POST['submit'])) {
        if ($_POST['confirm'] == 'YES') {
          //exclui o arquivo grafico do servidor
          @unlink(GW_UPLOADPATH.$screeshot);

          //conexão com o banco de dados
          $db = mysqli('DB_HOST', 'DB_USER', 'DB_PASSWORD', 'DB_NAME');

          //exclui os dados da pontuação do banco
          $query = "DELETE FROM guitarwars WHERE id = $id LIMIT 1";

          mysqli_query($bd, $query);

          mysqli_close($db);
          //confirma exito com o usuário
          echo '<p>A pontuação '.$score.' para '.$name.' foi removida com sucesso</p>';
        }
        else {
          echo '<p>A pontuação não foi removida</p>';
        }
      }
      else if(isset($id) && isset($name) && isset($date) && isset($score) && isset($screeshot)){
        echo '<p>Tem certeza que deseja apagar a pontuaçõa abaixo?</p>';
        echo '<p><strong>Name: </strong>'.$name.'</br><strong>Date: </strong>'.$date.'<strong>Pontuação: </strong>'.$score.'</p>';
        echo '<form method="post" action="removescore.php">';
        echo '<input type="radio" name="confirm" value="Yes"/> Yes';
        echo '<input type="radio" name="confirm" value="No" checked="checked"/> No<br/>';
        echo '<input type="submit" value="submit" name="submit"/>';
        echo '<input type="hidden" name="id" value="'.$id.'"/>';
        echo '<input type="hidden" name="name" value="'.$name.'"/>';
        echo '<input type="hidden" name="score" value="'.$score.'"/>';
        echo '<input type="hidden" name="screenshot" value="'.$screeshot.'"/>';
        echo '</form>';
      }
      echo '<p><a href="admin.php">&lt;&lt;voltar</a></p>';
     ?>
  </body>
</html>
