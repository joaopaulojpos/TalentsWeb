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
  <div class="container">
    <div class="row">
      <div class="col s6 offset-s3 z-depth-1" id="panell">
      <h5 id="title">Login Form</h5>
      <form id="formCadastro">
        <div class="input-field" id="username">
          <input  type="text" id="cnpj" name="cnpj" class="validate">
          <label for="username">CNPJ</label>
        </div>
        <div class="input-field" id="username">
          <input  type="text" id="razaosocial" name="razaosocial" class="validate">
          <label for="username">Razão Social</label>
        </div>
        <div class="input-field" id="username">
          <input  type="text" id="nomefantasia" name="nomefantasia" class="validate">
          <label for="username">Nome Fantasia</label>
        </div>
        <div class="input-field" id="username">
          <input  type="text" id="porte" name="porte" class="validate">
          <label for="username">Porte</label>
        </div>
        <div class="input-field" id="username">
          <input  type="text" id="areaatuacao" name="areaatuacao" class="validate">
          <label for="username">Área de atuação</label>
        </div>
        <div class="input-field" id="username">
          <input  type="text" id="responsavel" name="responsavel" class="validate">
          <label for="username">Responsável pelo cadastro</label>
        </div>
        <div class="input-field" id="username">
          <input  type="text" id="telefone" name="telefone" class="validate">
          <label for="username">Telefone</label>
        </div>
        <div class="input-field" id="username">
          <input  type="text" id="site" name="site" class="validate">
          <label for="username">Site</label>
        </div>
        <div class="input-field" id="username">
          <input  type="text" id="email" id="email" name="email" class="validate">
          <label for="username">Email</label>
        </div>
        <div class="input-field" id="password">
          <input  type="password" id="senha" name="senha" class="validate">
          <label for="password">Senha</label>
        </div>
        <span class="errMessage" id="errMessage">Erros:</span><br>
        <button type="submit">Confirmar</button>
        
      </form>

      </div>
    </div>

  </div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>

  <script type='text/javascript'>
    $(document).ready(function(){
      $('#errMessage').hide(); //Esconde o elemento com id errolog
      $('#formCadastro').submit(function(){  //Ao submeter formulário
        var cnpj=$('#cnpj').val();
        var razao_social=$('#razaosocial').val();
        var nome_fantasia=$('#nomefantasia').val();
        var porte=$('#porte').val();
        var area_atuacao=$('#areaatuacao').val();
        var responsavel=$('#responsavel').val();
        var telefone=$('#telefone').val();
        var site=$('#site').val();
        var email=$('#email').val();
        var senha=$('#senha').val();
        $.ajax({      //Função AJAX
          url:"valida_cadastro.php",      //Arquivo php
          type:"post",        //Método de envio
          data: "cnpj="+cnpj+"&razaosocial="+razao_social+"&nomefantasia="+nome_fantasia+"&porte="+porte+"&areaatuacao="+area_atuacao+"&responsavel="+responsavel+"&telefone="+telefone+"&site="+site+"&email="+email+"&senha="+senha, //Dados
            success: function (result){     //Sucesso no AJAX
                        if(result==1){            
                          location.href='vaga.php';  //Redireciona
                        }else{
                          document.getElementById('errMessage').innerHTML = result;
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
