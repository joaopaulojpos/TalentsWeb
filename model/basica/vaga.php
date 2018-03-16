<?php

class Vaga implements JsonSerializable {

    private $cd_vaga;
    private $ds_titulo;
    private $nr_qtd_vaga;
    private $tp_contratacao;
    private $nr_longitude;
    private $nr_latitude;
    private $ds_beneficios;
    private $ds_horario_expediente;
    private $vl_salario;
    private $dt_criacao;
    private $dt_validade;
    private $ds_observacao;
    //classe cargo
    public $cargo;
    //classe empresa
    private $empresa;
    //array de cursos
    private $cursos;
    //array de habilidades
    private $habilidades;
    //array de idiomas
    private $idiomas;

    public function __construct(){}

    public function setCdVaga($cd_vaga)
    {
        $this->cd_vaga = trim($cd_vaga);
    }
    public function getCdVaga()
    {
        return $this->cd_vaga;
    }

    public function setNrQtdVaga($nr_qtd_vaga)
    {
        $this->nr_qtd_vaga = trim($nr_qtd_vaga);
    }
    public function getNrQtdVaga()
    {
        return $this->nr_qtd_vaga;
    }

    public function setDsObservacao($ds_observacao)
    {
        $this->ds_observacao = $ds_observacao;
    }
    public function getDsObservacao()
    {
        return $this->ds_observacao;
    }

    public function setDtValidade($dt_validade)
    {
        $this->dt_validade = trim($dt_validade);
    }
    public function getDtValidade()
    {
        return $this->dt_validade;
    }

    public function setTpContratacao($tp_contratacao)
    {
        $this->tp_contratacao = $tp_contratacao;
    }
    public function getTpContratacao()
    {
        return $this->tp_contratacao;
    }

    public function setNrLongitude($nr_longitude)
    {
        $this->nr_longitude = trim($nr_longitude);
    }
    public function getNrLongitude()
    {
        return $this->nr_longitude;
    }

    public function setNrLatitude($nr_latitude)
    {
        $this->nr_latitude = trim($nr_latitude);
    }
    public function getNrLatitude()
    {
        return $this->nr_latitude;
    }

    public function setDsBeneficios($ds_beneficios)
    {
        $this->ds_beneficios = $ds_beneficios;
    }
    public function getDsBeneficios()
    {
        return $this->ds_beneficios;
    }

    public function setDsHorarioExpediente($ds_horario_expediente)
    {
        $this->ds_horario_expediente = $ds_horario_expediente;
    }
    public function getDsHorarioExpediente()
    {
        return $this->ds_horario_expediente;
    }

    public function setDtCriacao($dt_criacao)
    {
        $this->dt_criacao = trim($dt_criacao);
    }
    public function getDtCriacao()
    {
        return $this->dt_criacao;
    }

    public function setDsTitulo($ds_titulo)
    {
        $this->ds_titulo = $ds_titulo;
    }
    public function getDsTitulo()
    {
        return $this->ds_titulo;
    }

    public function setVlSalario($vl_salario)
    {
        $this->vl_salario = trim($vl_salario);
    }
    public function getVlSalario()
    {
        return $this->vl_salario;
    }

    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }
    public function getCargo()
    {
        return $this->cargo;
    }

    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    }
    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function setCursos(Curso $curso)
    {
        $this->cursos[] = $curso;
    }
    public function getCursos()
    {
        return $this->cursos;
    }

    public function setHabilidades(habilidade $habilidade)
    {
        $this->habilidades[] = $habilidade;
    }
    public function getHabilidades()
    {
        return $this->habilidades;
    }

    public function setIdiomas(Idioma $idioma)
    {
        $this->idiomas[] = $idioma;
    }
    public function getIdiomas()
    {
        return $this->idiomas;
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
                'cd_vaga'=>$this->cd_vaga,
                'nr_qtd_vaga'=>$this->nr_qtd_vaga,
                'ds_observacao'=>$this->ds_observacao,
                'dt_validade'=>$this->dt_validade,
                'tp_contratacao'=>$this->tp_contratacao,
                'nr_longitude'=>$this->nr_longitude,
                'nr_latitude'=>$this->nr_latitude,
                'ds_beneficios'=>$this->ds_beneficios,
                'ds_horario_expediente'=>$this->ds_horario_expediente,
                'dt_criacao'=>$this->dt_criacao,
                'ds_titulo'=>$this->ds_titulo,
                'vl_salario'=>$this->vl_salario,
                'cargo'=>$this->cargo,
                'empresa'=>$this->empresa,
                'cursos'=>$this->cursos,
                'habilidades'=>$this->habilidades,
                'idiomas'=>$this->idiomas,
            ];
    }
}

 ?>
