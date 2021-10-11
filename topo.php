<?php 
  echo "<header class='main-header'>";
  if(empty($_SESSION['user'])) {
    echo "<button><a href='user-login.php'>Entrar</a></button>";
  } else {
    echo "Olá, <strong>". $_SESSION['nome'] . "</strong>  |  ";
    echo "Sair";
  }
  echo "</header>";
?>