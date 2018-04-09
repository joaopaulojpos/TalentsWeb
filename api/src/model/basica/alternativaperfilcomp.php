<?php
class alternativaperfilcomp implements JsonSerializable
{

    private $cd_alternativa_perfil_comp;
    private $ds_resposta;
    private $nr_letra_ref;
    private $cd_pergunta_perfil_comp;

    function __construct(){}

    function setAlternativa_perfil_comp($cd_alternativa_perfil_comp){
        $this->cd_alternativa_perfil_comp = trim($cd_alternativa_perfil_comp);
    }
    function getAlternativa_perfil_comp(){
        return $this->cd_alternativa_perfil_comp;
    }

    function setDs_resposta($ds_resposta){
        $this->ds_resposta = $ds_resposta;
    }
    function getDs_resposta(){
        return $this->ds_resposta;
    }

    function setNr_letra_ref($nr_letra_ref){
        $this->nr_letra_ref = $nr_letra_ref;
    }
    function getNr_letra_ref(){
        return $this->nr_letra_ref;
    }

    function setCd_pergunta_perfil_comp($cd_pergunta_perfil_comp){
        $this->cd_pergunta_perfil_comp = $cd_pergunta_perfil_comp;
    }
    function getCd_pergunta_perfil_comp(){
        return $this->cd_pergunta_perfil_comp;
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
                'cd_alternativa_perfil_comp'=>$this->cd_alternativa_perfil_comp,
                'ds_resposta'=>$this->ds_resposta,
                'nr_letra_ref'=>$this->nr_letra_ref,
                'cd_pergunta_perfil_comp' =>$this->cd_pergunta_perfil_comp
            ];
    }
}

 ?>