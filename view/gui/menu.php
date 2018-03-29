<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

?>

<nav class="grey" role="navigation">
  <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo"><span class="logo-text">T</span>alents</a>
    <?php if (!isset($_SESSION['empresaLogada'])) { ?>
      <ul class="right hide-on-med-and-down">
        <li><a href="login.php">Entrar</a></li>
      </ul>
      <ul class="right hide-on-med-and-down">
        <li><a href="cadastro.php">Cadastrar</a></li>
      </ul>
    <?php }else { ?>
      <ul class="right hide-on-med-and-down">
        <li><a href="login.php">Sair</a></li>
      </ul>
      <ul class="right hide-on-med-and-down">
        <li><a href="cadastro.php">Perfil</a></li>
      </ul>
    <?php } ?>
  </div>
</nav>