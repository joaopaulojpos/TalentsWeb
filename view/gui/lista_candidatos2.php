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

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::    Obtendo cursos da vaga                         :*/
/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
foreach ($vaga as $key => $resultado) {
    foreach ($resultado as $key => $resultado2) {
        $cursos_vaga = $resultado2["cursos"];
        $idiomas_vaga = $resultado2["idiomas"];
        $competencias_tecnicas_vaga = $resultado2["competencias_tecnicas"];
        $nr_latitude_vaga = $resultado2["nr_latitude"];
        $nr_longitude_vaga = $resultado2["nr_longitude"];
        $ds_titulo_vaga = $resultado2["ds_titulo"];
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

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::    Função para calcular a distância do profissional com relação a vaga                         :*/
/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
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

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////// Início do algortmo ///////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::    Declaração de variáveis                         :*/
/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
$arrayAptos = [];
$arrayPromissores = [];

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::    Função para verificar se o valor existe dentro de um array, passando em qual campo do array você quer utilizar                         :*/
/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
function in_array_field($needle, $needle_field, $haystack) { 
    foreach ($haystack as $item){ 
        if (isset($item[$needle_field]) && $item[$needle_field] == $needle) 
            return true;
    }
    return false; 
} 


/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::    Função que determina a porcentagem dos cursos do profissional com relação a vaga                         :*/
/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
foreach ($arrayprofissionais as $key => $value) {
    if ($key == 'sucess'){
        $arrayprofissionais2 = $value;
        foreach ($arrayprofissionais2 as $key => $value) {

            //setando todas as porcentagens do profissional para zero
            $porcentagem = 0;
            $value["porcentagem"] = $porcentagem;
            $value["porcentagem_cursos"] = $porcentagem;
            $value["porcentagem_comp_tecnicas"] = $porcentagem;
            $value["porcentagem_idiomas"] = $porcentagem;



            //parte dos cursos
            if ($value["cursos"]){
                $qtdCursosValidos = 0;
                foreach ($value["cursos"] as $key => $cursos) {   
                    if (in_array_field($cursos['cd_curso'], 'cd_curso', $cursos_vaga)){
                        $qtdCursosValidos = $qtdCursosValidos + 1;
                    }
                } 
                $value["porcentagem_cursos"] =  (($qtdCursosValidos*100) / count($cursos_vaga));
            }

            //parte das competências técnicas
            if ($value["competencias_tecnicas"]){
                $qtdCompetenciasTecnicasValidos = 0;

                foreach ($value["competencias_tecnicas"] as $key => $competencias_tecnicas) {   
                    if (in_array_field($competencias_tecnicas['cd_competencia_tecnica'], 'cd_competencia_tecnica', $competencias_tecnicas_vaga)){
                        $qtdCompetenciasTecnicasValidos = $qtdCompetenciasTecnicasValidos + 1;
                    }
                }
                $value["porcentagem_comp_tecnicas"] =  (($qtdCompetenciasTecnicasValidos*100) / count($competencias_tecnicas_vaga));
            }

            //parte dos idiomas
            if ($value["idiomas"]){
                $i = 0;
                $qtdIdiomasValidos = 0;

                foreach ($value["idiomas"] as $key => $idiomas) {
                    if (in_array_field($idiomas['cd_idioma'], 'cd_idioma', $idiomas_vaga)){
                        $qtdIdiomasValidos = $qtdIdiomasValidos + 1;
                    }
                }
                $value["porcentagem_idiomas"] =  (($qtdIdiomasValidos*100) / count($idiomas_vaga));  
            }

            $value["porcentagem"] = ($value["porcentagem_cursos"] + $value["porcentagem_comp_tecnicas"] + $value["porcentagem_idiomas"]) / 3;

            if ($value["porcentagem"] > 70){
                array_push($arrayAptos, $value);
            }else{
                array_push($arrayPromissores, $value);
            }
        }
    }
}

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::    Função responsável por ordernar os profissionais de acordo com a porcentagem (maior primeiro)                         :*/
/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
function cmp($a, $b) {
    return $a['porcentagem'] < $b['porcentagem'];
}
usort($arrayAptos, 'cmp');
usort($arrayPromissores, 'cmp');

?>
<div class="row">
    <div class="col s12 m12">    
        <?//php echo $empresa[0]['ds_razao_social'] ?>
        <div class="section right-align">
            <a href="lista_vagas.php" class="waves-effect waves-light btn"><i class="material-icons left">chevron_left</i>Voltar</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="card-panel teal darken-1">
        <h5><span><a class="white-text" href="lista_vagas.php"><?php echo $cd_vaga; ?> - <?php echo $ds_titulo_vaga; ?></a></span></h5>
    </div>
</div>

<section class="section">
    <div class="container">
        <?php
        if (count($arrayAptos) == 0 && count($arrayPromissores) == 0){
        ?>
            <h5 class="text center">Por enquanto nenhum profissional curtiu esta vaga!</h5>      
        <?php
        }else{
        ?>

            <ul class="collapsible z-depth-0" data-collapsible = "accordion">
                <li>
                   <div class="collapsible-header active teal darken-1 white-text"><i class="material-icons">assignment_turned_in</i>Aptos</div>
                    <div class="collapsible-body z-depth-0">
                        <table>
                            <?php 
                                foreach ($arrayAptos as $key => $value) {

                                    $cd_profissional = $value['cd_profissional'];
                                    $ds_nome = $value['ds_nome'];
                                    $ds_email = $value['ds_email'];
                                    $dt_nascimento = $value['dt_nascimento'];
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

                                    $b_like = $value["match_empresa"];
                                    $b_envia_ajax = $b_like;

                                    $ds_resultado_comp = $value['ds_resultado_comp'];

                                    $porcentagem = number_format($value['porcentagem'], 2, ',', ' ');
                                    $porcentagem_cursos = number_format($value['porcentagem_cursos'], 2, ',', ' ');
                                    $porcentagem_comp_tecnicas = number_format($value['porcentagem_comp_tecnicas'], 2, ',', ' ');
                                    $porcentagem_idiomas = number_format($value['porcentagem_idiomas'], 2, ',', ' ');

                                    if (is_array($value["cargos"])){
                                        $qtdExp = count($value["cargos"]);
                                    }else{
                                        $qtdExp = 0;
                                    }
                                    if (is_array($value["cursos"])){
                                        $qtdCursos = count($value["cursos"]);
                                    }else{
                                        $qtdCursos = 0;
                                    }
                                    if (is_array($value["competencias_tecnicas"])){
                                        $qtdCompTec = count($value["competencias_tecnicas"]);
                                    }else{
                                        $qtdCompTec = 0;
                                    }
                                    if (is_array($value["idiomas"])){
                                        $qtdIdiomas = count($value["idiomas"]);
                                    }else{
                                        $qtdIdiomas = 0;
                                    }

                                    $cor_fundo =  "teal";

                                    $distancia = number_format(distance($nr_latitude_vaga, $nr_longitude_vaga, $nr_latitude_profissional, $nr_longitude_profissional, "K"), 2, '.', '');
                            ?>
                                    
                                    <div class="col s12 m12">
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
                                                        <h6><i class="material-icons">near_me</i> <?php echo $distancia . " km"; ?></h6>
                                                        <h6><i class="material-icons">star</i> <?php echo $ds_resultado_comp; ?></h6>
                                                </div>
                                                <div class="card-action">
                                                    <a class="btn-large waves-effect waves-light teal darken-4 btn modal-trigger" href="#modal<?php echo $cd_profissional?>" title="Visualizar Perfil"><i class="material-icons right">account_circle</i>Ver Perfil</a>
                                                    <button class="btn-floating btn-large waves-effect waves-light red" <?php echo $b_like== 1?'disabled':'';?> id="btnLike<?php echo $cd_profissional; ?>" type="submit" title="Curtir" name="action" onclick="enviarLike(<?php echo $cd_vaga; ?>, <?php echo $cd_profissional; ?>, <?php echo $b_envia_ajax ?>)"><i class="material-icons right" id="iconeLike<?php echo $cd_profissional; ?>"><?php echo $b_like==1?'done':'favorite';?></i></button>
                                                    <a class="waves-effect waves-light btn btn-large transparent z-depth-0 right"><h4 class="green-text"><?php echo $porcentagem; ?>%</h4></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- INCLUSÃO DO CONTEUDO DO MODAL -->
                                    <?php include "content_modal.php"; ?>    
                       

                            <?php

                                }
                            ?>
                        </table> 
                    </div>
                </li>
            </ul>

            <ul class="collapsible z-depth-0" data-collapsible = "accordion">
                <li>
                    <div class="collapsible-header active blue-grey darken-2 white-text"><i class="material-icons">assignment_late</i>Promissores</div>
                    <div class="collapsible-body z-depth-0">
                        <table>
                            <?php 
                                foreach ($arrayPromissores as $key => $value) {

                                    $cd_profissional = $value['cd_profissional'];
                                    $ds_nome = $value['ds_nome'];
                                    $ds_email = $value['ds_email'];
                                    $dt_nascimento = $value['dt_nascimento'];
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

                                    $b_like = $value["match_empresa"];
                                    $b_envia_ajax = $b_like;

                                    $ds_resultado_comp = $value['ds_resultado_comp'];

                                    $porcentagem = number_format($value['porcentagem'], 2, ',', ' ');
                                    $porcentagem_cursos = number_format($value['porcentagem_cursos'], 2, ',', ' ');
                                    $porcentagem_comp_tecnicas = number_format($value['porcentagem_comp_tecnicas'], 2, ',', ' ');
                                    $porcentagem_idiomas = number_format($value['porcentagem_idiomas'], 2, ',', ' ');

                                    if (is_array($value["cargos"])){
                                        $qtdExp = count($value["cargos"]);
                                    }else{
                                        $qtdExp = 0;
                                    }
                                    if (is_array($value["cursos"])){
                                        $qtdCursos = count($value["cursos"]);
                                    }else{
                                        $qtdCursos = 0;
                                    }
                                    if (is_array($value["competencias_tecnicas"])){
                                        $qtdCompTec = count($value["competencias_tecnicas"]);
                                    }else{
                                        $qtdCompTec = 0;
                                    }
                                    if (is_array($value["idiomas"])){
                                        $qtdIdiomas = count($value["idiomas"]);
                                    }else{
                                        $qtdIdiomas = 0;
                                    }

                                    $cor_fundo =  "blue-grey";

                                    $distancia = number_format(distance($nr_latitude_vaga, $nr_longitude_vaga, $nr_latitude_profissional, $nr_longitude_profissional, "K"), 2, '.', '');
                            ?>
                                    
                                    <div class="col s12 m12">
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
                                                        <h6><i class="material-icons">near_me</i> <?php echo $distancia . " km"; ?></h6>
                                                        <h6><i class="material-icons">star</i> <?php echo $ds_resultado_comp; ?></h6>
                                                </div>
                                                <div class="card-action">
                                                    <a class="btn-large waves-effect waves-light teal darken-4 btn modal-trigger" href="#modal<?php echo $cd_profissional?>" title="Visualizar Perfil"><i class="material-icons right">account_circle</i>Ver Perfil</a>
                                                    <button class="btn-floating btn-large waves-effect waves-light red" <?php echo $b_like== 1?'disabled':'';?> id="btnLike<?php echo $cd_profissional; ?>" type="submit" title="Curtir" name="action" onclick="enviarLike(<?php echo $cd_vaga; ?>, <?php echo $cd_profissional; ?>, <?php echo $b_envia_ajax ?>)"><i class="material-icons right" id="iconeLike<?php echo $cd_profissional; ?>"><?php echo $b_like==1?'done':'favorite';?></i></button>
                                                    <a class="waves-effect waves-light btn btn-large transparent z-depth-0 right">
                                                        <h4 class="green-text">
                                                        T:<?php echo $porcentagem; ?>%
                                                        C:<?php echo $porcentagem_cursos; ?>%
                                                        Ct:<?php echo $porcentagem_comp_tecnicas; ?>%
                                                        I:<?php echo $porcentagem_idiomas; ?>%
                                                        </h4>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- INCLUSÃO DO CONTEUDO DO MODAL -->
                                    <?php include "content_modal.php"; ?>    
                       

                            <?php

                                }
                            ?>
                        </table>
                    </div>
                </li>
            </ul>
        <?php
            }
        ?>
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

    function imprimir(cd_profissional) {
        //pega o Html da DIV
        var divElements = document.getElementById('modal'+cd_profissional).innerHTML;
        //pega o HTML de toda tag Body
        var oldPage = document.body.innerHTML;

        //Alterna o body 
        document.body.innerHTML = 
         "<html> "+
          " <head> "+
          "   <title> "+
          "   </title> "+
          " </head> "+
          " <body>" + 
          divElements + 
          " </body>";
          " </html>";

        //Imprime o body atual
        window.print();

        //Atualiza a página
        window.location.reload(true);
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