<?php

require_once('../src/model/dados/DAOVaga.php');

class RNVaga{

	public function cadastrar($vaga){
		
			$daovaga = new DAOVaga();
			$result = $daovaga->cadastrar($vaga);

			return array('sucess' => 'Cadastrado com sucesso!');
		
	}

	
}

?>