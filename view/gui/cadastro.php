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
  <title>Starter Template - Materialize</title>

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
          <input  type="text" name="cnpj" class="validate">
          <label for="username">CNPJ</label>
        </div>
        <div class="input-field" id="username">
          <input  type="text" name="razaosocial" class="validate">
          <label for="username">Razão Social</label>
        </div>
        <div class="input-field" id="username">
          <input  type="text" name="nomefantasia" class="validate">
          <label for="username">Nome Fantasia</label>
        </div>
        <div class="input-field" id="username">
          <input  type="text" name="porte" class="validate">
          <label for="username">Porte</label>
        </div>
        <div class="input-field" id="username">
          <input  type="text" name="areaatuacao" class="validate">
          <label for="username">Área de atuação</label>
        </div>
        <div class="input-field" id="username">
          <input  type="text" name="responsavel" class="validate">
          <label for="username">Responsável pelo cadastro</label>
        </div>
        <div class="input-field" id="username">
          <input  type="text" name="telefone" class="validate">
          <label for="username">Telefone</label>
        </div>
        <div class="input-field" id="username">
          <input  type="text" name="site" class="validate">
          <label for="username">Site</label>
        </div>
        <div class="input-field" id="username">
          <input  type="text" id="email" name="email" class="validate">
          <label for="username">Email</label>
        </div>
        <div class="input-field" id="password">
          <input  type="password" id="senha" name="senha" class="validate">
          <label for="password">Senha</label>
        </div>
        <button type="submit">Confirmar</button>
        
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

require_once('../../model/basica/empresa.php');
require_once('../../controller/fachada.php');

$fachada = Fachada::getInstance();

if(isset($_POST)){

  $cnpj = $_POST['cnpj'];
  $razao_social = $_POST['razaosocial'];
  $nome_fantasia = $_POST['nomefantasia'];
  $porte = $_POST['porte'];
  $area_atuacao = $_POST['areaatuacao'];
  $responsavel = $_POST['responsavel'];
  $telefone = $_POST['telefone'];
  $site = $_POST['site'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $empresa = new Empresa();
  $empresa->setNrCnpj($cnpj);
  $empresa->setDsRazaoSocial($razao_social);
  $empresa->setDsNomeFantasia($nome_fantasia);
  $empresa->setNrPorte($porte);
  $empresa->setDsAreaAtuacao($area_atuacao);
  $empresa->setDsResponsavelCadastro($responsavel);   
  $empresa->setDsSite($site);
  $empresa->setDsTelefone($telefone);
  $empresa->setDsEmail($email);
  $empresa->getDsSenha($senha);  

  echo $fachada->empresaCadastrar($empresa);

}

?>
