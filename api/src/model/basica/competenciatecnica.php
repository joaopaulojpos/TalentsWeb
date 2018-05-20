<?php
class CompetenciaTecnica implements JsonSerializable {

    private $cd_competencia_tecnica;
    private $nr_nivel;
    private $ds_competencia_tecnica;
    private $pontosranking;

    function __construct(){}

    function setCdCompetenciaTecnica($cd_competencia_tecnica){
        $this->cd_competencia_tecnica = trim($cd_competencia_tecnica);
    }
    function getCdCompetenciaTecnica(){
        return $this->cd_competencia_tecnica;
    }

    /**
     * @return mixed
     */
    public function getNrNivel()
    {
        return $this->nr_nivel;
    }

    /**
     * @param mixed $nr_nivel
     */
    public function setNrNivel($nr_nivel)
    {
        $this->nr_nivel = $nr_nivel;
    }

    function setDsCompetenciaTecnica($ds_competencia_tecnica){
        $this->ds_competencia_tecnica = $ds_competencia_tecnica;
    }
    function getDsCompetenciaTecnica(){
        return $this->ds_competencia_tecnica;
    }

    /**
     * @return mixed
     */
    public function getPontosranking()
    {
        return $this->pontosranking;
    }

    /**
     * @param mixed $pontosranking
     */
    public function setPontosranking($pontosranking)
    {
        $this->pontosranking = $pontosranking;
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
                'cd_competencia_tecnica'=>$this->cd_competencia_tecnica,
                'ds_competencia_tecnica'=>$this->ds_competencia_tecnica,
                'nr_nivel'=>$this->nr_nivel
            ];
    }
}

 ?>