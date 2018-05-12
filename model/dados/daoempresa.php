<?php
require_once('../../model/basica/empresa.php');

class DaoEmpresa
{

	public function cadastrar(Empresa $emp){
		$request = new RequestMethods();

		return $request->post($request::$url.'/empresa/salvar', 
			array( 'cd_empresa' => $emp->getCdEmpresa(),
				   'cnpj' => $emp->getNrCnpj(), 
				   'razaosocial' => $emp->getDsRazaoSocial(),
				   'nomefantasia' => $emp->getDsNomeFantasia(),
				   'porte' => $emp->getNrPorte(),
				   'areaatuacao' => $emp->getDsAreaAtuacao(),
				   'responsavel' => $emp->getDsResponsavelCadastro(),
				   'site' => $emp->getDsSite(),
				   'telefone' => $emp->getDsTelefone(),
				   'email' => $emp->getDsEmail(),
				   'senha' => $emp->getDsSenha()));
	}

	public function logar(Empresa $emp){
		$request = new RequestMethods();

		return $request->post($request::$url.'/empresa/login', array( 'login' => $emp->getDsEmail(), 'senha' => $emp->getDsSenha()));
	}

	public function vagasEmpresaPesquisar($cd_empresa){
		$request = new RequestMethods();

		return $request->get($request::$url.'/empresa/'.$cd_empresa.'/vagas');
	}

}
?>