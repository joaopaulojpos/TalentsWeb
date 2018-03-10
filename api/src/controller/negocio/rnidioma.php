<?php

require_once('../src/model/dados/daoidioma.php');

class RNIdioma{

	public function pesquisar($idioma){
		try{
			$daoidioma = new DAOIdioma();
			$result = $daoidioma->pesquisar($idioma);
			
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