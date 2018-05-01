<?php
class curso implements JsonSerializable
{

    private $cd_curso;
    private $ds_curso;
    private $ds_instituicao;
    private $formacao;
    private $dt_inicio;
    private $dt_fim;
    private $nr_periodo;

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

    function setDtInicio($dt_inicio){
        $this->dt_inicio = $dt_inicio;
    }
    function getDtInicio(){
        return $this->dt_inicio;
    }

    function setDtFim($dt_fim){
        $this->dt_fim = $dt_fim;
    }
    function getDtFim(){
        return $this->dt_fim;
    }

    function setNrPeriodo($nr_periodo){
        $this->nr_periodo = $nr_periodo;
    }
    function getNrPeriodo(){
        return $this->nr_periodo;
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
                'ds_formacao'=>$this->formacao,
                'ds_instituicao'=>$this->ds_instituicao,
                'dt_inicio'=>$this->dt_inicio,
                'dt_fim'=>$this->dt_fim,
                'nr_periodo'=>$this->nr_periodo
            ];
    }
}

 ?>