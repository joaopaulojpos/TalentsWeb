<?php
class CompetenciaComport implements JsonSerializable {

    private $cd_competencia_comport;
    private $ds_competencia_comport;

    function __construct(){}

    function setCdCompetenciaComport($cd_competencia_comport){
        $this->cd_competencia_comport = trim($cd_competencia_comport);
    }
    function getCdCompetenciaComport(){
        return $this->cd_competencia_comport;
    }
    
    function setDsCompetenciaComport($ds_competencia_comport){
        $this->ds_competencia_comport = $ds_competencia_comport;
    }
    function getDsCompetenciaComport(){
        return $this->ds_competencia_comport;
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
                'cd_competencia_comport'=>$this->cd_competencia_comport,
                'ds_competencia_comport'=>$this->ds_competencia_comport
            ];
    }
}

 ?>