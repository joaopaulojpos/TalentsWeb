<?php
include "menu.php";

  if (!isset($_SESSION['empresaLogada'])) {   //Verifica se h� se��es
    session_destroy();            //Destroi a se��o por seguran�a
    header("Location: login.php"); 
    exit; //Redireciona o visitante para login
  }

  $empresa = $_SESSION['empresaLogada']; 

?>

<section class="section">
        <div>
            <div class="row">
                <div class="col s12 m4 push-m2">
                    <div class="card white altcard">
                        <div class="card-content white-text">
                            <span class="card-title grey-text">Seu saldo atual</span>
                            <p><h2 class="center-align grey-text"><?php echo 'R$ ' . number_format($empresa[0]['vl_saldo'], 2, '.', ''); ?></h2></p>
                        </div>
                    </div>
                </div>

            <div class="col s12 m4 push-m2">
                    <div class="card white altcard">
                        <div class="card-content white-text">
                        	<form name="formulario" id="formulario" method="post" action="../validacoes/valida_recarga.php">
	                            <span class="card-title grey-text">Recarregar saldo</span>
	                            <p>
	                            	<div class="input-field col s12">
	                            		<input type="hidden" class="grey-text" name="cd_empresa" id="cd_empresa" value="<?php echo $empresa[0]['cd_empresa']; ?>">
							        	<input name="valor" id="valor" type="number" class="validate grey-text" required>
                        			  	<label for="valor">Valor</label>
							        </div>
							   	</p>
	                            <p class="center-align grey-text"><button class="btn waves-effect waves-light col s12 m12 teal darken-1" type="submit" id="buttonSubmit" name="buttonSubmit">Pague com <img id="ec-button" style="width: 55px;" src="https://www.paypalobjects.com/images/shared/paypal-logo-129x32.svg"/></button></p>


                        	</form>
                        	<div class="load" id="load">
			              		<hr/><hr/><hr/><hr/>
			            	</div>
			            	<div class="section">
			                	<p class="errMessage red-text center-align" id="errMessage"></p>
			              	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </section>

    <!-- JQUERY do Materialize -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script type='text/javascript'>
		$(document).ready(function(){
			$('#load').hide();

			$('#formulario').submit(function(){
				$('#load').show();
				document.getElementById("buttonSubmit").disabled = true;
				/*var valor=$('#valor').val();
				$.ajax({      //Função AJAX
		          url:"../validacoes/valida_recarga.php",      //Arquivo php
		          type:"post",        //Método de envio
		          data: "valor="+valor, //Dados
		          	success: function (result){     //Sucesso no AJAX
						$('#load').hide();
						$('#errMessage').show();   //Informa o erro
						document.getElementById("buttonSubmit").disabled = false;
		            },
		            error: function (result){
		                document.getElementById('errMessage').innerHTML = 'Erro ao efetuar pagamento, por favor, entre em contato com nosso suporte!';
		                $('#load').hide();
		                $('#errMessage').show();   //Informa o erro
		                document.getElementById("buttonSubmit").disabled = false;
		            }
		        })
		        return false; //Evita que a página seja atualizada*/
			})

		})

 	</script>
<?php

include "foooter.php";

?>

<!-- SCRIPT MANUAIS -->

