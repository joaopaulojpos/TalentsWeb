<?php


  if (!isset($_SESSION['empresaLogada'])) {   //Verifica se há seções
    session_destroy();            //Destroi a seção por segurança
    header("Location: login.php"); 
    exit; //Redireciona o visitante para login
  }

  if(empty($_GET['cd_vaga'])){
    header("Location: vaga.php"); 
    exit; //Redireciona o visitante para login
  }

  $cd_vaga = $_GET['cd_vaga']; 

 
  require_once('../../controller/fachada.php');

  $fachada = Fachada::getInstance();
  $arrayprofissionais = $fachada->listarProfissionaisVaga($cd_vaga);

  //var_dump($arrayvagas);
  //var_dump($empresa[0]['cd_empresa']);

  

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Vagas - Talents</title>

  <!-- CSS  -->
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css'>
  
  <link href="css/menu.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">

  <link rel="stylesheet" href="css/card.css">
</head>
<body>
  <?php include "menu.php" ?>
  
  <div class="container">
    
    <?php echo $empresa[0]['ds_razao_social'] ?>
 
  </div>

  <?php foreach ($arrayprofissionais as $key => $value) {
          if ($key == 'sucess'){
            $arrayvagas2 = $value;
            foreach ($arrayvagas2 as $key => $value) { 

              $ds_nome = $value['ds_nome'];
              $ds_email = $value['ds_email'];

              echo $ds_nome;
              echo $ds_email;
             
  ?>

             

  <?php
          }
        }
      }
  ?>

  
  <?php include "footer.php" ?>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>


  </body>
</html>
