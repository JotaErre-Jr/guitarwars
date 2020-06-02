<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h2>Guitar Wars - Maiores pontuações</h2>
    <p>Bem vindo intrépdio guitarrista! Você é bom o suficiente para entrar na lista de
    recordes do Guitar Wars? <a href="addscore.php">Clique aqui</a> para adicionar sua pontuação</p>
    <hr/>
    <?php
    define('GW_UPLOADPATH', 'images');
    define('GW_MAXFILESIZE', '32768');
      //conecta-se ao banco de dados
      $db = mysqli_connect('localhost', 'root', '', 'gwdb')
      or die('Erro ao se cobectar com servidor MYSQL');

      //obtem os dados das pontuações a partir do Mysql
      $query = "SELECT * FROM guitarwars";
      $data = mysqli_query($db, $query);

      //faz um loop através do array contatdo os dados das pontuações, formatando-os com HTML <table>
      //FUNÇÃO is_file() -> verifica se o arquivo gráfico realmente existe
      //FUNÇÃO filesize() -> verifica se o arquvo gráfico não está vazio
      while ($row = mysqli_fetch_array($data)) {
          echo'<tr><td class="scoreinfo">';
          echo'<span class="score">'.$row['score'].'</span><br/>';
          echo'<strong>Name:</strong>'.$row['name'].'<br/>';
          echo'<strong>Date: </strong>'.$row['date'].'</td></br>';
          //Parte do código que trata a imagem
          if (is_file(GW_UPLOADPATH.$row['screenshot']) && filesize(GW_UPLOADPATH.$row['screenshot']) > 0) {
            echo '<td><img src="'.GW_UPLOADPATH.$row['screenshot'].'" alt="Score image"></td></tr><br/>';
          }
          else {
            echo '<td><img src="'.GW_UPLOADPATH.'unverified.gif'.'" alt="Unverified Score"/></td><br>';
          }
      }
      echo'</table>';
      mysqli_close($db);
     ?>
  </body>
</html>
