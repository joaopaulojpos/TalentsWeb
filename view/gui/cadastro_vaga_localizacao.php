<?php

if (isset($_SESSION['empresa'])) 
session_destroy();

$cd_empresa              = '';
$nr_cnpj                 = '';
$ds_razao_social         = '';
$ds_nome_fantasia        = '';
$nr_porte                = '';
$ds_area_atuacao         = '';
$ds_responsavel_cadastro = '';
$ds_telefone             = '';
$ds_site                 = '';
$ds_email                = '';
$ds_senha                = '';

if (isset($_SESSION['empresaLogada'])) {   //Verifica se há seções
  $empresa = $_SESSION['empresaLogada']; 

  $cd_empresa = $empresa[0]['cd_empresa'];
  $nr_cnpj = $empresa[0]['nr_cnpj'];
  $ds_razao_social = $empresa[0]['ds_razao_social'];
  $ds_nome_fantasia = $empresa[0]['ds_nome_fantasia'];
  $nr_porte = $empresa[0]['nr_porte'];
  $ds_area_atuacao = $empresa[0]['ds_area_atuacao'];
  $ds_responsavel_cadastro = $empresa[0]['ds_nome_responsavel'];
  $ds_telefone = $empresa[0]['ds_telefone'];
  $ds_site = $empresa[0]['ds_site'];
  $ds_email = $empresa[0]['ds_email'];
  $ds_senha = $empresa[0]['ds_senha'];
}




?>

<!DOCTYPE html>
<html xml:lang="pt-BR" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<title>Cadastro empresa - Talents</title>

	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css'>
	<link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css'>
	<link rel="stylesheet" href="css/vaga.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>

	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyDVFKVgRK5cfSc-q-Mk_OacpyilcRANBrM"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/mapa.js"></script>
	<script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>


</head>
<body>

  <div class="container">
    <form class="well form-horizontal" name="formulario" id="formulario" method="post" action="cadastro_vaga.php" onSubmit="return enviardados();">
      <fieldset>
        <legend>Localização da vaga</legend>

        <!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label">Endereço</label>  
		  <div class="col-md-4 inputGroupContainer">
		  	<div class="input-group">
		  		<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
				<input style="width:70%;height: 100%;" type="text" id="txtEndereco" name="txtEndereco" class="form-control" />
                <input style="width:30%;height: 100%;" type="button" id="btnEndereco" name="btnEndereco" class="btn btn-warning" value="Mostrar no mapa" />
        	</div>
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label">Mapa</label>  
		  <div class="col-md-4 inputGroupContainer">
		  	<div class="input-group">
		  		<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
		  		<div style="width: 100%; height: 400px" id="mapa"></div>
		    </div>
		  </div>
		</div>

		<input type="hidden" id="txtLatitude" name="txtLatitude" />
    <input type="hidden" id="txtLongitude" name="txtLongitude" />

        <!-- Loader -->
        <div class="form-group">
          <label class="col-md-4 control-label"></label>
            <div class="col-md-4" style="text-align: center">
            <div class="loader" id="loader"></div>
          </div>
        </div>

		<!-- Success message -->
		<div class="form-group" style="text-align: center"> 
		  <span class="errMessage" id="errMessage"></span>
		</div>

        
        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label"></label>
          <div class="col-md-4">
            <button type="submit" name="btnEnviar" id="btnEnviar" class="btn btn-warning" >Confirmar <span class="glyphicon glyphicon-send"></span></button>
          </div>
        </div>


      </fieldset>
    </form>
  </div>

  <!--  Scripts-->
  <script type='text/javascript'>
      function enviardados(){
      	$('#loader').show();
      	$('#errMessage').hide();
      	if($('input[name="txtLatitude"]').val() == '')
		{	
			$('#loader').hide();
			document.getElementById('errMessage').innerHTML = 'Nenhuma localização encontrada!';
        	$('#errMessage').show();   //Informa o erro*/    
		return false;
		}
		$('#loader').hide();
		return true;
      }

  </script>

  </body>
</html>