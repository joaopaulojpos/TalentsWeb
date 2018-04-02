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
  <script type="text/javascript" src="js/jquery.mask.js"></script>
  <script type="text/javascript" src="js/jquery.mask.min.js"></script>
</head>
<body>

  <div class="container">
    <form class="well form-horizontal" name="formulario" id="formulario">
      <fieldset>
        <legend>Cadastro</legend>

        <input type="hidden" value="<?php echo $cd_empresa ?>" name="cd_empresa" id="cd_empresa"/>

        <div class="form-group">
          <label class="col-md-4 control-label">CNPJ</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
          <input style="width:70%;height: 100%;" value="<?php echo $nr_cnpj ?>" name="cnpj" id="cnpj" placeholder="Ex: 00.000.000/0000-00" class="form-control"  type="text">
          <input style="width:30%;height: 100%;" name="buttonCarregarDados" class="btn btn-warning" id="buttonCarregarDados" type="button" value="Carregar" onclick="carregarDadosViaWebService()">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Razão Social</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
          <input name="razaosocial" id="razaosocial" value="<?php echo $ds_razao_social ?>" placeholder="Ex: Talents LTDA." class="form-control"  type="text">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Nome Fantasia</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
          <input name="nomefantasia" id="nomefantasia" value="<?php echo $ds_nome_fantasia ?>" placeholder="Ex: Talents" class="form-control"  type="text">
            </div>
          </div>
        </div>

        <div class="form-group"> 
          <label class="col-md-4 control-label">Porte</label>
          <div class="col-md-4 selectContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span>
              <select name="porte" id="porte" class="form-control selectpicker">
                <option value="">Selecione o porte atual</option>
                <option value="1" <?php echo $nr_porte=='1'?'selected':'';?> >1 - 5</option>
                <option value="2" <?php echo $nr_porte=='2'?'selected':'';?> >6 - 10</option>
                <option value="3" <?php echo $nr_porte=='3'?'selected':'';?> >11 - 50</option>
                <option value="4" <?php echo $nr_porte=='4'?'selected':'';?> >51 - 100</option>
                <option value="5" <?php echo $nr_porte=='5'?'selected':'';?> >101 - 500</option>
                <option value="6" <?php echo $nr_porte=='6'?'selected':'';?> >501 +</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Área de atuação</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
          <input name="areaatuacao" id="areaatuacao" value="<?php echo $ds_area_atuacao ?>" placeholder="Ex: Técnologia da informação, saúde" class="form-control"  type="text">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Responsável pelo cadastro</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input name="responsavel" id="responsavel" value="<?php echo $ds_responsavel_cadastro ?>" placeholder="Ex: Tiago batera" class="form-control"  type="text">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Contato</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
          <input name="telefone" id="telefone" value="<?php echo $ds_telefone ?>" placeholder="Ex: 99 999999999" class="form-control"  type="text">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">E-mail</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
          <input name="email" id="email" value="<?php echo $ds_email ?>" placeholder="Ex: suporte@talents.com.br" class="form-control"  type="text">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Site</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
          <input name="site" id="site" value="<?php echo $ds_site ?>" placeholder="Ex: talents.com.br" class="form-control"  type="text">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Senha</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
          <input name="senha" id="senha" value="<?php echo $ds_senha ?>" class="form-control"  type="password">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Confirmar Senha</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
          <input name="senhaconfirmacao" id="senhaconfirmacao" value="<?php echo $ds_senha ?>" class="form-control"  type="password">
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
            <p>Sua empresa já possui um login? <a href="login.php">Entre!</a></p>
          </div>
        </div>

        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label"></label>
          <div class="col-md-4">
            <button type="submit" name="buttonSubmit" id="buttonSubmit" class="btn btn-warning" >Confirmar <span class="glyphicon glyphicon-send"></span></button>
          </div>
        </div>


      </fieldset>
    </form>
  </div>

  <!--  Scripts-->
  <script src="js/vaga.js"></script>
  <script type='text/javascript'>
    $(document).ready(function(){
      $('#errMessage').hide(); //Esconde o elemento com id errolog
      $('#loader').hide();


      $('#telefone').mask('(00) 00000-0000');
      $('#cnpj').mask('00.000.000/0000-00');

      $('#email').mask("A", {
        translation: {
          "A": { pattern: /[\w@\-.+]/, recursive: true }
        }
      });

      $('#site').mask("A", {
        translation: {
          "A": { pattern: /[\w@\-.+]/, recursive: true }
        }
      });

      $('#formulario').submit(function(){  //Ao submeter formulário
        $('#loader').show();
        var codigo_empresa=$('#cd_empresa').val();
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
        var senhaconfirmacao=$('#senhaconfirmacao').val();

        if (senha != senhaconfirmacao){
          document.getElementById('errMessage').innerHTML = 'A senha e a confirmação de senhas estão divergentes!';
          $('#loader').hide();
          $('#errMessage').show(); 
          return false; 
        }

        $.ajax({      //Função AJAX
          url:"valida_cadastro.php",      //Arquivo php
          type:"post",        //Método de envio
          data: "cd_empresa="+codigo_empresa+"&cnpj="+cnpj+"&razaosocial="+razao_social+"&nomefantasia="+nome_fantasia+"&porte="+porte+"&areaatuacao="+area_atuacao+"&responsavel="+responsavel+"&telefone="+telefone+"&site="+site+"&email="+email+"&senha="+senha, //Dados
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
    });

    function carregarDadosViaWebService() {
      document.getElementById('loader').style.display = 'block';
      var teste = document.getElementById('cnpj').value.replace(/[^\d]+/g,'');
      $.ajax({      //Função AJAX
        url:"carrega_dados_cadastro_empresa.php",      //Arquivo php
        type:"post",        //Método de envio
        data: "cnpj="+teste, //Dados
          success: function (result){     //Sucesso no AJAX
                      //alert(JSON.parse(result));
                      //alert(JSON.parse(result).atividade_principal);
                      /*for (var i = 0; i < ; i++){
                          var value = object[i];
                          var index = i;   // desnecessário, mas coloquei para clarificar
                          alert(value);
                      }*/ 
                      try {
                        var dados = JSON.parse(result);

                        for (key in dados) {  
                          if (key == 'status'){
                            if (dados[key] == 'ERROR'){
                              document.getElementById('errMessage').innerHTML = 'Não foi possível carregar os dados do cnpj digitado!';
                              $('#loader').hide();
                              $('#errMessage').show();   //Informa o erro 
                              return false;
                            }
                          }else if (key == 'nome'){
                            document.getElementById('razaosocial').value = dados[key];
                          }else if (key == 'telefone'){
                            document.getElementById('telefone').value = dados[key];
                          }else if (key == 'fantasia'){
                            document.getElementById('nomefantasia').value = dados[key];
                          }else if (key == 'email'){
                            document.getElementById('email').value = dados[key];
                          }else if (key == 'atividade_principal'){ 
                            for (atividade in dados[key][0]){
                              if (atividade == 'text'){
                                document.getElementById('areaatuacao').value = dados[key][0][atividade]; 
                              }
                            }

                          }
                        }
                      }catch (e) {
                        document.getElementById('errMessage').innerHTML = 'Não foi possível carregar os dados do cnpj digitado!';
                        $('#loader').hide();
                        $('#errMessage').show();   //Informa o erro
                      }finally {
                        $('#loader').hide();
                      }
                   }
      });
      //document.getElementById('loader').style.display = 'none';
    }

  </script>

  </body>
</html>
