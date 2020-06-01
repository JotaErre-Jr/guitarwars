<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <fieldset>
      <legend>Marque as pontuação que você deseja excluir</legend>
      <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <?php
          $db = mysqli_connect('localhost', 'root', '', 'gwdb')
          or die('Erro ao se conectar com o servidor MYSQL');
          if (isset($_POST['submit'])) {
            foreach ($_POST['todelete'] as $delete_id) {
              $query = "DELETE FROM guitarwars WHERE id = $delete_id";
              mysqli_query($db, $query)
              or die('Erro ao consultar o banco de dados');
            }
            echo 'Jogador removido com sucesso!<br/>';
          }
          //exibe as linhas dos clientes com as caixas de verificação
          $query = "SELECT * FROM guitarwars";
          $result = mysqli_query($db, $query);

          while ($row = mysqli_fetch_array($result)) {
              echo'<input type="checkbox" name="todelete[]" value="'.$row['id'].'">';
                echo $name = $row['name'];
                echo ' '.$score = $row['score'];

                echo '<br/>';
          }
          mysqli_close($db);
         ?>
         <input type="submit" name="submit" value="Remove">
      </form>
    </fieldset>
  </body>
</html>
