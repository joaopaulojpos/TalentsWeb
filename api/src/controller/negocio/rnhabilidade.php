<?php

require_once('../src/model/dados/daohabilidade.php');

class RNHabilidade{

	public function pesquisar($habilidade){
		try{
			$daohabilidade = new DaoHabilidade();
			$result = $daohabilidade->pesquisar($habilidade);
			
			if (!empty($result)){
				return array('sucess' => $result);
			}else{
				return array('erro' => 'Não existe habilidade com o código selecionado!');
			}
		}
		catch (Exception $e)
		{
			return array('erro' => $e->getMessage());
		}
	}
}

?>