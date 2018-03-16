<?php
class curso implements JsonSerializable {

    private $cd_curso;
    private $ds_curso;
    private $ds_instituicao;
    private $formacao;

    function __construct(){}

    function setCdCurso($cd_curso){
        $this->cd_curso = trim($cd_curso);
    }
    function getCdCurso(){
        return $this->cd_curso;
    }

    function setDsCurso($ds_curso){
        $this->ds_curso = $ds_curso;
    }
    function getDsCurso(){
        return $this->ds_curso;
    }

    function setDsInstituicao($ds_instituicao){
        $this->ds_instituicao = $ds_instituicao;
    }
    function getDsInstituicao(){
        return $this->ds_instituicao;
    }

    function setFormacao($formacao){
        $this->formacao = $formacao;
    }
    function getFormacao(){
        return $this->formacao;
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
                'cd_curso'=>$this->cd_curso,
                'ds_curso'=>$this->ds_curso,
                'ds_instituicao'=>$this->ds_instituicao
            ];
        //TODO implementar Formação
    }
}

 ?>