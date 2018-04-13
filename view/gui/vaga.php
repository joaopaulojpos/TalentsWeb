<?php


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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Vagas - Talents</title>

  <!-- CSS  -->
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css'>
  
  <link href="css/menu.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">

  <link rel="stylesheet" href="css/card.css">
</head>
<body>
  <?php include "menu.php" ?>
  
  <div class="container">
    
    <?php echo $empresa[0]['ds_razao_social'] ?>
 
  </div>

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
              }else{
                $tp_status = 'Indisponível';
              }
             
  ?>

              <div class="row">
                <div class="col-xs-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                  <div class="card">
                    <div class="card-move-up waves-effect waves-block waves-light">
                      <div class="move-up cyan darken-1">
                        <div>
                          <a class="chart-title white-text" href="lista_candidatos.php?cd_vaga=<?php echo $cd_vaga; ?>&nr_latitude=<?php echo $nr_latitude; ?>&nr_longitude=<?php echo $nr_longitude; ?>"><?php echo $ds_titulo; ?></a>
                          <div class="chart-revenue cyan darken-2 white-text">
                            <p class="chart-revenue-total"><?php echo $dt_cricacao; ?></p>
                          </div>

                        </div>
                        <div class="trending-line-chart-wrapper">
                          <p>
                            <?php echo $ds_cargo; ?>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="card-content">
                      <a class="btn-floating btn-move-up waves-effect waves-light darken-2 right"><i class="material-icons activator">+</i></i></a>
                      <div class="col-sx-12 col-md-20 col-lg-20 col-sm-offset-0">
                        <div id="doughnut-chart-wrapper" >
                          <p><b>Status:</b><span class=<?php echo $tp_status=="Disponível"?"disponivel":"indisponivel";?>> <?php echo $tp_status; ?></span></p>
                          <p><b>Tipo de contratação:</b><span> <?php echo $tp_contratacao; ?></span></p>
                          <p><b>Salário:</b><span> <?php echo $vl_salario; ?></span></p>
                          <p><b>Jornada de trabalho:</b><span> <?php echo $ds_horario_expediente; ?></span></p>
                          <p><b>Experiência:</b><span> <?php echo $nr_experiencia; ?></span></p>
                          <p><b>Quantidade de vagas:</b><span> <?php echo $nr_qtd_vaga; ?></span></p>
                          <p><b>Benefícios:</b><span> <?php echo $ds_beneficios; ?></span></p>
                          <p><b>Observação:</b><span> <?php echo $ds_observacao; ?></span></p>
                          <p><b>Endereço:</b><span> <?php echo $ds_localizacao; ?></span></p>
                        </div>
                      </div>
                    </div>

                      <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Requisitos <i class="material-icons right orange-text text-darken-2">Fechar</i></span>
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
              </div>

  <?php
          }
        }
      }
  ?>

  
  <?php include "footer.php" ?>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>


  </body>
</html>
