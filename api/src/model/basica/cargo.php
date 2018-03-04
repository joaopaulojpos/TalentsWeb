<?php
class cargo
{

    private $cd_cargo;
    private $ds_cargo;

    function __construct(){}

    function setCdCargo($cd_cargo){
        $this->cd_cargo = trim($cd_cargo);
    }
    function getCdCargo(){
        return $this->cd_cargo;
    }

    function setDsCargo($ds_cargo){
        $this->ds_cargo = $ds_cargo;
    }
    function getDsCargo(){
        return $this->ds_cargo;
    }
}

 ?>