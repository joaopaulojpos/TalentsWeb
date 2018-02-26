<?php
class Profissional{
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
}
?>