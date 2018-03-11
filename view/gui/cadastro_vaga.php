<?php

    require_once('../../controller/fachada.php');
    $fachada = Fachada::getInstance();

    $array = $fachada->cargoPesquisar();
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

    <form class="well form-horizontal" action="" method="post"  id="contact_form">
<fieldset>

<!-- Form Name -->
<legend>Cadastro de vaga</legend>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Título</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
  <input  name="titulo" placeholder="Talents LTDA." class="form-control"  type="text">
    </div>
  </div>
</div>

<!-- Select Basic -->
   
<div class="form-group"> 
  <label class="col-md-4 control-label">Cargo</label>
  <div class="col-md-4 selectContainer">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
      <select name="state" class="form-control selectpicker" >
        <option value="">Selecione o cargo</option>
        <?php 

            foreach ($array as $key => $value) {
                if ($key == 'sucess'){
                    $array2 = $value;
                    foreach ($array2 as $key => $value) { 
                 
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

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Descrição</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
  <textarea name="descricao" placeholder="Descreva em poucas palavras o que o profissional irá enfrentar nesse novo emprego" class="form-control"  type="text"></textarea>
    </div>
  </div>
</div>

<!-- Select Basic -->
   
<div class="form-group"> 
  <label class="col-md-4 control-label">Tipo de contratação</label>
  <div class="col-md-4 selectContainer">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
      <select name="state" class="form-control selectpicker" >
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
  <input name="salario" placeholder="Valor do salário" class="form-control"  type="text">
    </div>
  </div>
</div>


<!-- Select Basic -->
   
<div class="form-group"> 
  <label class="col-md-4 control-label">Jornada de trabalho</label>
  <div class="col-md-4 selectContainer">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
      <select name="state" class="form-control selectpicker" >
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
      <select name="state" class="form-control selectpicker" >
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
      $('#formlogin').submit(function(){  //Ao submeter formulário
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
