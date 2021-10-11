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
?>
<body>
  <div class="container">
    <?php
      $u = $_POST['usuario'] ?? null;
      $s = $_POST['senha'] ?? null;

      if(is_null($u) || is_null($s)) {
        require "user-login-form.php";  
      } else {
        $q = "SELECT usuario, nome, senha, tipo FROM usuarios WHERE usuario = '$u'";
        $busca = $banco->query($q);
        if(!$busca) {
          echo msg_erro('Falha ao acessar o banco');        
        } else {
          if($busca->num_rows > 0) {
          $reg = $busca->fetch_object();
          if(testarHash($s, $reg->senha)) {
            echo msg_sucesso('login realizado com sucesso');
            $_SESSION['user'] = $reg->usuario;
            $_SESSION['nome'] = $reg->nome;
            $_SESSION['tipo'] = $reg->tipo;
          } else {
              echo "usuario não existe";
          }
          } else {
            echo msg_erro('senha inválida');
          }
        }
      }
      echo voltar();
    ?>
  </div>
</body>
</html>
