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
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="input-field" id="username">
          <input  type="text" class="validate">
          <label for="username">Email/CNPJ</label>
        </div>
        <div class="input-field" id="password">
          <input  type="password" class="validate">
          <label for="password">Senha</label>
        </div>
        <p>
          <input type="checkbox" id="remember"/>
          <label for="remember" id="checkbox" >Lembrar</label>
        </p>
        <a class="waves-effect waves-light btn" id="loginbtn">Entrar</a>
        
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

if(isset($_POST)){

  printf('Resultado:'); 

  $url = 'http://localhost/talentsweb/api/public/api/empresa/login'; 
  $params = array( 'login' => 'brunofelixbarbosa123@hotmail.com', 'senha' => '123'); 
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $url); 
  curl_setopt($ch, CURLOPT_POST, 1); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  curl_setopt($ch, CURLOPT_POSTFIELDS, 
  http_build_query($params)); 
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); 
  curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
  // This should be the default Content-type for POST requests 
  //curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded")); 
  $result = curl_exec($ch); 
  if(curl_errno($ch) !== 0) { 
    error_log('cURL error when connecting to ' . $url . ': ' . curl_error($ch)); 
  } 
  curl_close($ch); 
  printf($result); 

}

?>
