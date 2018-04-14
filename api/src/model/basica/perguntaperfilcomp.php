<?php
class perguntaperfilcomp implements JsonSerializable
{

    private $cd_pergunta;
    private $ds_pergunta;
    private $alternativas;
    private $resposta;

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
     * @return mixed
     */
    public function getAlternativas()
    {
        return $this->alternativas;
    }

    /**
     * @param $alternativas
     */
    public function setAlternativas($alternativas): void
    {
        $this->alternativas[] = $alternativas;
    }
    /**
     * @return mixed
     */
    public function getResposta()
    {
        return $this->resposta;
    }

    /**
     * @param mixed $resposta
     */
    public function setResposta($resposta): void
    {
        $this->resposta = $resposta;
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
                'ds_pergunta'=>$this->ds_pergunta,
                'alternativas'=>$this->alternativas,
                'resposta'=>$this->resposta
            ];
    }
}

 ?>