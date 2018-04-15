<?php 

if (!isset($_SESSION['empresaLogada'])) {   //Verifica se há seções
    session_destroy();            //Destroi a seção por segurança
    header("Location: login.php"); 
    exit; //Redireciona o visitante para login
  }

include "menu2.php";
include "content.php";
include "foooter.php";
?>