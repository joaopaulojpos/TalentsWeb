<?php
include "menu2.php";
include "foooter.php";

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
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyDVFKVgRK5cfSc-q-Mk_OacpyilcRANBrM"></script>
    <script type="text/javascript" src="js/mapa.js"></script>

<section class="section">
    <form name="formulario" id="formulario" method="post" action="cadastro_vaga.php" onSubmit="return enviardados();">
    <div class="row">
        <div class="container center">
            <h5>Localização da vaga</h5>
            <div class="input-field col s12 m8">
                    <i class="material-icons prefix">gps_fixed</i>
                    <input id="txtEndereco" name="txtEndereco" type="text" class="validate" minlength="3" required>
                    <label for="titulo">Endereço da Vaga</label>
            </div>
            <div class="input-field col s12 m3">
                <input class="btn waves-effect waves-light teal darken-1" type="button" name="btnEndereco" id="btnEndereco" value="Ver no Mapa">
            </div>
        </div>

        <div class="row">
            <div class="container">
                <div class="col s12 m8" id="mapa">
                </div>
            </div>
        </div>
    </div>
</form>
</section>