<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/detalhes.css">
  <title>Detalhes</title>
</head>
<?php 
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
    require_once "includes/login.php";

    $codigoJogo = $_GET['cod'] ?? 0; 
    $busca = $banco->query("select * from jogos where cod = '$codigoJogo'");
    if(!$busca) {
      echo "A busca falhou";
    } else {
      if($busca->num_rows == 1) {
        $reg = $busca->fetch_object();
        $thumb = thumb($reg->capa);
      }
    }
  ?>

<body>
  <div class="container-detalhes">
    <div class="foto">
      <?php
        echo voltar();
        echo "<h1>Detalhes do jogo</h1>";
        echo "<img src='$thumb'/>";
      ?>
      </div>
      <div class="text">
        <?php
        echo "<h2>$reg->nome</h2>";
        echo "<h3>Nota: " . number_format($reg->nota, 1) . "/10</h3>";
        echo "<p>$reg->descricao</p>";
        echo "<h3>Adm</h3>";
        ?>
    </div>
  </div>  
  <?php 
  include_once 'rodape.php';
  $banco->close(); 
  ?> 
</body>
</html>