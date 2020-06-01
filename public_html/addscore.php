<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    //Define as constantes do caminho e do tamanho máximo dos arquivos
    define('GW_UPLOADPATH', 'images');
      if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $score = $_POST['score'];
        $screenshot = $_FILES['screenshot'] ['name'];

        if (!empty($name) && !empty($score) && !empty($screenshot)) {
          //Move o arquivo para a pasta alvo
          $target = GW_UPLOADPATH.$screenshot;
          if (move_uploaded_file($_FILES['screenshot'] ['tmp_name'], $target)) {
            $db = mysqli_connect('localhost', 'root', '', 'gwdb')
            or die('Erro ao se conectar ao servidor MYSQL');
            $query = "INSERT INTO guitarwars VALUES(0, NOW(), '$name', '$score', '$screenshot')";

            mysqli_query($db, $query);

            //Confirma exito com o usuário
            echo '<p>Obrigado por adicionar seu recorde</p>';
            echo '<p><strong>Nome: </strong> '.$name.'<br/>';
            echo '<strong>Pontuação: </strong>'.$score.'</br>';
            echo '<img src = "'.GW_UPLOADPATH.$screenshot.'" alt="Score image"/></p>';
            echo '<p><a href="index.php">&lt;&lt; Voltar para a lista dos recordes</a></p>';

            //Limpa os dados da pontuação para limpar o forulario
            $Nome = "";
            $Pontuação= "";

            mysqli_close($db);
          }
        }

      }
      ?>
    <fieldset>
      <legend>Guitar Wars - Add Your High Score</legend>
      <form enctype="multipart/form-data" class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="MAX_FILE-SIZE" value="32768">
        <label for="name">Name: </label>
        <input type="text" name="name" value="<?php if(!empty($name)) echo $name; ?>">

        <label for="score">Score: </label>
        <input type="text" name="score" value="<?php if(!empty($score)) echo $score; ?>">

        <label for="screenshot">Captura de tela: </label>
        <input type="file" name="screenshot" value="screenshot">

        <input type="submit" name="submit" value="ADD">
      </form>
    </fieldset>
  </body>
</html>
