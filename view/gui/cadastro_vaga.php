<?php

    require_once('../../controller/fachada.php');
    $fachada = Fachada::getInstance();

    $arraycargo = $fachada->cargoPesquisar();
    $arrayidioma = $fachada->idiomaPesquisar();
    $arraycurso = $fachada->cursoPesquisar();
    $arraycompetenciatecnica = $fachada->competenciaTecnicaPesquisar();
    $arraycompetenciacomport = $fachada->competenciaComportPesquisar();
?>

<!DOCTYPE html>
<html xml:lang="pt-BR" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Cadastro de vaga - Talents</title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css'>
  <link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css'>
  <link rel="stylesheet" href="css/vaga.css">
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />

  
</head>

<body>

  <div class="container">

    <form class="well form-horizontal" name="contact_form" id="contact_form">
<fieldset>

<!-- Form Name -->
<legend>Cadastro de vaga</legend>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Título</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
  <input  name="titulo" id="titulo" placeholder="Talents LTDA." class="form-control"  type="text">
    </div>
  </div>
</div>

<!-- Select Basic -->
   
<div class="form-group"> 
  <label class="col-md-4 control-label">Cargo</label>
  <div class="col-md-4 selectContainer">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
      <select name="cargo" id="cargo" class="form-control selectpicker" >
        <option value="">Selecione o cargo</option>
        <?php 

            foreach ($arraycargo as $key => $value) {
                if ($key == 'sucess'){
                    $arraycargo2 = $value;
                    foreach ($arraycargo2 as $key => $value) { 
                 
        ?>
                      <option value="<?php echo $value->cd_cargo; ?>"> <?php echo $value->ds_cargo; ?></option>

        <?php         
                        
                    }
                }
            }




        ?>
      </select>
    </div>
  </div>
</div>

<!-- Select Basic -->
   
<div class="form-group"> 
  <label class="col-md-4 control-label">Tipo de contratação</label>
  <div class="col-md-4 selectContainer">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
      <select name="tipocontratacao" id="tipocontratacao" class="form-control selectpicker" >
        <option value="">Selecione o tipo de contratação</option>
        <option value="1">Tempo indeterminado</option>
        <option value="2">Tempo determinado</option>
        <option value="3">Temporário</option>
        <option value="4">Aprendizagem</option>
      </select>
    </div>
  </div>
</div>

<!-- Text input-->
  <div class="form-group">
  <label class="col-md-4 control-label">Salário</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
  	<input name="salario" id="salario" placeholder="Valor do salário" class="form-control"  type="text">
    </div>
  </div>
</div>


<!-- Select Basic -->
   
<div class="form-group"> 
  <label class="col-md-4 control-label">Jornada de trabalho</label>
  <div class="col-md-4 selectContainer">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
      <select name="jornadatrabalho" id="jornadatrabalho" class="form-control selectpicker" >
        <option value="">Selecione a jornada de trabalho</option>
        <option value="1">Regime de tempo integral</option>
        <option value="2">Regime de tempo parcial</option>
      </select>
    </div>
  </div>
</div>

<!-- Select Basic -->
   
<div class="form-group"> 
  <label class="col-md-4 control-label">Experiência</label>
  <div class="col-md-4 selectContainer">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>
      <select name="experiencia" id="experiencia" class="form-control selectpicker" >
        <option value="">Selecione a experência necessaria</option>
        <option value="0">Sem experiência</option>
        <option value="1">menos de 1 ano</option>
        <option value="2">entre 1 a 2 anos</option>
        <option value="3">entre 2 a 3 anos</option>
        <option value="4">entre 3 a 4 anos</option>
        <option value="5">Acima de 5 anos</option>
      </select>
    </div>
  </div>
</div>

<!-- Text input-->
  <div class="form-group">
  <label class="col-md-4 control-label">Número de vagas</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  	<input style="padding-right: 0" name="quantidadevagas" id="quantidadevagas" placeholder="Quantidade de vagas" class="form-control"  type="number">
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Benefícios</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
  <textarea name="beneficios" id="beneficios" placeholder="Descreva os Benefícios destinados aos profissionais." class="form-control"  type="text"></textarea>
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Observação</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
  <textarea name="observacao" id="observacao" placeholder="Descreva aqui algo que ainda não foi mencionado." class="form-control"  type="text"></textarea>
    </div>
  </div>
</div>

<!-- Cursos -->

<div class="form-group" id="form-group">
	<label class="col-md-4 control-label">Curso(s)</label> 
	<div class="col-md-4 inputGroupContainer">
		<div class="input-group" style="width: 100%">
	    	<table class="table-cursos" id="table-cursos" style="width: 100%">
		    	<tr style="width: 100%">
		        	<th style="width: 100%"><select name="codigo_curso" id="codigo_curso" class="form-control selectpicker">
		                  <option value="">Curso(s) necessário(s)</option>
		                  <?php 

		                      foreach ($arraycurso as $key => $value) {
		                          if ($key == 'sucess'){
		                             $arraycurso2 = $value;
		                             foreach ($arraycurso2 as $key => $value) { 
		                  ?>
		                               <option value="<?php echo $value->cd_curso; ?>"> <?php echo $value->ds_curso.' - '.$value->ds_formacao; ?></option>

		                  <?php         
		                               
		                             }
		                          }
		                      }

		                  ?>
		            </select></th>
		            <th style="width: 100%"><input type="BUTTON" class="btn btn-warning" id="adicionar_curso" name="adicionar_curso" value="Adicionar" onclick="adicionarCurso()"/></th>
		      	</tr>
		      	<tbody id="itemlistCurso">
		      	</tbody>
	        </table>
        </div>
    </div>
  
</div>

<!-- competencias técnicas -->

<div class="form-group" id="form-group">
	<label class="col-md-4 control-label">Competência(s) Técnica(s)</label> 
	<div class="col-md-4 inputGroupContainer">
		<div class="input-group" style="width: 100%">
			<table class="table-tecnicas" id="table-tecnicas" style="width: 100%">  
		    	<tr style="width: 100%">
		        	  <th style="width: 100%"><select name="codigo_tecnica" id="codigo_tecnica" class="form-control selectpicker">
	                	<option value="">Técnica(s) necessária(s)</option>
	                  	<?php 
	                    	foreach ($arraycompetenciatecnica as $key => $value) {
	                        	if ($key == 'sucess'){
	                            	$arraycompetenciatecnica2 = $value;
	                            	foreach ($arraycompetenciatecnica2 as $key => $value) { 
	                  	?>
	                                	<option value="<?php echo $value->cd_competencia_tecnica; ?>"> <?php echo $value->ds_competencia_tecnica.' - '.$value->ds_tipo_competencia_tecnica; ?></option>

	                  <?php         
	                               
	                             	}
	                          	}
	                      	}
	                  ?>
		            </select></th>
		          	<th style="width: 100%"><input type="BUTTON" class="btn btn-warning" id="adicionar_tecnica" name="adicionar_tecnica" value="Adicionar" onclick="adicionarTecnica()"/></th>
		      	</tr>
		      	<tbody id="itemlistTecnica">
		      	</tbody>
		  	</table>
		</div>
	</div>
</div>

<!-- Habilidades -->

<div class="form-group" id="form-group">
  <label class="col-md-4 control-label">Competência(s) Comportamentais</label> 
  <div class="col-md-4 inputGroupContainer">
    <div class="input-group" style="width: 100%">
      <table class="table-comport" id="table-comport" style="width: 100%">  
          <tr style="width: 100%">
              <th style="width: 100%"><select name="codigo_comport" id="codigo_comport" class="form-control selectpicker">
                    <option value="">Comportamento(s) necessária(s)</option>
                      <?php 
                        foreach ($arraycompetenciacomport as $key => $value) {
                            if ($key == 'sucess'){
                                $arraycompetenciacomport2 = $value;
                                foreach ($arraycompetenciacomport2 as $key => $value) { 
                      ?>
                                    <option value="<?php echo $value->cd_competencia_comport; ?>"> <?php echo $value->ds_competencia_comport.' - '.$value->ds_tipo_competencia_comport; ?></option>

                    <?php         
                                 
                                }
                              }
                          }
                    ?>
                </select></th>
                <th style="width: 100%"><input type="BUTTON" class="btn btn-warning" id="adicionar_comport" name="adicionar_comport" value="Adicionar" onclick="adicionarComport()"/></th>
            </tr>
            <tbody id="itemlistComport">
            </tbody>
        </table>
    </div>
  </div>
</div>

<!-- idiomas -->

<div class="form-group" id="form-group">
	<label class="col-md-4 control-label">Idioma(s)</label>
	<div class="col-md-4 inputGroupContainer">
		<div class="input-group" style="width: 100%"> 
			<table class="table-idiomas" id="table-idiomas" style="width: 100%">
	    		<tr>
	        		<th style="width: 70%"><select name="codigo_idioma" id="codigo_idioma" class="form-control selectpicker">
	                	<option value="">Idioma(s) necessário(s)</option>
	                	<?php 
	                    	foreach ($arrayidioma as $key => $value) {
	                        	if ($key == 'sucess'){
	                           		$arrayidioma2 = $value;
	                           		foreach ($arrayidioma2 as $key => $value) { 
	                	?>
	                             		<option value="<?php echo $value->cd_idioma; ?>"> <?php echo $value->ds_idioma; ?></option>
	                	<?php         
	                             
	                           		}
	                        	}
	                    	}
	                	?>
	            		</select></th>
	       			<th style="width: 30%"><select name="nivel_idioma" id="nivel_idioma" class="form-control selectpicker">
    					<option value="">Nível</option>
    					<option value="1">Básico</option>
    					<option value="2">Médio</option>
    					<option value="3">Avançado</option>
    					</select>
	        		</th>
          			<th style="width: 100%"><input type="BUTTON" class="btn btn-warning" id="adicionar_idioma" name="adicionar_idioma" value="Adicionar" onclick="adicionarIdioma()"/></th>
	    		</tr>
	    		<tbody id="itemlistIdioma">
	    		</tbody>
			</table>
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
    <button type="submit" name="buttonSubmit" id="buttonSubmit" class="btn btn-warning" >Continuar <span class="glyphicon glyphicon-send"></span></button>
  </div>
</div>

</fieldset>
</form>
</div>
    </div><!-- /.container -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>

  

<script  src="js/vaga.js"></script>

<script type='text/javascript'>
    $(document).ready(function(){
      $('#errMessage').hide();
      $('#contact_form').submit(function(){  //Ao submeter formulário

        document.getElementById('buttonSubmit').disabled;


        //pega todos códigos dos idiomas
        var idiomaCodigo = [];
        $('input[name="itemidioma[codigo]"]').each(function(){
            idiomaCodigo.push($(this).val());
        });

        //pega todos niveis dos idiomas
        var idiomaNivel = [];
        $('input[name="itemidioma[nivel]"]').each(function(){
            idiomaNivel.push($(this).val());
        });

        //pegando todos os códigos das habilidades
        var tecnicaCodigo = [];
        $('input[name="itemtecnica[codigo]"]').each(function(){
            tecnicaCodigo.push($(this).val());
        });

        //pegando todos os códigos das habilidades
        var comportCodigo = [];
        $('input[name="itemcomport[codigo]"]').each(function(){
            comportCodigo.push($(this).val());
        });

        //pegando todos os códigos dos cursos
        var cursoCodigo = [];
        $('input[name="itemcurso[codigo]"]').each(function(){
            cursoCodigo.push($(this).val());
        });

        var titulo=$('#titulo').val();
        var cargo=$('#cargo').val();
        var observacao=$('#observacao').val();
        var tipocontratacao=$('#tipocontratacao').val();
        var salario=$('#salario').val();
        var jornadatrabalho=$('#jornadatrabalho').val();
        var experiencia=$('#experiencia').val();
        var quantidadevagas=$('#quantidadevagas').val();
        var beneficios=$('#beneficios').val();

        $.ajax({      //Função AJAX
          url:"valida_vaga.php",      //Arquivo php
          type:"post",        //Método de envio
          data: "titulo="+titulo+"&cargo="+cargo+"&observacao="+observacao+"&tipocontratacao="+tipocontratacao+"&salario="+salario+"&jornadatrabalho="+jornadatrabalho+"&experiencia="+experiencia+"&quantidadevagas="+quantidadevagas+"&beneficios="+beneficios+"&idiomaCodigo="+JSON.stringify(idiomaCodigo)+"&idiomaNivel="+JSON.stringify(idiomaNivel)+"&tecnicaCodigo="+JSON.stringify(tecnicaCodigo)+"&comportCodigo="+JSON.stringify(comportCodigo)+"&cursoCodigo="+JSON.stringify(cursoCodigo), //Dados*/
            success: function (result){     //Sucesso no AJAX
                        document.getElementById('errMessage').innerHTML = result;
                        $('#errMessage').show();   //Informa o erro*/
                        document.getElementById('buttonSubmit').enabled;
                    }
        })
        return false; //Evita que a página seja atualizada*/
      })
    });

    //função que adiciona o idioma na tela
    function adicionarIdioma()
    {

      //pega o valor dos componentes html que possuem esses id
      var codigo_idioma = $("#codigo_idioma").val();
      var descricao_idioma = $("#codigo_idioma option:selected").text();
      var nivel_idioma = $("#nivel_idioma").val();
      var descricao_nivel_idioma = $("#nivel_idioma option:selected").text();
      var items = "";


      
      if ((!codigo_idioma) || (!nivel_idioma))
      		return false;

      //esse codigo html vai ser inserido para o usuário ver na tela (esse itemidioma vai ser a lista utilizado para pegar os item depois)
      items += "<tr>";
      items += "<td><input type='hidden' name='itemidioma[codigo]' value='"+ codigo_idioma +"'>"+descricao_idioma+"</td>";
      items += "<td><input type='hidden' class='span2' name='itemidioma[nivel]' value='"+ nivel_idioma +"'>"+ descricao_nivel_idioma +"</td>";
      items += "<td><a href='javascript:void(0);' id='hapus'>Remove</a></td>";
      items += "</tr>";

      if ($("#itemlistIdioma tr").length == 0)
      {
          $("#itemlistIdioma").append(items);
      }else{
          var callback = checkListIdioma(codigo_idioma);
          if(callback === true){
              $("#itemlistIdioma").append(items);
              return false;
          }
      }
    }

    //função que adiciona o curso na tela
    function adicionarCurso()
    {

      //pega o valor dos componentes html que possuem esses id
      var codigo_curso = $("#codigo_curso").val();
      var descricao_curso = $("#codigo_curso option:selected").text();
      var items = "";

      if (!codigo_curso)
      		return false;

      //esse codigo html vai ser inserido para o usuário ver na tela (esse itemcurso vai ser a lista utilizado para pegar os item depois)
      items += "<tr>";
      items += "<td><input type='hidden' name='itemcurso[codigo]' value='"+ codigo_curso +"'>"+descricao_curso+"</td>";
      items += "<td><a href='javascript:void(0);' id='hapus'>Remove</a></td>";
      items += "</tr>";

      if ($("#itemlistCurso tr").length == 0)
      {
          $("#itemlistCurso").append(items);
      }else{
          var callback = checkListCurso(codigo_curso);
          if(callback === true){
              $("#itemlistCurso").append(items);
              return false;
          }
      }
    }

    //função que adiciona o habilidade na tela
    function adicionarTecnica()
    {
      //pega o valor dos componentes html que possuem esses id
      var codigo_tecnica = $("#codigo_tecnica").val();
      var descricao_tecnica = $("#codigo_tecnica option:selected").text();
      var items = "";

      if (!codigo_tecnica)
      		return false;

      //esse codigo html vai ser inserido para o usuário ver na tela (esse itemhabilidade vai ser a lista utilizado para pegar os item depois)
      //()
      items += "<tr>";
      items += "<td><input type='hidden' name='itemtecnica[codigo]' value='"+ codigo_tecnica +"'>"+descricao_tecnica+"</td>";
      items += "<td><a href='javascript:void(0);' id='hapus'>Remove</a></td>";
      items += "</tr>";

      if ($("#itemlistTecnica tr").length == 0)
      {
          $("#itemlistTecnica").append(items);
      }else{
          var callback = checkListTecnica(codigo_tecnica);
          if(callback === true){
              $("#itemlistTecnica").append(items);
              return false;
          }
      }
    }

    //função que adiciona o habilidade na tela
    function adicionarComport()
    {
      //pega o valor dos componentes html que possuem esses id
      var codigo_comport = $("#codigo_comport").val();
      var descricao_comport = $("#codigo_comport option:selected").text();
      var items = "";

      if (!codigo_comport)
          return false;

      //esse codigo html vai ser inserido para o usuário ver na tela (esse itemhabilidade vai ser a lista utilizado para pegar os item depois)
      //()
      items += "<tr>";
      items += "<td><input type='hidden' name='itemcomport[codigo]' value='"+ codigo_comport +"'>"+descricao_comport+"</td>";
      items += "<td><a href='javascript:void(0);' id='hapus'>Remove</a></td>";
      items += "</tr>";

      if ($("#itemlistComport tr").length == 0)
      {
          $("#itemlistComport").append(items);
      }else{
          var callback = checkListComport(codigo_comport);
          if(callback === true){
              $("#itemlistComport").append(items);
              return false;
          }
      }
    }


    //função para evitar de inserir 2 idiomas iguais
    function checkListIdioma(val){
        var cb = true;
        console.log($(codigo_idioma).val());
    
        $("#itemlistIdioma tr").each(function(index){
            var input = $(this).find("input[type='hidden']:first");
            if (input.val() == $(codigo_idioma).val()){
                cb = false;
            }
        });
        return cb;
    }

    //função para evitar de inserir 2 cursos iguais
    function checkListCurso(val){
        var cb = true;
        console.log($(codigo_curso).val());
    
        $("#itemlistCurso tr").each(function(index){
            var input = $(this).find("input[type='hidden']:first");
            if (input.val() == $(codigo_curso).val()){
                cb = false;
            }
        });
        return cb;
    }

    //função para evitar de inserir 2 habilidades iguais
    function checkListTecnica(val){
        var cb = true;
        console.log($(codigo_tecnica).val());
    
        $("#itemlistTecnica tr").each(function(index){
            var input = $(this).find("input[type='hidden']:first");
            if (input.val() == $(codigo_tecnica).val()){
                cb = false;
            }
        });
        return cb;
    }

    //função para evitar de inserir 2 habilidades iguais
    function checkListComport(val){
        var cb = true;
        console.log($(codigo_comport).val());
    
        $("#itemlistComport tr").each(function(index){
            var input = $(this).find("input[type='hidden']:first");
            if (input.val() == $(codigo_comport).val()){
                cb = false;
            }
        });
        return cb;
    }

    //função de remover idioma adicionado
    $("#itemlistIdioma").on("click","#hapus",function(){
        $(this).parent().parent().remove();
    });

    //função de remover curso adicionado
    $("#itemlistCurso").on("click","#hapus",function(){
        $(this).parent().parent().remove();
    });

    //função de remover habilidade adicionado
    $("#itemlistTecnica").on("click","#hapus",function(){
        $(this).parent().parent().remove();
    });

    //função de remover habilidade adicionado
    $("#itemlistComport").on("click","#hapus",function(){
        $(this).parent().parent().remove();
    });





  </script>




</body>

</html>
