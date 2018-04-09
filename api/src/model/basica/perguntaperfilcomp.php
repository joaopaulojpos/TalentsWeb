<?php
class perguntaperfilcomp implements JsonSerializable
{

    private $cd_pergunta;
    private $ds_pergunta;

    function __construct(){}

    function setCdPergunta($cd_pergunta){
        $this->cd_pergunta = trim($cd_pergunta);
    }
    function getCdPergunta(){
        return $this->cd_pergunta;
    }

    function setDsPergunta($ds_pergunta){
        $this->ds_pergunta = $ds_pergunta;
    }
    function getDsPergunta(){
        return $this->ds_pergunta;
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
                'cd_pergunta'=>$this->cd_pergunta,
                'ds_pergunta'=>$this->ds_perguntas
            ];
    }
}

 ?>