<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    //Define as constantes do caminho e do tamanho máximo dos arquivos
    require_once('appvars.php');
    require_once('connectvars.php');
      if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $score = $_POST['score'];
        $screenshot = $_FILES['screenshot'] ['name'];
        $screenshot_type = $_FILES['screenshot']['type'];
        $screenshot_size = $_FILES['screenshot']['size'];

        if (!empty($name) && !empty($score) && !empty($screenshot)) {
          if ((($screenshot_type == 'image/gif') || ($screenshot_type == 'image/jpeg') || ($screenshot_type == 'image/pjpeg') || ($screenshot_type == 'image/png')) && ($screenshot_size > 0) && ($screenshot_size <= GW_MAXFILESIZE)) {
            if ($_FILES['screenshot']['error'] ==0) {
              //Move o arquivo para a pasta alvo
              $target = GW_UPLOADPATH.time().$screenshot;
              if (move_uploaded_file($_FILES['screenshot'] ['tmp_name'], $target)) {
                $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
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
              else {
                echo '<p>Deculpe, houve um problema com o arquivo que você tentou enviar</p>';
              }
            }
            }
          else {
            echo '<p>Arquivo precisa ser grafico GIF, JEG ou PNG com menos de '.(GW_MAXFILESIZE/1024).'KB de tamanho</p>';
          }
          //Tenta excluir arquivo gráfico(Função unlink-> serve para apagar um arquivo n servidor)
          @unlink($_FILES['screenshot']['tmp_name']);
        }
        else {
          echo '<p>Por favor, digite todas as informações para adicionar sua pontuação.</p>';
        }

      }
      ?>
    <fieldset>
      <legend>Guitar Wars - Add Your High Score</legend>
      <form enctype="multipart/form-data" class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="32768">
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
