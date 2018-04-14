<?php
class alternativaperfilcomp implements JsonSerializable
{

    private $cd_alternativa_perfil_comp;
    private $ds_resposta;
    private $nr_letra_ref;
    private $cd_pergunta_perfil_comp;

    function __construct(){}

    /**
     * @return mixed
     */
    public function getCdAlternativaPerfilComp()
    {
        return $this->cd_alternativa_perfil_comp;
    }

    /**
     * @param mixed $cd_alternativa_perfil_comp
     */
    public function setCdAlternativaPerfilComp($cd_alternativa_perfil_comp): void
    {
        $this->cd_alternativa_perfil_comp = $cd_alternativa_perfil_comp;
    }

    /**
     * @return mixed
     */
    public function getDsResposta()
    {
        return $this->ds_resposta;
    }

    /**
     * @param mixed $ds_resposta
     */
    public function setDsResposta($ds_resposta): void
    {
        $this->ds_resposta = $ds_resposta;
    }

    /**
     * @return mixed
     */
    public function getNrLetraRef()
    {
        return $this->nr_letra_ref;
    }

    /**
     * @param mixed $nr_letra_ref
     */
    public function setNrLetraRef($nr_letra_ref): void
    {
        $this->nr_letra_ref = $nr_letra_ref;
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
                'nr_letra_ref'=>$this->nr_letra_ref
            ];
    }
}

 ?>