<?php
class Empresa{
	private $cd_empresa;
	private $nr_cnpj;
	private $ds_razao_social;
	private $ds_nome_fantasia;
	private $nr_porte; 
	private $ds_responsavel_cadastro;
	private $ds_area_atuacao;
	private $ds_site;
	private $ds_telefone;
	private $ds_email;
	private $ds_senha;

	function __construct(){
		
	}

	function setCdEmpresa($cd_empresa)
	{
		$this->cd_empresa = trim($cd_empresa);
	}
	function getCdEmpresa()
	{
		return $this->cd_empresa;
	}

	function setNrCnpj($nr_cnpj)
	{
		$this->nr_cnpj = trim($nr_cnpj);
	}
	function getNrCnpj()
	{
		return $this->nr_cnpj;
	}

	function setDsRazaoSocial($ds_razao_social)
	{
		$this->ds_razao_social = trim($ds_razao_social);
	}
	function getDsRazaoSocial()
	{
		return $this->ds_razao_social;
	}

	function setDsNomeFantasia($ds_nome_fantasia)
	{
		$this->ds_nome_fantasia = trim($ds_nome_fantasia);
	}
	function getDsNomeFantasia()
	{
		return $this->ds_nome_fantasia;
	}

	function setNrPorte($nr_porte)
	{
		$this->nr_porte = trim($nr_porte);
	}
	function getNrPorte()
	{
		return $this->nr_porte;
	}

	function setDsResponsavelCadastro($ds_responsavel_cadastro)
	{
		$this->ds_responsavel_cadastro = trim($ds_responsavel_cadastro);
	}
	function getDsResponsavelCadastro()
	{
		return $this->ds_responsavel_cadastro;
	}

	function setDsAreaAtuacao($ds_area_atuacao)
	{
		$this->ds_area_atuacao = trim($ds_area_atuacao);
	}
	function getDsAreaAtuacao()
	{
		return $this->ds_area_atuacao;
	}

	function setDsSite($ds_site)
	{
		$this->ds_site = trim($ds_site);
	}
	function getDsSite()
	{
		return $this->ds_site;
	}

	function setDsTelefone($ds_telefone)
	{
		$this->ds_telefone = trim($ds_telefone);
	}
	function getDsTelefone()
	{
		return $this->ds_telefone;
	}

	function setDsEmail($ds_email)
	{
		$this->ds_email = trim($ds_email);
	}
	function getDsEmail()
	{
		return $this->ds_email;
	}

	function setDsSenha($ds_senha)
	{
		$this->ds_senha = trim($ds_senha);
	}
	function getDsSenha()
	{
		return $this->ds_senha;
	}
}
?>