<?php
class Vaga{

    private $cd_vaga;
    private $nr_qtd_vaga;
    private $ds_observacao;
    private $dt_validade;
    private $tp_contratacao;
    private $nr_longitude;
    private $nr_latitude;
    private $ds_beneficios;
    private $ds_horario_expediente;
    private $dt_criacao;
    private $ds_titulo;
    private $vl_salario;
    //classe cargo
    private $cargo;
    //classe empresa
    private $empresa;
    //array de cursos
    private $cursos;
    //array de habilidades
    private $habilidades;
    //array de idiomas
    private $idiomas;

    function __construct(){}

    function setCdVaga($cd_vaga)
    {
        $this->cd_vaga = trim($cd_vaga);
    }
    function getCdVaga()
    {
        return $this->cd_vaga;
    }

    function setNrQtdVaga($nr_qtd_vaga)
    {
        $this->nr_qtd_vaga = trim($nr_qtd_vaga);
    }
    function getNrQtdVaga()
    {
        return $this->nr_qtd_vaga;
    }

    function setDsObservacao($ds_observacao)
    {
        $this->ds_observacao = $ds_observacao;
    }
    function getDsObservacao()
    {
        return $this->ds_observacao;
    }

    function setDtValidade($dt_validade)
    {
        $this->dt_validade = trim($dt_validade);
    }
    function getDtValidade()
    {
        return $this->dt_validade;
    }

    function setTpContratacao($tp_contratacao)
    {
        $this->tp_contratacao = $tp_contratacao;
    }
    function getTpContratacao()
    {
        return $this->tp_contratacao;
    }

    function setNrLongitude($nr_longitude)
    {
        $this->nr_longitude = trim($nr_longitude);
    }
    function getNrLongitude()
    {
        return $this->nr_longitude;
    }

    function setNrLatitude($nr_latitude)
    {
        $this->nr_latitude = trim($nr_latitude);
    }
    function getNrLatitude()
    {
        return $this->nr_latitude;
    }

    function setDsBeneficios($ds_beneficios)
    {
        $this->ds_beneficios = $ds_beneficios;
    }
    function getDsBeneficios()
    {
        return $this->ds_beneficios;
    }

    function setDsHorarioExpediente($ds_horario_expediente)
    {
        $this->ds_horario_expediente = $ds_horario_expediente;
    }
    function getDsHorarioExpediente()
    {
        return $this->ds_horario_expediente;
    }

    function setDtCriacao($dt_criacao)
    {
        $this->dt_criacao = trim($dt_criacao);
    }
    function getDtCriacao()
    {
        return $this->dt_criacao;
    }

    function setDsTitulo($ds_titulo)
    {
        $this->ds_titulo = $ds_titulo;
    }
    function getDsTitulo()
    {
        return $this->ds_titulo;
    }

    function setVlSalario($vl_salario)
    {
        $this->vl_salario = trim($vl_salario);
    }
    function getVlSalario()
    {
        return $this->vl_salario;
    }

    function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }
    function getCargo()
    {
        return $this->cargo;
    }

    function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    }
    function getEmpresa()
    {
        return $this->empresa;
    }

    function setCursos($curso)
    {
        $this->cursos[] = $curso;
    }
    function getCursos()
    {
        return $this->cursos;
    }

    function setHabilidades($habilidade)
    {
        $this->habilidades[] = $habilidade;
    }
    function getHabilidades()
    {
        return $this->habilidades;
    }

    function setIdiomas($idioma)
    {
        $this->idiomas[] = $idioma;
    }
    function getIdiomas()
    {
        return $this->idiomas;
    }
}

 ?>
