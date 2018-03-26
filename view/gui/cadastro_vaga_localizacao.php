<!DOCTYPE html>
<html xml:lang="pt-BR" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Localização - Vaga</title>
	
	<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css'>
	<link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css'>
	<link rel="stylesheet" href="css/vaga.css">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyDVFKVgRK5cfSc-q-Mk_OacpyilcRANBrM"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/mapa.js"></script>
	<script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>

</head>
    
<body>

    <div  id="container">
    	<form class="well form-horizontal" name="contact_form" id="contact_form" method="post" action="index.html">    
 			<fieldset>

				<!-- Form Name -->
				<legend>Localização da vaga</legend>

				<!-- Text input-->

				<input id="txtEndereco" name="txtEndereco" placeholder="Digite aqui o endereço"  type="text">


				<div class="form-group">
				  <label class="col-md-4 control-label">Mapa</label>  
				  <div class="col-md-4 inputGroupContainer">
				  <div class="input-group">
				  <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
				  <div style="width: 100%; height: 400px" id="mapa"></div>
				    </div>
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
				    <button type="submit" value="Enviar" name="btnEnviar" class="btn btn-warning" >Continuar <span class="glyphicon glyphicon-send"></span></button>
				  </div>
				</div>
                
                <input type="hidden" id="txtLatitude" name="txtLatitude" />
                <input type="hidden" id="txtLongitude" name="txtLongitude" />

            </fieldset>
        </form>
    </div>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>
</body>
</html>


