<?php

require_once('../src/model/dados/DAOVaga.php');

/**
 * User = Rhuan
 */
class RNVaga{

	public function publicar($vaga){
		
			$daovaga = new DAOVaga();
			$result = $daovaga->publicar($vaga);

			return array('sucess' => 'Cadastrado com sucesso!');
		
	}

	
}

?>