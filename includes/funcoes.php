<?php 
    function thumb($arq) {
      $caminho = "img/$arq";
      if(is_null($arq) || !file_exists($caminho)) {
        return "img/indisponivel.png";
      } else {
        return $caminho;
      }
    }