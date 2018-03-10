<?php

require_once('../src/model/dados/daocargo.php');

class RNCargo{

	public function pesquisar($cargo){
		try{
			$daocargo = new DaoCargo();
			$result = $daocargo->pesquisar($cargo);
			
			if (!empty($result)){
				return array('sucess' => $result);
			}else{
				return array('erro' => 'Não existe cargo com o código selecionado!');
			}
		}
		catch (Exception $e)
		{
			return array('erro' => $e->getMessage());
		}
	}
}

?>