<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>Lista de games</title> 
</head>
<body>
  <?php 
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
    require_once "includes/login.php";
    $ordem = $_GET['o'] ?? "n";
    $chave = $_GET['c'] ?? "";
  ?>
  <div class="container">
    <?php include_once "topo.php" ?>

      <h1>Escolha um jogo</h1>
      <form method="get" id="busca" action="index.php">
        Ordernar: 
        <a href="index.php?o=n&c=<?php echo "$chave";?>">Nome</a> | 
        <a href="index.php?o=p&c=<?php echo "$chave";?>">Produtora</a> | 
        <a href="index.php?o=na&c=<?php echo "$chave";?>">Nota Alta</a> | 
        <a href="index.php?o=nb&c=<?php echo "$chave";?>">Nota Baixa</a> |
        <a href="index.php?">Mostrar Todos</a> |
        <input type="text" name="c" size="10" maxlength="40"/>
        <input type="submit" value="pesquisar">
      </form>

      <table class="list">
        <?php
          $query = "select j.cod, j.nome, j.capa, g.genero, p.produtora from jogos j join generos g on j.genero = g.cod join produtoras p on j.produtora = p.cod ";
          
          if (!empty($chave)) {
            $query .= "WHERE j.nome like '%$chave%' OR p.produtora like '%$chave%' or g.genero like '%$chave%'";
          }

          switch ($ordem) {
            case "p": 
              $query .= "ORDER BY p.produtora"; /* . Concatena o texto */
              break;
            case "na":
              $query .= "ORDER BY j.nota DESC";
              break;
            case "nb":
              $query .= "ORDER BY j.nota ASC";
              break;
            default: 
              $query .= "ORDER BY j.nome";
              break;
          }

          $busca = $banco->query($query);
          if(!$busca) {
            echo "<p>infelizmente a busca deu errado</p>";
          } else {
            if ($busca->num_rows == 0) {
              echo "<p>Nenhum registro encontrado</p>";
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