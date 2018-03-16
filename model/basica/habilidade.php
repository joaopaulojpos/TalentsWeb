<?php
class habilidade implements JsonSerializable {

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

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return
            [
                'cd_habilidade'=>$this->cd_habilidade,
                'nr_nivel'=>$this->nr_nivel,
                'ds_habilidade'=>$this->ds_habilidade
            ];
    }
}

 ?>