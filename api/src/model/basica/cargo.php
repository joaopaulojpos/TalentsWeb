<?php
class cargo implements JsonSerializable
{

    private $cd_cargo;
    private $ds_cargo;
    private $ds_empresa;
    private $dt_inicio;
    private $dt_fim;

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

    function setDsEmpresa($ds_empresa){
        $this->ds_empresa = $ds_empresa;
    }
    function getDsEmpresa(){
        return $this->ds_empresa;
    }

    function setDtInicio($dt_inicio){
        $this->dt_inicio = $dt_inicio;
    }
    function getDtInicio(){
        return $this->dt_inicio;
    }

    function setDtFim($dt_fim){
        $this->dt_fim = $dt_fim;
    }
    function getDtFim(){
        return $this->dt_fim;
    }

    public function jsonSerialize(){
        return
            [
                'cd_cargo'=>$this->cd_cargo,
                'ds_cargo'=>$this->ds_cargo,
                'ds_empresa'=>$this->ds_empresa,
                'dt_inicio'=>$this->dt_inicio,
                'dt_fim'=>$this->dt_fim
            ];
    }
}
 ?>