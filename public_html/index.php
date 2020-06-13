<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title></title>
  </head>
  <body>
    <h2>Guitar Wars - Maiores pontuações</h2>
    <p>Bem vindo intrépdio guitarrista! Você é bom o suficiente para entrar na lista de
    recordes do Guitar Wars? <a href="addscore.php">Clique aqui</a> para adicionar sua pontuação</p>
    <hr/>
    <?php
    require_once('appvars.php');
    require_once('connectvars.php');
      //conecta-se ao banco de dados
      $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
      or die('Erro ao se cobectar com servidor MYSQL');

      //obtem os dados das pontuações a partir do Mysql
      $query = "SELECT * FROM guitarwars ORDER BY score DESC, date ASC";
      $data = mysqli_query($db, $query);
      echo '<table>';
      //Variável que faz a conta das pontuações
      $i = 0;
      //faz um loop através do array contatdo os dados das pontuações, formatando-os com HTML <table>
      //FUNÇÃO is_file() -> verifica se o arquivo gráfico realmente existe
      //FUNÇÃO filesize() -> verifica se o arquvo gráfico não está vazio
      while ($row = mysqli_fetch_array($data)) {
        //Se $i for igual a 0 sabemos que essa é a prieira pontuação(ou seja a maior)pontuação, e por tanto
        //devenos gerar o código HTML para o cabeçalho
        if ($i==0) {
          echo '<tr><td colspan="2" class="topscoreheader">Top Score:'.$row['score'].'</td></tr>';
        }
          echo'<tr><td class="scoreinfo">';
          echo'<span class="score">'.$row['score'].'</span><br/>';
          echo'<strong>Name:</strong>'.$row['name'].'<br/>';
          echo'<strong>Date: </strong>'.$row['date'].'</td>';
          //Parte do código que trata a imagem
          if (is_file(GW_UPLOADPATH.$row['screenshot']) && filesize(GW_UPLOADPATH.$row['screenshot']) > 0) {
            echo '<td><img src="'.GW_UPLOADPATH.$row['screenshot'].'" alt="Score image"></td></tr>';
          }
          else {
            echo '<td><img src="'.GW_UPLOADPATH.'unverified.gif'.'" alt="Unverified Score"/></td>';
          }
          $i++;//Increenta o contador ao final do loop pelas pontuações.
      }
      echo'</table>';
      mysqli_close($db);
     ?>
  </body>
</html>
