<?php
include "menu2.php";
include "foooter.php";

if (!isset($_SESSION['empresaLogada'])) {   //Verifica se há seções
    session_destroy();            //Destroi a seção por segurança
    header("Location: login.php"); 
    exit; //Redireciona o visitante para login
  }

  if(empty($_POST['txtLatitude']) && empty($_POST['txtLongitude'])){
    header("Location: cadastro_vaga_localizacao.php"); 
    exit; //Redireciona o visitante para login
  }

  require_once('../../controller/fachada.php');
  $fachada = Fachada::getInstance();

  $cd_empresa = '';
  $latitude = $_POST['txtLatitude'];
  $longitude = $_POST['txtLongitude'];
  $endereco = trim($_POST['txtEndereco']);

  if (isset($_SESSION['empresaLogada'])) {
    $empresa = $_SESSION['empresaLogada']; 

    $cd_empresa = $empresa[0]['cd_empresa'];
  }

  $arraycargo = $fachada->cargoPesquisar();
  $arrayidioma = $fachada->idiomaPesquisar();
  $arraycurso = $fachada->cursoPesquisar();
  $arraycompetenciatecnica = $fachada->competenciaTecnicaPesquisar();
  $arraycompetenciacomport = $fachada->competenciaComportPesquisar();

?>

<section="section">

    <div class="container">
        <div class="row center">
            <h5>
                <b>Publicar uma nova vaga</b>
            </h5>
            <br/> Sua vaga e encontramos o talento certo para sua empresa !
            <br/> Sabe aquela papelada ? aquelas horas e horas conferindo linha a linha cada curriculum ?
            <br/> Você esta a um passo de acabar com isso só basta publicar a sua vaga,
            <br/> e a mágica fica por nossa conta.
        </div>

        <form name="formulario" id="formulario">

        <input type="hidden" value="<?php echo $cd_empresa ?>" name="cd_empresa" id="cd_empresa"/>
        <input type="hidden" value="<?php echo $latitude ?>" name="latitude" id="latitude"/>
        <input type="hidden" value="<?php echo $longitude ?>" name="longitude" id="longitude"/>
        <input type="hidden" value="<?php echo $endereco ?>" name="endereco" id="endereco"/>

            <div class="container">
                <div class="row">
                    <div class="input-field col s12 m12">
                        <i class="material-icons prefix">domain</i>
                        <input id="titulo" name="titulo" type="text" class="validate" minlength="3" required>
                        <label for="titulo">Título da vaga</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <select name="cargo" id="cargo">
                            <option value="" disabled selected>Selecione o Cargo</option>
                            <?php 
                                foreach ($arraycargo as $key => $value) {
                                    if ($key == 'sucess'){
                                        $arraycargo2 = $value;
                                        foreach ($arraycargo2 as $key => $value) { 
                                    
                            ?>

                            <option value="<?php echo $value->cd_cargo; ?>"><?php echo $value->ds_cargo; ?></option>
                            <?php         
                        
                                        }
                                    }
                                }
                            ?>
                        </select>
                        <label>Cargo</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <select name="tipocontratacao" id="tipocontratacao">
                            <option value="" disabled selected>Regime de contratação</option>
                            <option value="1">CLT</option>
                            <option value="2">PJ</option>
                            <option value="3">Freelancer</option>
                            <option value="3">Estágio</option>
                        </select>
                        <label>Contratação</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">monetization_on</i>
                        <input name="salario" id="salario" type="text" class="validate" required>
                        <label for="salario">Salário</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">filter_1</i>
                        <input name="quantidadevagas" id="quantidadevagas" type="number" class="validate" required>
                        <label for="quantidadevagas">Quantidade de vagas</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <select name="jornadatrabalho" id="jornadatrabalho">
                            <option value="" disabled selected>Jornada de Trabalho</option>
                            <option value="1">Regime Integral</option>
                            <option value="2">Regime Parcial</option>
                        </select>
                        <label>Jornada</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <select name="experiencia" id="experiencia">
                            <option value="" disabled selected>Experiência</option>
                            <option value="0">Sem Experiência</option>
                            <option value="1">Menos de 1 Ano</option>
                            <option value="2">Entre 1 a 2 Anos</option>
                            <option value="3">Entre 2 a 3 Anos</option>
                            <option value="4">Entre 3 a 4 Anos</option>
                            <option value="5">Acima de 5 Anos</option>
                        </select>
                        <label>Experiência</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <textarea name="beneficios" id="beneficios" class="materialize-textarea" minlength="5" required></textarea>
                        <label for="beneficios">Benefícios</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <textarea name="observacao" id="observacao" class="materialize-textarea" minlength="10" required></textarea>
                        <label for="observacao">Descrição das atividades</label>
                    </div>

                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="input-field col s12 m9">
                        <select name="codigo_curso" id="codigo_curso">
                            <option value="" disabled selected>Escolha os cursos</option>
                            <?php 
                                foreach ($arraycurso as $key => $value) {
                                    if ($key == 'sucess'){
                                    $arraycurso2 = $value;
                                    foreach ($arraycurso2 as $key => $value) { 
                            ?>
                            <option value="<?php echo $value->cd_curso; ?>"><?php echo $value->ds_curso.' - '.$value->ds_formacao; ?></option>
                            <?php         
                                        
                                        }
                                    }
                                }

                            ?>
                        </select>
                        <table class="table-cursos" id="table-cursos">
                            <tbody id="itemlistCurso">
                            </tbody>
                        </table>
                       <!-- <label>Cursos Desejado Para Vaga</label> -->
                    </div>

                    <div class="col s12 m2"> 
                        <input type="BUTTON" class="btn waves-effect waves-light" id="adicionar_curso" name="adicionar_curso" value="Adicionar" onclick="adicionarCurso()"/>        
                    </div>

                    <div class="input-field col s12 m9">
                        <select name="codigo_comport" id="codigo_comport">
                            <option value="" disabled selected>Competência(s) Comportamentais</option>
                            <?php 
                                foreach ($arraycompetenciacomport as $key => $value) {
                                    if ($key == 'sucess'){
                                        $arraycompetenciacomport2 = $value;
                                        foreach ($arraycompetenciacomport2 as $key => $value) { 
                            ?>
                            <option value="<?php echo $value->cd_competencia_comport; ?>"><?php echo $value->ds_competencia_comport.' - '.$value->ds_tipo_competencia_comport; ?></option>
                            <?php         
                                        
                                        }
                                    }
                                }
                            ?>
                        </select>
                        <label>Competência(s) Comportamentais</label>
                    </div>
                    
                    <div class="col s12 m2"> 
                        <input type="BUTTON" class="btn waves-effect waves-light" id="adicionar_comport" name="adicionar_comport" value="Adicionar" onclick="adicionarComport()"/>        
                    </div>
                    
                    <div class="input-field col s12 m6">
                        <select name="codigo_tecnica" id="codigo_tecnica">
                            <option value="" disabled selected>Competência(s) Técnica(s)</option>
                            <?php 
	                    	foreach ($arraycompetenciatecnica as $key => $value) {
	                        	if ($key == 'sucess'){
	                            	$arraycompetenciatecnica2 = $value;
	                            	foreach ($arraycompetenciatecnica2 as $key => $value) { 
                            ?>
                            <option value="<?php echo $value->cd_competencia_tecnica; ?>"><?php echo $value->ds_competencia_tecnica.' - '.$value->ds_tipo_competencia_tecnica; ?></option>
                            <?php         
	                               
                                            }
                                        }
                                    }
                            ?>
                            </select>
                        <label>Competência(s) Técnica(s)</label>
                    </div>

                    <div class="input-field col s12 m3">
                        <select name="nivel_tecnica" id="nivel_tecnica">
                            <option value="" disabled selected>Nível</option>
                            <option value="1">Básico</option>
                            <option value="2">Médio</option>
                            <option value="3">Avançado</option>
                        </select>
                        <label>Escolha o nível</label>
                    </div>

                    <div class="col s12 m3"> 
                        <input type="BUTTON" class="btn waves-effect waves-light" id="adicionar_tecnica" name="adicionar_tecnica" value="Adicionar" onclick="adicionarTecnica()"/>        
                    </div>

                    <div class="input-field col s12 m6">
                        <select name="codigo_idioma" id="codigo_idioma">
                            <option value="" disabled selected>Idiomas</option>
                            <?php 
                                foreach ($arrayidioma as $key => $value) {
                                    if ($key == 'sucess'){
                                        $arrayidioma2 = $value;
                                        foreach ($arrayidioma2 as $key => $value) { 
                            ?>
                            <option value="<?php echo $value->cd_idioma; ?>"> <?php echo $value->ds_idioma; ?> </option>
                            <?php                                               
                                        }
                                    }
                                }
                            ?>
                        </select>
                        <label>Escolha os idiomas desejáveis</label>
                    </div>

                    <div class="input-field col s12 m3">
                        <select name="nivel_idioma" id="nivel_idioma">
                            <option value="" disabled selected>Senioridade</option>
                            <option value="1">Básico</option>
                            <option value="2">Médio</option>
                            <option value="3">Avançado</option>
                        </select>
                        <label>Escolha o nível</label>
                    </div>
                    
                    <div class="col s12 m3"> 
                        <input type="BUTTON" class="btn waves-effect waves-light" id="adicionar_idioma" name="adicionar_idioma" value="Adicionar" onclick=""/>        
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="container center">
                    <span class="errMessage" id="errMessage"></span>
                </div>
            </div>

            <div class="row">
                <div class="container center">
                    <div class="loader" id="loader"></div>
                </div>
            </div>

            <div class="row">
                <div class="col s4 m4 offset-s2 offset-m2">
                    <button class="btn waves-effect waves-light" type="submit" name="buttonSubmit" id="buttonSubmit">Criar
                        <i class="material-icons right">send</i>
                    </button>         
                </div>
            </div>
        </form>
    </div>
</section>

<script type='text/javascript'>
    $(document).ready(function(){
    /*  $('#errMessage').hide();
      $('#formulario').submit(function(){  //Ao submeter formulário

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

        //pega todos niveis das habilidades
        var tecnicaNivel = [];
        $('input[name="itemtecnica[nivel]"]').each(function(){
            tecnicaNivel.push($(this).val());
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

        var cd_empresa=$('#cd_empresa').val();
        var titulo=$('#titulo').val();
        var cargo=$('#cargo').val();
        var observacao=$('#observacao').val();
        var tipocontratacao=$('#tipocontratacao').val();
        var salario=$('#salario').val();
        var jornadatrabalho=$('#jornadatrabalho').val();
        var experiencia=$('#experiencia').val();
        var quantidadevagas=$('#quantidadevagas').val();
        var beneficios=$('#beneficios').val();
        var latitude=$('#latitude').val();
        var longitude=$('#longitude').val();
        var endereco=$('#endereco').val();

        $.ajax({      //Função AJAX
          url:"valida_vaga.php",      //Arquivo php
          type:"post",        //Método de envio
          data: "cd_empresa="+cd_empresa+"&titulo="+titulo+"&cargo="+cargo+"&observacao="+observacao+
                "&tipocontratacao="+tipocontratacao+"&salario="+salario+"&jornadatrabalho="+jornadatrabalho+
                "&experiencia="+experiencia+"&quantidadevagas="+quantidadevagas+"&beneficios="+beneficios+
                "&latitude="+latitude+"&longitude="+longitude+"&endereco="+endereco+
                "&idiomaCodigo="+JSON.stringify(idiomaCodigo)+"&idiomaNivel="+JSON.stringify(idiomaNivel)+
                "&tecnicaCodigo="+JSON.stringify(tecnicaCodigo)+"&tecnicaNivel="+JSON.stringify(tecnicaNivel)+
                "&comportCodigo="+JSON.stringify(comportCodigo)+"&cursoCodigo="+JSON.stringify(cursoCodigo), //Dados
            success: function (result){     //Sucesso no AJAX
                        if (result == 1){
                          location.href='vaga.php';
                        }else{
                          document.getElementById('errMessage').innerHTML = result;
                          $('#errMessage').show();   //Informa o erro                      
                        }
                    }
        })
        return false; //Evita que a página seja atualizada
      })*/
    });
/*
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
    }*/

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

        alert($("#itemlistCurso tr").length);
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
/*
    //função que adiciona o habilidade na tela
    function adicionarTecnica()
    {
      //pega o valor dos componentes html que possuem esses id
      var codigo_tecnica = $("#codigo_tecnica").val();
      var descricao_tecnica = $("#codigo_tecnica option:selected").text();
      var nivel_tecnica = $("#nivel_tecnica").val();
      var descricao_nivel_tecnica = $("#nivel_tecnica option:selected").text();
      var items = "";

      if ((!codigo_tecnica) || (!nivel_tecnica))
          return false;

      //esse codigo html vai ser inserido para o usuário ver na tela (esse itemhabilidade vai ser a lista utilizado para pegar os item depois)
      //()
      items += "<tr>";
      items += "<td><input type='hidden' name='itemtecnica[codigo]' value='"+ codigo_tecnica +"'>"+descricao_tecnica+"</td>";
      items += "<td><input type='hidden' class='span2' name='itemtecnica[nivel]' value='"+ nivel_tecnica +"'>"+ descricao_nivel_tecnica +"</td>";
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
*/
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
/*
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
*/
    //função de remover curso adicionado
    $("#itemlistCurso").on("click","#hapus",function(){
        $(this).parent().parent().remove();
    });
/*
    //função de remover habilidade adicionado
    $("#itemlistTecnica").on("click","#hapus",function(){
        $(this).parent().parent().remove();
    });

    //função de remover habilidade adicionado
    $("#itemlistComport").on("click","#hapus",function(){
        $(this).parent().parent().remove();
    });


*/


  </script>