<?php
class cargo implements JsonSerializable
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

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize(){
        return
            [
                'cd_cargo'=>$this->cd_cargo,
                'ds_cargo'=>$this->ds_cargo
            ];
    }
}

 ?>