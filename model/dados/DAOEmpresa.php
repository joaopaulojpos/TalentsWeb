<?php
require_once('../../model/basica/Empresa.php');

class DaoEmpresa
{

	public function cadastrar(Empresa $emp){
		return $this->post('http://localhost/talentsweb/api/public/api/empresa/cadastrar', 
			array( 'cnpj' => $emp->getNrCnpj(), 
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
		return $this->post('http://localhost/talentsweb/api/public/api/empresa/login', array( 'login' => $emp->getDsEmail(), 'senha' => $emp->getDsSenha()));
	}

	public function post($url, $params){

		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, 
		http_build_query($params)); 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
		// This should be the default Content-type for POST requests 
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded")); 
		$result = curl_exec($ch); 

		if(curl_errno($ch) !== 0) { 
			return json_encode('Erro: não foi possível conectar ao servidor!'); 
		} 
		curl_close($ch); 
		return $result; 
	}
}
?>