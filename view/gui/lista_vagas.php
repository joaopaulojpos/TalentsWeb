<?php
include "menu.php";
include "foooter.php";

  if (!isset($_SESSION['empresaLogada'])) {   //Verifica se há seções
    session_destroy();            //Destroi a seção por segurança
    header("Location: login.php"); 
    exit; //Redireciona o visitante para login
  }

  $empresa = $_SESSION['empresaLogada']; 

  require_once('../../controller/fachada.php');

  $fachada = Fachada::getInstance();
  $arrayvagas = $fachada->vagasEmpresaPesquisar($empresa[0]['cd_empresa']);

  //var_dump($arrayvagas);
  //var_dump($empresa[0]['cd_empresa']);

?>

<section="section"> 


  <div class="row">
  <div class="container">
    
    <?//php echo $empresa[0]['ds_razao_social'] ?>
 
  </div>
  </div>

  <div class="row">

  <?php foreach ($arrayvagas as $key => $value) {
          if ($key == 'sucess'){
            $arrayvagas2 = $value;
            foreach ($arrayvagas2 as $key => $value) { 

              $cd_vaga = $value["cd_vaga"];
              $ds_titulo = $value["ds_titulo"];
              $dt_cricacao = 'Criado em: '.(new DateTime($value["dt_criacao"]))->format('d/m/Y');
              if ($value["cargo"]){
                $ds_cargo = 'Cargo: '.$value["cargo"]['ds_cargo'];
              }
              $vl_salario = 'R$'.number_format($value["vl_salario"], 2, ',', '.');
              $nr_qtd_vaga = $value["nr_qtd_vaga"];
              $ds_beneficios = $value["ds_beneficios"];
              $ds_observacao = $value["ds_observacao"];
              $nr_latitude = $value["nr_latitude"];
              $nr_longitude = $value["nr_longitude"];
              $ds_localizacao = $value["ds_endereco"];

              if ($value["tp_contratacao"] == '1'){
                $tp_contratacao = 'Tempo indeterminado';
              }else if ($value["tp_contratacao"] == '2'){
                $tp_contratacao = 'Tempo determinado';
              }else if ($value["tp_contratacao"] == '3'){
                $tp_contratacao = 'Temporário';
              }else{
                $tp_contratacao = 'Aprendizagem';
              }

              if ($value["ds_horario_expediente"] == '1'){
                $ds_horario_expediente = 'Regime de tempo integral';
              }else{
                $ds_horario_expediente = 'Regime de tempo parcial';
              }

              if ($value["nr_experiencia"] == '0'){
                $nr_experiencia = 'Sem experiência';
              }else if ($value["nr_experiencia"] == '1'){
                $nr_experiencia = 'menos de 1 ano';
              }else if ($value["nr_experiencia"] == '2'){
                $nr_experiencia = 'entre 1 a 2 anos';
              }else if ($value["nr_experiencia"] == '3'){
                $nr_experiencia = 'entre 2 a 3 anos';
              }else if ($value["nr_experiencia"] == '4'){
                $nr_experiencia = 'entre 3 a 4 anos';
              }else{
                $nr_experiencia = 'Acima de 5 anos';
              }

              if ($value["tp_status"] == 'A'){
                $tp_status = 'Disponível';
                $tp_envia_status_ajax = 0;
              }else{
                $tp_status = 'Indisponível';
                $tp_envia_status_ajax = 1;
              }
             
  ?>

    <div class="col s12 m6">
      <div class="card">
        <div class="card-content">
          <span class="card-title activator grey-text text-darken-4"><a href="lista_candidatos.php?cd_vaga=<?php echo $cd_vaga; ?>"><?php echo $ds_titulo; ?></a><i class="material-icons right">more_vert</i></span>
          <p><a href="#"><?php echo $ds_cargo; ?></a></p>
          <p class="text-darken-4"><?php echo $dt_cricacao; ?></p>
          </br>
          <div class="divider"></div>
          </br>
          <p><b>Status:</b><span class=<?php echo $tp_status=="Disponível"?"disponivel":"indisponivel";?>> <?php echo $tp_status; ?></span></p>
                      <p><b>Tipo de contratação:</b><span> <?php echo $tp_contratacao; ?></span></p>
                      <p><b>Salário:</b><span> <?php echo $vl_salario; ?></span></p>
                      <p><b>Jornada de trabalho:</b><span> <?php echo $ds_horario_expediente; ?></span></p>
                      <p><b>Experiência:</b><span> <?php echo $nr_experiencia; ?></span></p>
                      <p><b>Quantidade de vagas:</b><span> <?php echo $nr_qtd_vaga; ?></span></p>
                      <p><b>Benefícios:</b><span> <?php echo $ds_beneficios; ?></span></p>
                      <p><b>Observação:</b><span> <?php echo $ds_observacao; ?></span></p>
                      <p><b>Endereço:</b><span> <?php echo $ds_localizacao; ?></span></p>
          </p>

        </div>

          <div class="card-action">
                <a class="waves-effect waves-light btn red darken-4">Fechar Vaga</a>
                <a href="lista_candidatos.php?cd_vaga=<?php echo $cd_vaga; ?>" class="waves-effect waves-light btn teal darken-4">Ver Candidatos</a>
          </div>

        <div class="card-reveal">
          <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>Detalhes</span>
          </br>
          <table class="">
                      <thead>
                        <tr>
                          <th data-field="port">Curso</th>
                          <th data-field="protocol">Formação</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($value["cursos"]){ 
                                foreach ($value["cursos"] as $key => $cursos) {    
                        ?>
                          <tr>
                            <td class='primeiro'> <?php echo $cursos['ds_curso']; ?></td>
                            <td class='segundo'> <?php echo $cursos['ds_formacao']; ?></td>
                          </tr>
                        <?php 
                                }
                              } 

                        ?> 
                      </tbody>
                    </table>

                    <table class="">
                      <thead>
                        <tr>
                          <th data-field="port">Competência Técnica</th>
                          <th data-field="protocol">Nível</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($value["competencias_tecnicas"]){ 
                                foreach ($value["competencias_tecnicas"] as $key => $comp_tec) {    
                        ?>
                          <tr>
                            <td class='primeiro'> <?php echo $comp_tec['ds_competencia_tecnica']; ?></td>
                            <td class='segundo'> <?php echo $comp_tec['nr_nivel']; ?></td>
                          </tr>
                        <?php 
                                }
                              } 

                        ?>
                      </tbody>
                    </table>

                    <table class="">
                        <thead>
                          <tr>
                            <th data-field="port">Competência Comportamental</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if ($value["competencias_comp"]){ 
                                  foreach ($value["competencias_comp"] as $key => $comp_comport) {    
                          ?>
                            <tr>
                              <td> <?php echo $comp_comport['ds_competencia_comport']; ?></td>
                            </tr>
                          <?php 
                                  }
                                } 

                          ?>
                        </tbody>
                      </table>

                    <table class="">
                        <thead>
                          <tr>
                            <th data-field="port">Idioma</th>
                            <th data-field="protocol">Nível</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if ($value["idiomas"]){ 
                                  foreach ($value["idiomas"] as $key => $comp_tec) {    
                          ?>
                            <tr>
                              <td class='primeiro'> <?php echo $comp_tec['ds_idioma']; ?></td>
                              <td class='segundo'> <?php echo $comp_tec['nr_nivel']; ?></td>
                            </tr>
                          <?php 
                                  }
                                } 

                          ?>
                        </tbody>
                      </table>
        </div>
      </div>
    </div>
    <div class="load" id="load">
      <hr/><hr/><hr/><hr/>
    </div>
      
  <?php
          }
        }
      }
  ?>
  </div>
</section>
<script type='text/javascript'>
    $(document).ready(function(){

        //Esconde preloader
        $(window).load(function(){
            $('#load').fadeOut(1500);//1500 é a duração do efeito (1.5 seg)
        });

    });


    function alterarStatusVaga(cd_vaga, tp_envia_status_ajax) {
      $.ajax({      //Função AJAX
      url:"../validacoes/valida_alteracao_status_vaga.php",      //Arquivo php
      type:"post",        //Método de envio
      data: "cd_vaga="+cd_vaga+"&tp_envia_status_ajax="+tp_envia_status_ajax, //Dados
          success: function (result){
              if(result == 1){
                  return true;
              }else{
                  alert("Erro ao inativar/ativar vaga: " + result);
              }
          }
      });
    }

</script>