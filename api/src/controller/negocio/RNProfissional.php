<?php

require_once('../src/model/dados/DAOProfissional.php');
require_once('../src/model/basica/Profissional.php');

class RNProfissional{

	public function logar($login, $senha){

		if (empty($login) || empty($senha)){
			return json_encode('erro: {todos os campos precisam ser preenchidos}');
			exit;
		}

		$profissional = new Profissional();

		$profissional->setDsEmail($login);
		$profissional->setDsSenha($senha);

		$daoprofissional = new DaoProfissional();


		$result = $daoprofissional->pesquisar($profissional);

		if (!empty($result)){
			return '{"Erro": '.json_encode($result).'}';
		}else{
			return json_encode('erro: {Dados inválidos}');
		}
	}
}

?>