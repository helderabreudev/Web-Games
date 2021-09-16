<?php 
  $banco = new mysqli("localhost", "root", "", "bd_games");
  if($banco->connect_errno) {
    echo "<p>erro encontrado --> $banco->connect_error</p>";
    die();
  }