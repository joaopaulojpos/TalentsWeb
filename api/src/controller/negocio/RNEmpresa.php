<?php

require_once('../src/model/dados/DAOEmpresa.php');
require_once('../src/model/basica/Empresa.php');

class RNEmpresa{

	public function logar($login, $senha){

		if (empty($login) || empty($senha)){
			return json_encode('erro: {todos os campos precisam ser preenchidos}');
			exit;
		}

		$empresa = new Empresa();

		$empresa->setDsEmail($login);
		$empresa->setDsSenha($senha);

		$daoempresa = new DaoEmpresa();


		$result = $daoempresa->pesquisar($empresa);

		if (!empty($result)){
			return '{"Erro": '.json_encode($result).'}';
		}else{
			return json_encode('erro: {Dados inválidos}');
		}
	}
}

?>