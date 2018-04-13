<?php
include "menu2.php";
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
$nr_latitude_vaga = $_GET['nr_latitude'];
$nr_longitude_vaga = $_GET['nr_longitude'];

require_once('../../controller/fachada.php');

$fachada = Fachada::getInstance();
$arrayprofissionais = $fachada->listarProfissionaisVaga($cd_vaga);

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



//var_dump($arrayvagas);
//var_dump($empresa[0]['cd_empresa']);
?>


<section class="section">
    <div class="row">

        <?php 

            foreach ($arrayprofissionais as $key => $value) {
                if ($key == 'sucess'){
                    $arrayprofissionais2 = $value;
                    foreach ($arrayprofissionais2 as $key => $value) { 

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
        ?>

                        <div class="col s12 m5">
                            <div class="card horizontal">
                                <div class="card-image">
                                    <img src="<?php echo $b_foto; ?>" align="left" width="150" height="150">
                                </div>

                                <div class="card-stacked">
                                    <div class="card-content">
                                    <h5><?php echo $ds_nome; ?></h5>
                                    <h6><i class="material-icons">school</i> Formação Acadêmica</h6>
                                    <h6><?php echo $ds_formacao ?></h6>
                                    <h6><i class="material-icons">near_me</i> Distância da Vaga</h6>
                                    <h6><?php echo number_format(distance($nr_latitude_vaga, $nr_longitude_vaga, $nr_latitude_profissional, $nr_longitude_profissional, "K"), 2, '.', '') . " km"; ?></h6>
                                    <h6><i class="material-icons">star</i> Características do Perfil</h6>
                                    <h6><?php echo $sexo; ?></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col m2">
                                    <button class="btn-floating btn-large waves-effect waves-light red" type="submit" name="action"><i class="material-icons right">favorite</i>
                                    </button>
                                        <br/><br/><br/>
                                        <h3 class="right-align teal-text">100%</h3>
                                    </div>
                                </div>
                            </div>
                        </div>  

  <?php
                    }
                }else{
                    echo $value;
                }
            }
  ?>


    </div>



</section>