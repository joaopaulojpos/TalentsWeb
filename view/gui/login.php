<?php

session_destroy();
session_name('sessao');
session_start(); 
ob_start();

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
    <title>Talents - Faça login</title>
</head>

<body class="fundo-login">
  
  <div class="row login">
    <h3 class="center-align logo"><span class="logo2">T</span><span class="logo3">alents</span></h3>
    <p class="center-align logo">Conectando talentos pelo mundo</p>
    <div class="valign-wrapper">
      <div class="col s12 m4 z-depth-4 card-panel offset-m4">
          <form name="formulario" id="formulario">
            <div class="section">
            </div>
            
            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">perm_identity</i>
                <input name="username" id="username" type="text">
                <label for="username" class="center-align">Email ou CNPJ</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">https</i>
                <input name="password" id="password" type="password">
                <label for="password">Password</label>
              </div>
              <div class="section">
                <p class="errMessage red-text center-align" id="errMessage"></p>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <button class="btn waves-effect waves-light col s12 teal darken-1" type="submit" name="buttonSubmit">LOGIN</button>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s6 m6 l6">
                <p><a href="cadastro_empresa.php">Inscreva-se</a></p>
              </div>
              <div class="input-field col s6 m6 l6">
                <p class="right-align"><a href="#">Esqueceu sua senha ?</a></p>
              </div>          
            </div>

          </form>
      </div>
    </div>
  </div>

    <!-- JQUERY do Materialize -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- JavaScript do Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

    <!-- SCRIPT MANUAIS -->
    <script src="js/vaga.js"></script>
  <script type='text/javascript'>
    $(document).ready(function(){
      $('#errMessage').hide(); //Esconde o elemento com id errolog
      $('#loader').hide();
      $('#formulario').submit(function(){  //Ao submeter formulário
      	$('#loader').show();
        var username=$('#username').val();  //Pega valor do campo login
        var password=$('#password').val();  //Pega valor do campo senha
        $.ajax({      //Função AJAX
          url:"valida_login.php",      //Arquivo php
          type:"post",        //Método de envio
          data: "username="+username+"&password="+password, //Dados
            success: function (result){     //Sucesso no AJAX
                        if(result==1){        
                          location.href='dashboard.php';  //Redireciona
                        }else{
                          document.getElementById('errMessage').innerHTML = result;
                          $('#loader').hide();
                          $('#errMessage').show();   //Informa o erro
                        }
                    }
        })
        return false; //Evita que a página seja atualizada
      })
    })

  </script>
</body>
</html>