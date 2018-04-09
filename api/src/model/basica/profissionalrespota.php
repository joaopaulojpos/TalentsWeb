<?php
class profissionalrespota implements JsonSerializable
{

    private $cd_alternativa_perfil_comp;
    private $cd_profissional;
    private $cd_pergunta_perfil_comp;

    function __construct(){}

    function setcd_alternativa_perfil_comp($cd_alternativa_perfil_comp){
        $this->cd_alternativa_perfil_comp = trim($cd_alternativa_perfil_comp);
    }
    function getcd_alternativa_perfil_comp(){
        return $this->cd_alternativa_perfil_comp;
    }

    function setcd_profissional($cd_profissional){
        $this->cd_profissional = $cd_profissional;
    }
    function getcd_profissional(){
        return $this->cd_profissional;
    }

    function setcd_pergunta_perfil_comp($cd_pergunta_perfil_comp){
        $this->cd_pergunta_perfil_comp = $cd_pergunta_perfil_comp;
    }
    function getcd_pergunta_perfil_comp(){
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
                'cd_profissional'=>$this->cd_profissional.
                'cd_pergunta_perfil_comp'=>$this->cd_pergunta_perfil_comp
            ];
    }
}

 ?>