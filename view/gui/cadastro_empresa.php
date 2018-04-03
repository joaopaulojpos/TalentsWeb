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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/jquery.mask.min.js"></script>
    <title>Talents - Cadastre sua Empresa</title>
</head>

<body class="back">

    <div class="container">
        <div class="row center">
            <h5>
                <b>Cadastre sua empresa</b>
            </h5>
            <br/> Se você chegou até aqui, é porque gostou da proposta da plataforma
            <br/> Então está esperando o que ? Preencha o formulário abaixo e seja feliz
            <br/> Venha fazer parte dessa revolução no mundo do recrutamento.
        </div>

        <form name="formulario" id="formulario">
            <div class="container">
                <input type="hidden" value="<?php echo $cd_empresa ?>" name="cd_empresa" id="cd_empresa"/>
                <div class="row">
                    <div class="input-field col s12 m10">
                        <i class="material-icons prefix">info</i>
                        <input name="cnpj" id="cnpj" type="text" value="<?php echo $nr_cnpj ?>" title="Digite o CNPJ no formato nn.nnn.nnn/nnnn-nn" placeholder="00.000.000/0000-00">
                        <label for="cnpj">CNPJ</label>
                    </div>

                    <div class="input-field col s12 m2">
                        <input class="btn waves-effect waves-light teal darken-1" type="button" name="buttonCarregarDados" id="buttonCarregarDados" value="Buscar" onclick="carregarDadosViaWebService()">
                    </div>

                    <div class="input-field col s12 m12">
                        <i class="material-icons prefix">business_center</i>
                        <input name="razaosocial" id="razaosocial" type="text" value="<?php echo $ds_razao_social ?>">
                        <label for="razaosocial">Razão Social</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <i class="material-icons prefix">business_center</i>
                        <input name="nomefantasia" id="nomefantasia" type="text" value="<?php echo $ds_nome_fantasia ?>">
                        <label for="nomefantasia">Nome Fantasia</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">book</i>
                        <input id="areaatuacao" name="areaatuacao" type="text" value="<?php echo $ds_area_atuacao ?>">
                        <label for="areaatuacao">Área de atuação</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <select name="porte" id="porte">
                            <option value="" disabled selected>Selecione o porte atual</option>
                            <option value="1" <?php echo $nr_porte=='1'?'selected':'';?>> 1 - 5 </option>
                            <option value="2" <?php echo $nr_porte=='2'?'selected':'';?>> 6 - 10 </option>
                            <option value="3" <?php echo $nr_porte=='3'?'selected':'';?>> 11 - 50 </option>
                            <option value="4" <?php echo $nr_porte=='4'?'selected':'';?>> 51 - 100 </option>
                            <option value="5" <?php echo $nr_porte=='5'?'selected':'';?>> 101 - 500 </option>
                            <option value="6" <?php echo $nr_porte=='6'?'selected':'';?>> 500 + </option>
                        </select>
                        <label>Porte</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <i class="material-icons prefix">assignment_ind</i>
                        <input id="responsavel" name="responsavel" type="text" value="<?php echo $ds_responsavel_cadastro ?>">
                        <label for="responsavel">Responsável pelo cadastro</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <i class="material-icons prefix">contacts</i>
                        <input id="telefone" name="telefone" type="text" value="<?php echo $ds_telefone ?>" placeholder="99 999999999">
                        <label for="telefone">Contato</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <i class="material-icons prefix">email</i>
                        <input id="email" name="email" type="text" value="<?php echo $ds_email ?>">
                        <label for="email">Email</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <i class="material-icons prefix">language</i>
                        <input id="site" name="site" value="<?php echo $ds_site ?>">
                        <label for="site">Site</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <i class="material-icons prefix">https</i>
                        <input id="senha" name="senha" type="password" value="<?php echo $ds_senha ?>">
                        <label for="senha">Senha</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <i class="material-icons prefix">https</i>
                        <input id="senhaconfirmacao" name="senhaconfirmacao" type="password" value="<?php echo $ds_senha ?>">
                        <label for="senhaconfirmacao">Confirmar Senha</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <span id="loader"></span>
                    </div>

                    <div class="input-field col s12 m12">
                        <span id="errMessage"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s6 m6 offset-s2 offset-m2">
                    <button class="btn waves-effect waves-light" type="submit" name="buttonSubmit" id="buttonSubmit">Cadastrar
                        <i class="material-icons right">send</i>
                    </button>         
                </div>
            </div>
        </form>
    </div>


        <!-- JavaScript do Materialize -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

    <!-- Materialize Compentes -->
  <script type='text/javascript'>
    $(document).ready(function(){
      
      $('select').material_select();
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
                              Materialize.toast('Não foi possível carregar os dados do cnpj digitado!', 4000);
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
                        //document.getElementById('errMessage').innerHTML = 'Não foi possível carregar os dados do cnpj digitado!';
                        Materialize.toast('Não foi possível carregar os dados do cnpj digitado!', 4000);
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