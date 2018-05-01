<?php
include "menu.php";
include "foooter.php";


if (!isset($_SESSION['empresaLogada'])) {   //Verifica se há seções
session_destroy();            //Destroi a seção por segurança
header("Location: login.php"); 
exit; //Redireciona o visitante para login
}

if(empty($_GET['cd_vaga'])){
header("Location: vaga.php"); 
exit; //Redireciona o visitante para login
}

$cd_vaga = $_GET['cd_vaga']; 

require_once('../../controller/fachada.php');

$fachada = Fachada::getInstance();
$arrayprofissionais = $fachada->listarProfissionaisVaga($cd_vaga);
$vaga = $fachada->vagaPesquisar($cd_vaga);

//Obtendo cursos da vaga
foreach ($vaga as $key => $resultado) {
    foreach ($resultado as $key => $resultado2) {
        $cursos_vaga = $resultado2["cursos"];
        $nr_latitude_vaga = $resultado2["nr_latitude"];
        $nr_longitude_vaga = $resultado2["nr_longitude"];
    }
    
}

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::    This function converts decimal degrees to radians                         :*/
/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
function deg2rad2($deg) {
    return ($deg * pi() / 180.0);
}

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::    This function converts radians to decimal degrees                         :*/
/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
function rad2deg2($rad) {
    return ($rad * 180 / pi());
}

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad2($lat1)) * sin(deg2rad2($lat2)) + cos(deg2rad2($lat1)) * cos(deg2rad2($lat2)) * cos(deg2rad2($theta));
    $dist = acos($dist);
    $dist = rad2deg2($dist);
    $dist = $dist * 60 * 1.1515;
    if ($unit == "K") {
        $dist = $dist * 1.609344;
    } else if ($unit == "N") {
        $dist = $dist * 0.8684;
    }

    return ($dist);
}

function in_array_field($needle, $needle_field, $haystack, $strict = false) { 
    if ($strict) { 
        foreach ($haystack as $item) 
            if (isset($item->$needle_field) && $item->$needle_field === $needle) 
                return true; 
    } 
    else { 
        foreach ($haystack as $item) 

            if (isset($item[$needle_field]) && $item[$needle_field] == $needle) 
                return true;
    } 
    return false; 
} 


$arrayAptos = [];
$arrayPromissores = [];

foreach ($arrayprofissionais as $key => $value) {
    if ($key == 'sucess'){
        $arrayprofissionais2 = $value;
        foreach ($arrayprofissionais2 as $key => $value) {
            $porcentagem = 0;
            $value["porcentagem"] = $porcentagem;
            if ($value["cursos"]){
                $i = 0;
                $qtdCursosValidos = 0;
                foreach ($value["cursos"] as $key => $cursos) {   
                    if (in_array_field($cursos['cd_curso'], 'cd_curso', $cursos_vaga)){
                        $qtdCursosValidos = $qtdCursosValidos + 1;
                    }
                                                
                    $i = $i + 1;
                    $porcentagem = (($qtdCursosValidos*100) / count($cursos_vaga));
                } 
                $value["porcentagem"] = $porcentagem;
            }
            if ($value["porcentagem"] > 70){
                array_push($arrayAptos, $value);
            }else{
                array_push($arrayPromissores, $value);
            }
        }
        
        /*var_dump($arrayListaDeProfissionais);
        die;*/
    }
}

function cmp($a, $b) {
    return $a['porcentagem'] < $b['porcentagem'];
}

usort($arrayAptos, 'cmp');
usort($arrayPromissores, 'cmp');

//var_dump($arrayvagas);
//var_dump($empresa[0]['cd_empresa']);
?>


<section class="section">
    <div class="row">
        <ul class="collapsible z-depth-0" data-collapsible = "accordion">
            <li>
                <div class="collapsible-header active teal darken-1 white-text"><i class="material-icons">assignment_turned_in</i>Aptos</div>
                <div class="collapsible-body z-depth-0">
                    <table>
                        <tbody>
                            <tr>
                                

                                <?php 
                                    foreach ($arrayAptos as $key => $value) {

                                        $cd_profissional = $value['cd_profissional'];
                                        $ds_nome = $value['ds_nome'];
                                        $ds_email = $value['ds_email'];
                                        $b_foto = "https://i.pinimg.com/originals/d2/9e/ba/d29ebab9f2f5663d9993cfe72b6ebba8.jpg";
                                        if ($value["tp_sexo"] == 'M'){
                                            $sexo = "Masculino";
                                        }else if ($value["tp_sexo"] == 'F'){
                                            $sexo = "Feminino";
                                        }else{
                                            $sexo = "Indefinido";
                                        }
                                        $nr_latitude_profissional = $value["nr_latitude"];
                                        $nr_longitude_profissional = $value["nr_longitude"];

                                        $ds_formacao = "Análise e desenvolvimento de sistemas";

                                        $b_like = $value["match_empresa"];
                                        $b_envia_ajax = $b_like;

                                        $ds_resultado_comp = $value['ds_resultado_comp'];

                                        $porcentagem = number_format($value['porcentagem'], 2, ',', ' ');


                                ?>
                                    <td class="col s12 m5">
                                        <div>
                                            <div class="card horizontal">



                                                <div class="card-image">
                                                    <img src="<?php echo $b_foto; ?>" align="left" width="150" height="150">
                                                </div>

                                                <div class="card-stacked">
                                                    <div class="card-content">
                                                    <h5><?php echo $ds_nome; ?></h5>
                                                    <?php 

                                                        if ($value["cursos"]){
                                                            $i = 0;
                                                            $qtdCursosValidos = 0;
                                                            foreach ($value["cursos"] as $key => $cursos) {   
                                                                if (in_array_field($cursos['cd_curso'], 'cd_curso', $cursos_vaga)){
                                                                    $qtdCursosValidos = $qtdCursosValidos + 1;
                                                                }
                                                                
                                                    ?>          
                                                                <h6><?php echo $i==0?'<i class="material-icons">school</i> ':'';?><?php echo $cursos['ds_curso']; ?></h6>
                                                    <?php 
                                                                $i = $i + 1;
                                                            }
                                                        } 

                                                    ?> 
                                                    
                                                    <h6><i class="material-icons">near_me</i> <?php echo number_format(distance($nr_latitude_vaga, $nr_longitude_vaga, $nr_latitude_profissional, $nr_longitude_profissional, "K"), 2, '.', '') . " km"; ?></h6>
                                                
                                                    <h6><i class="material-icons">star</i> <?php echo $ds_resultado_comp; ?></h6>
                                               
                                                    </div>
                                                </div>
                                                <div class="card-stacked">
                                                    <div class="card-content col s12 m9 offset-s6">


                                                    
                                                        <button class="btn-floating btn-large waves-effect waves-light red" <?php echo $b_like== 1?'disabled':'';?> id="btnLike<?php echo $cd_profissional; ?>" type="submit" title="Curtir" name="action" onclick="enviarLike(<?php echo $cd_vaga; ?>, <?php echo $cd_profissional; ?>, <?php echo $b_envia_ajax ?>)"><i class="material-icons right" id="iconeLike<?php echo $cd_profissional; ?>"><?php echo $b_like==1?'done':'favorite';?></i></button>













                                                        <a class="btn-floating btn-large waves-effect waves-light red btn modal-trigger" href="#modal<?php echo $cd_profissional?>" title="Visualizar Perfil"><i class="material-icons right">account_circle</i></a>

                                                        <!-- Perfil do profissional (modal) -->
                                                        <div id="modal<?php echo $cd_profissional?>" class="modal modal-fixed-footer">
                                                            <div class="modal-content">
                                                                <div class="row">
                                                                     <div class="card-panel teal lighten-1 white-text text center"><h5>Perfil do(a) <?php echo $ds_nome ?></h5></div>
                                                                    <ul class="collapsible">
                                                                        <li>
                                                                            <div class="collapsible-header"><i class="material-icons">business_center</i>Experiência(s) Profissional(is)</div>
                                                                            <div class="collapsible-body">
                                                                                <table>
                                                                                    <thead>
                                                                                      <tr>
                                                                                          <th>Empresa</th>
                                                                                          <th>Data Início</th>
                                                                                          <th>Data Fim</th>
                                                                                      </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                      <tr>
                                                                                        <td>ANS</td>
                                                                                        <td>01/01/2016</td>
                                                                                        <td>-</td>
                                                                                      </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </li>
                                                                    </ul>

                                                                    <ul class="collapsible">
                                                                        <li>
                                                                            <div class="collapsible-header"><i class="material-icons">school</i>Educação</div>
                                                                            <div class="collapsible-body">
                                                                                <table>
                                                                                    <thead>
                                                                                      <tr>
                                                                                          <th>Curso</th>
                                                                                          <th>Instituição</th>
                                                                                          <th>Data Início</th>
                                                                                          <th>Data Fim</th>
                                                                                          <th>Período</th>
                                                                                      </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                      <tr>
                                                                                        <td>ADS</td>
                                                                                        <td>Unibratec</td>
                                                                                        <td>01/01/2016</td>
                                                                                        <td>-</td>
                                                                                        <td>6 Período</td>
                                                                                      </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </li>
                                                                    </ul>

                                                                    <ul class="collapsible">
                                                                        <li>
                                                                            <div class="collapsible-header"><i class="material-icons">poll</i>Competência(s) Técnica(s)</div>
                                                                            <div class="collapsible-body">
                                                                                <table>
                                                                                    <thead>
                                                                                      <tr>
                                                                                          <th>Competência</th>
                                                                                          <th>Nível</th>
                                                                                      </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                      <tr>
                                                                                        <td>Java</td>
                                                                                        <td>5</td>
                                                                                      </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </li>
                                                                    </ul>

                                                                    <ul class="collapsible">
                                                                        <li>
                                                                            <div class="collapsible-header"><i class="material-icons">public</i>Idioma(s)</div>
                                                                            <div class="collapsible-body">
                                                                                <table>
                                                                                    <thead>
                                                                                      <tr>
                                                                                          <th>Idioma</th>
                                                                                          <th>Nível</th>
                                                                                      </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                      <tr>
                                                                                        <td>Português</td>
                                                                                        <td>Avançado</td>
                                                                                      </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </li>
                                                                    </ul>

                                                                    
                                                                    

                                                                </div>         
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                                                            </div>
                                                        </div>
























                                                        
                                                        <h3 class="teal-text" title="Porcentagem de adequação a vaga"><?php echo $porcentagem; ?>%</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                    </td>

                                <?php

                                    }
                                ?>
                                <td>
                            </tr>
                        </tbody> 
                    </table>
                </div>
            </li>
         </ul>



        <ul class="collapsible z-depth-0" data-collapsible = "accordion">
            <li>
                <div class="collapsible-header active blue-grey darken-2 white-text"><i class="material-icons">assignment_late</i>Promissores</div>
                <div class="collapsible-body z-depth-0">
                    <table>
                        <tbody>
                            <tr>
                                

                                <?php 
                                    foreach ($arrayPromissores as $key => $value) {

                                        $cd_profissional = $value['cd_profissional'];
                                        $ds_nome = $value['ds_nome'];
                                        $ds_email = $value['ds_email'];
                                        $b_foto = "https://i.pinimg.com/originals/d2/9e/ba/d29ebab9f2f5663d9993cfe72b6ebba8.jpg";
                                        if ($value["tp_sexo"] == 'M'){
                                            $sexo = "Masculino";
                                        }else if ($value["tp_sexo"] == 'F'){
                                            $sexo = "Feminino";
                                        }else{
                                            $sexo = "Indefinido";
                                        }
                                        $nr_latitude_profissional = $value["nr_latitude"];
                                        $nr_longitude_profissional = $value["nr_longitude"];

                                        $ds_formacao = "Análise e desenvolvimento de sistemas";

                                        $b_like = $value["match_empresa"];
                                        $b_envia_ajax = $b_like;

                                        $ds_resultado_comp = $value['ds_resultado_comp'];

                                        $porcentagem = number_format($value['porcentagem'], 2, ',', ' ');


                                ?>
                                    <td class="col s12 m5">
                                        <div >
                                            <div class="card horizontal">
                                                <div class="card-image">
                                                    <img src="<?php echo $b_foto; ?>" align="left" width="150" height="150">
                                                </div>

                                                <div class="card-stacked">
                                                    <div class="card-content">
                                                    <h5><?php echo $ds_nome; ?></h5>
                                                    <?php 

                                                        if ($value["cursos"]){
                                                            $i = 0;
                                                            $qtdCursosValidos = 0;
                                                            foreach ($value["cursos"] as $key => $cursos) {   
                                                                if (in_array_field($cursos['cd_curso'], 'cd_curso', $cursos_vaga)){
                                                                    $qtdCursosValidos = $qtdCursosValidos + 1;
                                                                }
                                                                
                                                    ?>          
                                                                <h6><?php echo $i==0?'<i class="material-icons">school</i> ':'';?><?php echo $cursos['ds_curso']; ?></h6>
                                                    <?php 
                                                                $i = $i + 1;
                                                            }
                                                        } 

                                                    ?> 
                                                    
                                                    <h6><i class="material-icons">near_me</i> <?php echo number_format(distance($nr_latitude_vaga, $nr_longitude_vaga, $nr_latitude_profissional, $nr_longitude_profissional, "K"), 2, '.', '') . " km"; ?></h6>
                                                
                                                    <h6><i class="material-icons">star</i> <?php echo $ds_resultado_comp; ?></h6>
                                               
                                                    </div>
                                                </div>
                                                <div class="card-stacked">
                                                    <div class="card-content col s12 m9 offset-s6">


                                                    
                                                        <button class="btn-floating btn-large waves-effect waves-light red" <?php echo $b_like== 1?'disabled':'';?> id="btnLike<?php echo $cd_profissional; ?>" type="submit" name="action" onclick="enviarLike(<?php echo $cd_vaga; ?>, <?php echo $cd_profissional; ?>, <?php echo $b_envia_ajax ?>)"><i class="material-icons right" id="iconeLike<?php echo $cd_profissional; ?>"><?php echo $b_like==1?'done':'favorite';?></i></button>


                                                        <a class="btn-floating btn-large waves-effect waves-light red btn modal-trigger" href="#modal<?php echo $cd_profissional?>" title="Visualizar Perfil"><i class="material-icons right">account_circle</i></a>

                                                        <!-- Perfil do profissional (modal) -->
                                                        <div id="modal<?php echo $cd_profissional?>" class="modal">
                                                          <div class="modal-content">
                                                            <h4><?php echo $ds_nome?></h4>
                                                            <p>A bunch of text</p>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
                                                          </div>
                                                        </div>
                                                        
                                                        <h3 class="teal-text"><?php echo $porcentagem; ?>%</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                    </td>

                                <?php

                                    }
                                ?>
                                <td>
                            </tr>
                        </tbody> 
                    </table>
                </div>
            </li>
        </ul>
    </div>
</section>

<script type='text/javascript'>

    function enviarLike(cd_vaga, cd_profissional, b_like) {

        if (b_like == 1){
            alert('Só é possível dar like no candidato 1 vez, esse já foi escolhido!');
        }
        
        var nomeBotao = 'btnLike'+cd_profissional;
        var nomeIcone = 'iconeLike'+cd_profissional;
        $.ajax({      //Função AJAX
        url:"../validacoes/valida_like_empresa.php",      //Arquivo php
        type:"post",        //Método de envio
        data: "cd_vaga="+cd_vaga+"&cd_profissional="+cd_profissional, //Dados
            success: function (result){
                if(result == 1){
                    document.getElementById(nomeBotao).disabled = true; 
                    document.getElementById(nomeIcone).innerHTML = "done";
                }else{
                    alert("Erro ao curtir candidato: " + result);
                }
            }
        });
    }
    $(document).ready(function() {

         // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal').modal();
    });
    /*$(document).ready(function(){
        $('#errMessage').hide();
        $('#formulario_like').submit(function(){  //Ao submeter formulário

            var cd_vaga=$('#cd_vaga').val();
            var cd_profissional=$('#cd_profissional').val();

            alert('cd_vaga:' + cd_vaga + ' - cd_profissional' + cd_profissional);
            return false;
        })
    });*/

</script>