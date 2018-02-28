<?php

session_name('sessao');
session_start();

if (isset($_SESSION['empresa'])) 
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Login Empresa - Talents</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <?php include "menu.php" ?>
  
  <div class="container">
    <div class="row">
      <div class="col s6 offset-s3 z-depth-1" id="panell">
      <h5 id="title">Login Form</h5>
      <form action="#" method="post">
        <div class="input-field" id="username">
          <input  type="text" id="email" name="email" class="validate">
          <label for="username">Email/CNPJ</label>
        </div>
        <div class="input-field" id="password">
          <input  type="password" id="senha" name="senha" class="validate">
          <label for="password">Senha</label>
        </div>

        <p>
          <input type="checkbox" id="remember"/>
          <label for="remember" id="checkbox" >Lembrar</label>
        </p>

        <p class="p-alert"> <?php if (isset($_SESSION['mensagem'])) echo $_SESSION['mensagem']?> </p>
        <button type="submit">Entrar</button>
        
      </form>

      </div>
    </div>

  </div>

  
  <?php include "footer.php" ?>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>


  </body>
</html>

<?php

require_once('../../controller/fachada.php');
$fachada = Fachada::getInstance();

if(isset($_POST) && isset($_POST['email']) && isset($_POST['senha'])){

  $fachada->empresaLogar($_POST['email'], $_POST['senha']);

}

?>
