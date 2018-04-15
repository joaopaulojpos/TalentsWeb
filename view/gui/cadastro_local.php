<?php
include "menu2.php";
include "foooter.php";
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
                <div class="col s12 m8">
                    <div class="mapa" id="mapa"></div>
                </div>
            </div>
        </div>
    </div>
</form>
</section>