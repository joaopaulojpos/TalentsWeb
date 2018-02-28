<?php

require_once('../src/model/dados/DAOEmpresa.php');

class RNEmpresa{

	public function cadastrar($empresa){
		/*if (empty($login) || empty($senha)){
			return json_encode(array( 'erro' => 'Todos os campos precisam ser preenchidos!'));
			exit;
		}*/
		try{

			$daoempresa = new DaoEmpresa();
			$result = $daoempresa->cadastrar($empresa);

			return json_encode(array( 'sucess' => 'Cadastrado com sucesso!'));

		}
		catch (Exception $e)
		{
			return json_encode(array( 'erro' => $e->getMessage()));
		}

	}

	public function logar($login, $senha){

		try{

			if (empty($login) || empty($senha)){
				return json_encode(array( 'erro' => 'Todos os campos precisam ser preenchidos!'));
				exit;
			}

			$empresa = new Empresa();

			$empresa->setDsEmail($login);
			$empresa->setDsSenha($senha);

			$daoempresa = new DaoEmpresa();

			$result = $daoempresa->pesquisar($empresa);

			if (!empty($result)){
				return json_encode(array( 'sucess' => $result));
			}else{
				return json_encode(array( 'erro' => 'Login e/ou senha invalido(s)!'));
			}
		}
		catch (Exception $e)
		{
			return json_encode(array( 'erro' => $e->getMessage()));
		}
	}
}

?>