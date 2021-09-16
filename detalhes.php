<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/detalhes.css">
  <title>Detalhes</title>
</head>
<body>
  <?php 
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
  ?>
  <div class="container">
    <?php
      $codigoJogo = $_GET['cod'] ?? 0; 
      $busca = $banco->query("select * from jogos where cod = '$codigoJogo'");
    ?>
    <h1>Detalhes do jogo</h1>
    <table class='detalhes'>
      <?php
        if(!$busca) {
          echo "A busca falhou";
        } else {
          if($busca->num_rows == 1) {
            $reg = $busca->fetch_object();
            $thumb = thumb($reg->capa);
            echo "<tr><td rowspan='3'><img src='$thumb'";
            echo "<td>Nome jogo";
            echo "<tr><td>Descricao";
            echo "<tr><td>Adm";
          } else {
            echo "Nenhum registro encontrado";
          }
        } 
      ?>
    </table>
  </div>
</body>
</html>