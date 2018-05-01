<?php
class Profissional implements JsonSerializable {
	private $cd_profissional;
	private $b_foto;
	private $ds_senha;
	private $dt_nascimento;
	private $ds_email;
	private $nr_latitude;
	private $nr_longitude; 
	private $tp_conta;
	private $tp_sexo;
	private $ds_nome;
	private $match_empresa;
	private $ds_resultado_comp;

	//array de cargos
	private $cargos;

	//array de cursos
    private $cursos;

    //array de competencias
    private $competenciastecnicas;

    //array de idiomas
    private $idiomas;


	function __construct(){
		
	}

	function setCdProfissional($cd_profissional)
	{
		$this->cd_profissional = trim($cd_profissional);
	}
	function getCdProfissional()
	{
		return $this->cd_profissional;
	}

	function setBfoto($b_foto)
	{
		$this->b_foto = trim($b_foto);
	}
	function getBfoto()
	{
		return $this->b_foto;
	}
	function setDsSenha($ds_senha)
	{
		$this->ds_senha = trim($ds_senha);
	}
	function getDsSenha()
	{
		return $this->ds_senha;
	}

	function setDtNascimento($dt_nascimento)
	{
		$this->dt_nascimento = trim($dt_nascimento);
	}
	function getDtNascimento()
	{
		return $this->dt_nascimento;
	}

	function setNrlatitude($nr_latitude)
	{
		$this->nr_latitude = trim($nr_latitude);
	}
	function getNrlatitude()
	{
		return $this->nr_latitude;
	}

	function setNrlogitude($nr_longitude)
	{
		$this->nr_longitude = trim($nr_longitude);
	}
	function getNrlogitude()
	{
		return $this->nr_longitude;
	}

	function setTpconta($tp_conta)
	{
		$this->tp_conta = trim($tp_conta);
	}
	function getTpconta()
	{
		return $this->tp_conta;
	}

	function setTpsexo($tp_sexo)
	{
		$this->tp_sexo = trim($tp_sexo);
	}
	function getTpsexo()
	{
		return $this->tp_sexo;
	}

	function setDsnome($ds_nome)
	{
		$this->ds_nome = trim($ds_nome);
	}
	function getDsnome()
	{
		return $this->ds_nome;
	}
	function setDsEmail($ds_email)
	{
		$this->ds_email = trim($ds_email);
	}
	function getDsEmail()
	{
		return $this->ds_email;
	}
	function setMatchEmpresa($match_empresa)
	{
		$this->match_empresa = trim($match_empresa);
	}
	function getMatchEmpresa()
	{
		return $this->match_empresa;
	}
	function setDsResultadoComp($ds_resultado_comp)
	{
		$this->ds_resultado_comp = trim($ds_resultado_comp);
	}
	function getDsResultadoComp()
	{
		return $this->ds_resultado_comp;
	}
	function setCargos(cargo $cargo)
    {
        $this->cargos[] = $cargo;
    }
    function getCargos()
    {
        return $this->cargos;
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
    function setIdiomas(idioma $idioma)
    {
        $this->idiomas[] = $idioma;
    }
    function getIdiomas()
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
                'cd_profissional'=>$this->cd_profissional,
                'porcentagem'=>99.99,
                'ds_nome'=>$this->ds_nome,
                'ds_email'=>$this->ds_email,
                'ds_senha'=>$this->ds_senha,
                'dt_nascimento'=>$this->dt_nascimento,
                'b_foto'=>$this->b_foto,
                'nr_latitude'=>$this->nr_latitude,
                'nr_longitude'=>$this->nr_longitude,
                'tp_conta'=>$this->tp_conta,
                'tp_sexo'=>$this->tp_sexo,
                'match_empresa'=>$this->match_empresa,
                'ds_resultado_comp'=>$this->ds_resultado_comp,
                'cargos'=>$this->cargos,
                'cursos'=>$this->cursos,
                'competencias_tecnicas'=>$this->competenciastecnicas,
                'idiomas'=>$this->idiomas
            ];
    }
}
?>