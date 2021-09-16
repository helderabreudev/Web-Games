<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Lista de games</title> 
</head>
<body>
  <?php 
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
  ?>
  <div class="container">
      <h1>Escolha um jogo</h1>
      <table class="list">
        <?php
          $busca = $banco->query("select * from jogos order by nome");
          if(!$busca) {
            echo "<tr><td>infelizmente a busca deu errado";
          } else {
            if ($busca->num_rows == 0) {
              echo "<tr><td>Nenhum registro encontrado";
            } else {
              while($reg = $busca->fetch_object()) {
                $t = thumb($reg->capa);
                echo "<tr><td><img src='$t'/>";
                echo "<td><a href='detalhes.php'>$reg->nome</a>";
                echo "<td>Adm";
              }
            }
          }
        ?>
      </table>
  </div>
  <?php $banco->close(); ?>
</body>
</html>