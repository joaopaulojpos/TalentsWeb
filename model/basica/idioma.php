<?php
class idioma implements JsonSerializable {
    private $cd_idioma;
    private $ds_idioma;
    private $nr_nivel;

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
                'cd_idioma'=>$this->cd_idioma,
                'ds_idioma'=>$this->ds_idioma,
                'nr_nivel'=>$this->nr_nivel
            ];
    }
}

 ?>