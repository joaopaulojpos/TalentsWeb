<?php

if (isset($_SESSION['empresa'])) 
session_destroy();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");





?>

<!DOCTYPE html>
<html xml:lang="pt-BR" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>

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

        <div class="form-group">
          <label class="col-md-4 control-label">CNPJ</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
          <input style="width:70%;height: 100%;" name="cnpj" id="cnpj" placeholder="Ex: 00.000.000/0000-00" class="form-control"  type="text">
          <input style="width:30%;height: 100%;" name="buttonCarregarDados" class="btn btn-warning" id="buttonCarregarDados" type="button" value="Carregar" onclick="carregarDadosViaWebService()">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Razão Social</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
          <input name="razaosocial" id="razaosocial" placeholder="Ex: Talents LTDA." class="form-control"  type="text">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Nome Fantasia</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
          <input name="nomefantasia" id="nomefantasia" placeholder="Ex: Talents" class="form-control"  type="text">
            </div>
          </div>
        </div>

        <div class="form-group"> 
          <label class="col-md-4 control-label">Porte</label>
          <div class="col-md-4 selectContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span>
              <select name="porte" id="porte" class="form-control selectpicker" >
                <option value="">Selecione o porte atual</option>
                <option value="1">1 - 5</option>
                <option value="2">6 - 10</option>
                <option value="3">11 - 50</option>
                <option value="4">51 - 100</option>
                <option value="5">101 - 500</option>
                <option value="6">501 +</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Área de atuação</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
          <input name="areaatuacao" id="areaatuacao" placeholder="Ex: Técnologia da informação, saúde" class="form-control"  type="text">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Responsável pelo cadastro</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input name="responsavel" id="responsavel" placeholder="Ex: Tiago batera" class="form-control"  type="text">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Contato</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
          <input name="telefone" id="telefone" placeholder="Ex: 99 999999999" class="form-control"  type="text">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">E-mail</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
          <input name="email" id="email" placeholder="Ex: suporte@talents.com.br" class="form-control"  type="text">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Site</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
          <input name="site" id="site" placeholder="Ex: talents.com.br" class="form-control"  type="text">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Senha</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
          <input name="senha" id="senha" class="form-control"  type="password">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Confirmar Senha</label>  
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
          <input name="senhaconfirmacao" id="senhaconfirmacao" class="form-control"  type="password">
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
          data: "cnpj="+cnpj+"&razaosocial="+razao_social+"&nomefantasia="+nome_fantasia+"&porte="+porte+"&areaatuacao="+area_atuacao+"&responsavel="+responsavel+"&telefone="+telefone+"&site="+site+"&email="+email+"&senha="+senha, //Dados
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
