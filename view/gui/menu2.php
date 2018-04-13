<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

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
    <title>Dashboard - Talents</title>
</head>
<body class="grey lighten-4">
    <header>
        <div class="navbar-fixed">
            <nav class="teal darken-1">
                <div class="nav-wrapper">
                  <a href="#!" class="brand-logo">&nbsp; Talents</a>
                  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                  <ul class="right hide-on-med-and-down">
                    <li><a href="#">Sass</a></li>
                    <li><a href="#">Components</a></li>
                    <li><a href="vaga.php">Vagas</a></li>
                    <li class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Perfil"><a href="#"><i class="material-icons">person</i></a></li>
                    <li class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Sair"><a href="login.php"><i class="material-icons">exit_to_app</i></a></li>
                  </ul>
                  <ul class="side-nav" id="mobile-demo">
                    <li><a href="#!">Sass</a></li>
                    <li><a href="#!">Components</a></li>
                    <li><a href="#!">Javascript</a></li>
                    <li class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Perfil"><a href="#"><i class="material-icons">person</i></a></li>
                    <li class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Sair"><a href="#"><i class="material-icons">exit_to_app</i></a></li>
                  </ul>
                </div>
              </nav>
        </div>
    </header>