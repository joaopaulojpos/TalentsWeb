<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

?>

<nav class="menu" role="navigation">
  <div class="nav-wrapper container">
    <a class="logo" id="logo-container" href="#"><span class="logo2">T</span>alents</a>
    <?php if (!isset($_SESSION['empresaLogada'])) { ?>
      <ul class="right">
        <li><a href="login.php">Entrar</a></li>
      </ul>
      <ul class="right">
        <li><a href="cadastro.php">Cadastrar</a></li>
      </ul>
    <?php }else { ?>
      <ul class="right">
        <li><a href="login.php">Sair</a></li>
      </ul>
      <ul class="right">
        <li><a href="cadastro.php">Perfil</a></li>
      </ul>
      <ul class="right">
        <li><a href="cadastro_vaga.php">Cadastrar Vaga</a></li>
      </ul>
    <?php } ?>
  </div>
</nav>