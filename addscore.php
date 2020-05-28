<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $score = $_POST['score'];
        if (!empty($name) && !empty($score)) {
          $db = mysqli_connect('localhost', 'root', '', 'gwdb')
          or die('Erro ao se conectar ao servidor MYSQL');
          $query = "INSERT INTO guitarwars VALUES(0, NOW(), '$name', '$score')";

          mysqli_query($db, $query);

          //Confirma exito com o usuário
          echo '<p>Obrigado por adicionar seu recorde</p>';
          echo '<p><strong>Nome: </strong> '.$name.'<br/>';
          echo '<strong>Pontuação: </strong>'.$score.'</p>';
          echo '<p><a href="index.php">&lt;&lt; Voltar para a lista dos recordes</a></p>';

          //Limpa os dados da pontuação para limpar o forulario
          $Nome = "";
          $Pontuação= "";

          mysqli_close($db);
        }

      }
      ?>
    <fieldset>
      <legend>Guitar Wars - Add Your High Score</legend>
      <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="name">Name: </label>
        <input type="text" name="name" value="<?php if(!empty($name)) echo $name; ?>">

        <label for="score">Score: </label>
        <input type="text" name="score" value="<?php if(!empty($score)) echo $score; ?>">

        <input type="submit" name="submit" value="ADD">
      </form>
    </fieldset>
  </body>
</html>
