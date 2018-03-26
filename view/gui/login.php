<?php

session_destroy();
session_name('sessao');
session_start(); 
ob_start();

?>

<!DOCTYPE html>
<html xml:lang="pt-BR" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Login Empresa - Talents</title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css'>
  <link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css'>
  <link rel="stylesheet" href="css/vaga.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>


</head>
<body >
	<div class="container">
    	<form class="well form-horizontal" name="formulario" id="formulario">
			<fieldset>

				<legend>Login</legend>

				<div class="form-group">
				  <label class="col-md-4 control-label">Usuário</label>  
				  <div class="col-md-4 inputGroupContainer">
				  <div class="input-group">
				  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				  <input name="username" id="username" placeholder="Email ou CNPJ" class="form-control"  type="text">
				    </div>
				  </div>
				</div>

				<div class="form-group">
				  <label class="col-md-4 control-label">Senha</label>  
				  <div class="col-md-4 inputGroupContainer">
				  <div class="input-group">
				  <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
				  <input name="password" id="password" placeholder="Senha" class="form-control"  type="password">
				    </div>
				  </div>
				</div>

				<!-- Loader -->
				<div class="form-group">
					<label class="col-md-4 control-label"></label>
				  	<div class="col-md-4" style="text-align: center">
						<div class="loader" id="loader"></div>
					</div>
				</div>
			
				<!-- Success message -->
				<div class="form-group"> 
					<label class="col-md-4 control-label"></label>
				  	<div class="col-md-4" style="text-align: center">
				  		<span class="errMessage" id="errMessage"></span>
				  	</div>
				</div>

				<!-- Link -->
				<div class="form-group">
					<label class="col-md-4 control-label"></label>
				  	<div class="col-md-4" style="text-align: center">
						<p>Sua empresa ainda não possui um cadastro? <a href="cadastro.php">Cadastre-se!</a></p>
					</div>
				</div>

				<!-- Button -->
				<div class="form-group">
				  <label class="col-md-4 control-label"></label>
				  <div class="col-md-4">
				    <button type="submit" name="buttonSubmit" id="buttonSubmit" class="btn btn-warning" >Entrar<span class="glyphicon glyphicon-send"></span></button>
				  </div>
				</div>

			</fieldset>
		</form>
	</div>


  <?php /*include "footer.php"*/ ?>

  <!--  Scripts-->

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
                          location.href='vaga.php';  //Redireciona
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
