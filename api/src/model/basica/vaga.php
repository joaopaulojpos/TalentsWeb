<?php
class Vaga implements JsonSerializable {

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
    private $nr_experiencia;
    private $ds_endereco;
	private $distancia_km;

    private $tp_status;

    //classe cargo
    private $cargo;
    //classe empresa
    private $empresa;
    //array de cursos
    private $cursos;
    //array de competencias
    private $competenciastecnicas;
    private $competenciascomport;
    //array de idiomas
    private $idiomas;
    //array de profissionais que curtiram a vaga
    private $profissionais;

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

    public function setNrExperiencia($nr_experiencia)
    {
        $this->nr_experiencia = $nr_experiencia;
    }
    public function getNrExperiencia()
    {
        return $this->nr_experiencia;
    }

    function setVlSalario($vl_salario)
    {
        $this->vl_salario = trim($vl_salario);
    }
    function getVlSalario()
    {
        return $this->vl_salario;
    }

    function setDsEndereco($ds_endereco)
    {
        $this->ds_endereco = trim($ds_endereco);
    }
    function getDsEndereco()
    {
        return $this->ds_endereco;
    }

    function setTpStatus($tp_status)
    {
        $this->tp_status = trim($tp_status);
    }
    function getTpStatus()
    {
        return $this->tp_status;
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

    function setCursos(Curso $curso)
    {
        $this->cursos[] = $curso;
    }
    function getCursos()
    {
        return $this->cursos;
    }

    function setCompetenciasTecnicas(CompetenciaTecnica $ct)
    {
        $this->competenciastecnicas[] = $ct;
    }
    function getCompetenciasTecnicas()
    {
        return $this->competenciastecnicas;
    }

    function setCompetenciasComport(CompetenciaComport $cc)
    {
        $this->competenciascomport[] = $cc;
    }
    function getCompetenciasComport()
    {
        return $this->competenciascomport;
    }

    function setIdiomas(idioma $idioma)
    {
        $this->idiomas[] = $idioma;
    }
    function getIdiomas()
    {
        return $this->idiomas;
    }
	
	function setDistanciaKm($distancia_km)
    {
        $this->distancia_km = $distancia_km;
    }
    function getDistanciaKm()
    {
        return $this->distancia_km;
    }

    /**
     * @return mixed
     */
    public function getProfissionais()
    {
        return $this->profissionais;
    }

    /**
     * @param mixed $profissionais
     */
    public function setProfissionais(Profissional $profissionais)
    {
        $this->profissionais[] = $profissionais;
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
                'nr_experiencia'=>$this->nr_experiencia,
                'dt_criacao'=>$this->dt_criacao,
                'ds_titulo'=>$this->ds_titulo,
                'vl_salario'=>$this->vl_salario,
                'ds_endereco'=>$this->ds_endereco,
                'tp_status'=>$this->tp_status,
                'cargo'=>$this->cargo,
                'empresa'=>$this->empresa,
                'cursos'=>$this->cursos,
                'competencias_tecnicas'=>$this->competenciastecnicas,
                'competencias_comp'=>$this->competenciascomport,
                'idiomas'=>$this->idiomas,
                'profissionais'=>$this->profissionais,
				'distancia_km'=>$this->distancia_km
            ];
    }
}

 ?>
