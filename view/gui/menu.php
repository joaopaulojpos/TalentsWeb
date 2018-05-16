<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

$empresa = $_SESSION['empresaLogada'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
</head>
<body class="grey lighten-3">
    <header>
        <div class="navbar-fixed">
            <nav class="menu">
                <div class="nav-wrapper">
                  <a href="#!" class="brand-logo logo">&nbsp; <span class="logo2">T</span><span class="logo3">alents</span></a>
                  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                  <ul class="right hide-on-med-and-down">
					<li><a href="recarga_saldo.php"><?php echo 'R$ ' . number_format($empresa[0]['vl_saldo'], 2, '.', ''); ?></a></li>
                    <li><a href="dashboard.php">Home</a></li>
                    <li><a href="lista_vagas.php">Vagas</a></li>
                    <li class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Perfil"><a href="cadastro_empresa.php"><i class="material-icons">person</i></a></li>
                    <li class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Sair"><a href="login.php"><i class="material-icons">exit_to_app</i></a></li>
                  </ul>
                </div>
              </nav>
        </div>
        <!-- Menu Mobile -->
        <ul class="side-nav" id="mobile-demo">
            <li><a href="dashboard.php">Home</a></li>
            <li class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Perfil"><a href="cadastro_empresa.php"><i class="material-icons">person</i></a></li>
            <li class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Sair"><a href="login.php"><i class="material-icons">exit_to_app</i></a></li>
        </ul>
    </header>