<?php
class idioma{
    private $cd_idioma;
    private $ds_idioma;

    function __construct(){}

    function setCdIdioma($cd_idioma){
        $this->cd_idioma = $cd_idioma;
    }
    function getCdIdioma(){
        return $this->cd_idioma;
    }

    function setDsIdioma($ds_idioma){
        $this->ds_idioma = $ds_idioma;
    }
    function getDsIdioma(){
        return $this->ds_idioma;
    }
}

 ?>