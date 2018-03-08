<?php
class habilidade{

    private $cd_habilidade;
    private $ds_habilidade;

    function __construct(){}

    function setCdHabilidade($cd_habilidade){
        $this->cd_habilidade = trim($cd_habilidade);
    }
    function getCdHabilidade(){
        return $this->cd_habilidade;
    }

    function setDsHabilidade($ds_habilidade){
        $this->ds_habilidade = $ds_habilidade;
    }
    function getDsHabilidade(){
        return $this->ds_habilidade;
    }

}

 ?>