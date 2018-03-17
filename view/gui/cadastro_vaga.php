﻿<?php

    require_once('../../controller/fachada.php');
    $fachada = Fachada::getInstance();

    $arraycargo = $fachada->cargoPesquisar();
    $arrayidioma = $fachada->idiomaPesquisar();
    $arraycurso = $fachada->cursoPesquisar();
    $arrayhabilidade = $fachada->habilidadePesquisar();
?>

<!DOCTYPE html>
<html xml:lang="pt-BR" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Cadastro de vaga - Talents</title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
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
  <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
  <input  name="titulo" id="titulo" placeholder="Talents LTDA." class="form-control"  type="text">
    </div>
  </div>
</div>

<!-- Select Basic -->
   
<div class="form-group"> 
  <label class="col-md-4 control-label">Cargo</label>
  <div class="col-md-4 selectContainer">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
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
      <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
      <select name="tipocontratacao" id="tipocontratacao" class="form-control selectpicker" >
        <option value="">Selecione o tipo de contratação</option>
        <option value="tempo indeterminado">Tempo indeterminado</option>
        <option value="tempo determinado">Tempo determinado</option>
        <option value="temporario">Temporário</option>
        <option value="aprendizagem">Aprendizagem</option>
      </select>
    </div>
  </div>
</div>

<!-- Text input-->
  <div class="form-group">
  <label class="col-md-4 control-label">Salário</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  	<input name="salario" id="salario" placeholder="Valor do salário" class="form-control"  type="text">
    </div>
  </div>
</div>


<!-- Select Basic -->
   
<div class="form-group"> 
  <label class="col-md-4 control-label">Jornada de trabalho</label>
  <div class="col-md-4 selectContainer">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
      <select name="jornadatrabalho" id="jornadatrabalho" class="form-control selectpicker" >
        <option value="">Selecione a jornada de trabalho</option>
        <option value="tempo integral">Regime de tempo integral</option>
        <option value="tempo parcial">Regime de tempo parcial</option>
      </select>
    </div>
  </div>
</div>

<!-- Select Basic -->
   
<div class="form-group"> 
  <label class="col-md-4 control-label">Experiência</label>
  <div class="col-md-4 selectContainer">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
      <select name="experiencia" id="experiencia" class="form-control selectpicker" >
        <option value="">Selecione a experência necessaria</option>
        <option value="tempo integral">Sem experiência</option>
        <option value="tempo parcial">1 ano</option>
        <option value="tempo parcial">2 anos</option>
        <option value="tempo parcial">3 anos</option>
        <option value="tempo parcial">4 anos</option>
        <option value="tempo parcial">Acima de 5 anos</option>
      </select>
    </div>
  </div>
</div>

<!-- Text input-->
  <div class="form-group">
  <label class="col-md-4 control-label">Quantidade de vagas</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  	<input name="quantidadevagas" id="quantidadevagas" placeholder="Quantidade de vagas" class="form-control"  type="number">
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Benefícios</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
  <textarea name="beneficios" id="beneficios" placeholder="Descreva os benefícios que os profissionais terão direitos" class="form-control"  type="text"></textarea>
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Observação</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
  <textarea name="observacao" id="observacao" placeholder="Descreva em poucas palavras o que o profissional irá enfrentar nesse novo emprego" class="form-control"  type="text"></textarea>
    </div>
  </div>
</div>

<!-- Cursos -->

<div class="form-group" id="form-group">
  <table class="table-cursos" id="table-cursos">
    <label class="col-md-4 control-label">Curso(s)</label> 
      <tr>
          <th style="width: 100%"><select name="codigo_curso" id="codigo_curso" class="form-control selectpicker">
                  <option>Selecione o curso necessário a vaga</option>
                  <?php 

                      foreach ($arraycurso as $key => $value) {
                          if ($key == 'sucess'){
                             $arraycurso2 = $value;
                             foreach ($arraycurso2 as $key => $value) { 
                  ?>
                               <option value="<?php echo $value->cd_curso; ?>"> <?php echo $value->ds_curso; ?></option>

                  <?php         
                               
                             }
                          }
                      }




                  ?>
              </select></th>

          <th><input type="BUTTON" class="btn btn-warning" id="adicionar_curso" name="adicionar_curso" value="Adicionar" onclick="adicionarCurso()"/></th>
      </tr>
      <tbody id="itemlistCurso">
      </tbody>
  </table>
</div>

<!-- Habilidades -->

<div class="form-group" id="form-group">
  <table class="table-habilidades" id="table-habilidades">
    <label class="col-md-4 control-label">Habilidade(s)</label> 
      <tr>
          <th style="width: 100%"><select name="codigo_habilidade" id="codigo_habilidade" class="form-control selectpicker">
                  <option>Selecione a(s) habilidade(s) necessária(s) a vaga</option>
                  <?php 

                      foreach ($arrayhabilidade as $key => $value) {
                          if ($key == 'sucess'){
                             $arrayhabilidade2 = $value;
                             foreach ($arrayhabilidade2 as $key => $value) { 
                  ?>
                               <option value="<?php echo $value->cd_habilidade; ?>"> <?php echo $value->ds_habilidade; ?></option>

                  <?php         
                               
                             }
                          }
                      }




                  ?>
              </select></th>

          <th><input type="BUTTON" class="btn btn-warning" id="adicionar_habilidade" name="adicionar_habilidade" value="Adicionar" onclick="adicionarHabilidade()"/></th>
      </tr>
      <tbody id="itemlistHabilidade">
      </tbody>
  </table>
</div>

<!-- idiomas -->

<div class="form-group" id="form-group">
	<table class="table-idiomas" id="table-idiomas">
    <label class="col-md-4 control-label">Idioma(s)</label> 
	    <tr>
	        <th style="width: 75%"><select name="codigo_idioma" id="codigo_idioma" class="form-control selectpicker">
	                <option>Selecione o idioma necessário a vga</option>
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

	        <th style="width: 25%"><select name="nivel_idioma" id="nivel_idioma" class="form-control selectpicker">
    					<option value="">Selecione o nível</option>
    					<option value="1">Básico</option>
    					<option value="2">Médio</option>
    					<option value="3">Avançado</option>
    				  </select>
	        </th>
          <th><input type="BUTTON" class="btn btn-warning" id="adicionar_idioma" name="adicionar_idioma" value="Adicionar" onclick="adicionarIdioma()"/></th>
	    </tr>
	    <tbody id="itemlistIdioma">
	    </tbody>
	</table>
</div>

<!-- Success message -->
<div class="form-group" style="text-align: center"> 
  <span class="errMessage" id="errMessage"></span>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-warning" >Continuar <span class="glyphicon glyphicon-send"></span></button>
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
          data: "titulo="+titulo+"&cargo="+cargo+"&observacao="+observacao+"&tipocontratacao="+tipocontratacao+"&salario="+salario+"&jornadatrabalho="+jornadatrabalho+"&experiencia="+experiencia+"&quantidadevagas="+quantidadevagas+"&beneficios="+beneficios, //Dados
            success: function (result){     //Sucesso no AJAX
                        /*if(result==1){        
                          location.href='vaga.php';  //Redireciona
                        }else{
                          document.getElementById('errMessage').innerHTML = result;
                          $('#errMessage').show();   //Informa o erro
                        }*/
                        document.getElementById('errMessage').innerHTML = result;
                        $('#errMessage').show();   //Informa o erro
                    }
        })
        return false; //Evita que a página seja atualizada
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
      //esse codigo html vai ser inserido para o usuário ver na tela (esse itemidioma vai ser a lista utilizado para pegar os item depois)
      items += "<tr>";
      items += "<td><input type='hidden' name='itemidioma[codigo][]' value='"+ codigo_idioma +"'>"+descricao_idioma+"</td>";
      items += "<td><input type='hidden' class='span2' name='itemidioma[nivel][]' value='"+ nivel_idioma +"'>"+ descricao_nivel_idioma +"</td>";
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

      //esse codigo html vai ser inserido para o usuário ver na tela (esse itemcurso vai ser a lista utilizado para pegar os item depois)
      items += "<tr>";
      items += "<td><input type='hidden' name='itemcurso[codigo][]' value='"+ codigo_curso +"'>"+descricao_curso+"</td>";
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
    function adicionarHabilidade()
    {
      //pega o valor dos componentes html que possuem esses id
      var codigo_habilidade = $("#codigo_habilidade").val();
      var descricao_habilidade = $("#codigo_habilidade option:selected").text();
      var items = "";

      //esse codigo html vai ser inserido para o usuário ver na tela (esse itemhabilidade vai ser a lista utilizado para pegar os item depois)
      //()
      items += "<tr>";
      items += "<td><input type='hidden' name='itemhabilidadee[codigo][]' value='"+ codigo_habilidade +"'>"+descricao_habilidade+"</td>";
      items += "<td><a href='javascript:void(0);' id='hapus'>Remove</a></td>";
      items += "</tr>";

      if ($("#itemlistHabilidade tr").length == 0)
      {
          $("#itemlistHabilidade").append(items);
      }else{
          var callback = checkListHabilidade(codigo_habilidade);
          if(callback === true){
              $("#itemlistHabilidade").append(items);
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
    function checkListHabilidade(val){
        var cb = true;
        console.log($(codigo_habilidade).val());
    
        $("#itemlistIdioma tr").each(function(index){
            var input = $(this).find("input[type='hidden']:first");
            if (input.val() == $(codigo_habilidade).val()){
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
    $("#itemlistHabilidade").on("click","#hapus",function(){
        $(this).parent().parent().remove();
    });





  </script>




</body>

</html>