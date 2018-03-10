<?php

require_once('../src/model/dados/daovaga.php');

/**
 * User = Rhuan
 */
class RNVaga{

	public function publicar($vaga){
		
			$daovaga = new DAOVaga();
			$result = $daovaga->publicar($vaga);

			return array('sucess' => 'Cadastrado com sucesso!');
		
	}

	public function pesquisar($vaga){
		try{
			$daovaga = new DAOVaga();
			$result = $daovaga->pesquisar($vaga);
			
			if (!empty($result)){
				return array('sucess' => $result);
			}else{
				return array('erro' => 'Não existe vaga com o código selecionado!');
			}
		}
		catch (Exception $e)
		{
			return array('erro' => $e->getMessage());
		}
	
	}
}

?>