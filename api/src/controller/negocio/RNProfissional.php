<?php

require_once('../src/model/dados/daoprofissional.php');

class RNProfissional{

	public function logar($login, $senha){

		if (empty($login) || empty($senha)){
			return json_encode(array('erro' => 'Todos os campos precisam ser preenchidos!'));
			exit;
		}

		$profissional = new Profissional();

		$profissional->setDsEmail($login);
		$profissional->setDsSenha($senha);

		$daoprofissional = new DaoProfissional();

		$result = $daoprofissional->pesquisar($profissional);

		if (!empty($result)){
			return array('sucess' => $result);
		}else{
			return array('erro' => 'Dados inválidos!');
		}
	}
}

?>