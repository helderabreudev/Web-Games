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
    <?php
      include_once "topo.php"
    ?>
      <h1>Escolha um jogo</h1>
      <form method="GET" id="busca" action="index.php">
        Ordernar: Nome | Produtora | Nota Alta | Nota Baixa |
        <input type="text" name="c" size="10" maxlength="40"/>
        <input type="submit" value="pesquisar">
      </form>
      <table class="list">
        <?php
          $query = "select * from jogos j join generos g on j.genero = g.cod join produtoras p on j.produtora = p.cod";
          $busca = $banco->query("$query");
          if(!$busca) {
            echo "<tr><td>infelizmente a busca deu errado";
          } else {
            if ($busca->num_rows == 0) {
              echo "<tr><td>Nenhum registro encontrado";
            } else {
              while($reg = $busca->fetch_object()) {
                $t = thumb($reg->capa);
                echo "<tr><td><img src='$t'/>";
                echo "<td><a href='detalhes.php?cod=$reg->cod'>$reg->nome</a>";
                echo " [$reg->genero]";
                echo "<br/>$reg->produtora";
                echo "<td>Adm";
              }
            }
          }
        ?>
      </table>
  </div>
  <?php 
  include_once 'rodape.php';
  $banco->close(); 
  ?>
</body>
</html>