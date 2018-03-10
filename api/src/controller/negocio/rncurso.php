<?php

require_once('../src/model/dados/daocurso.php');

class RNCurso{

	public function pesquisar($curso){
		try{
			$daocurso = new DAOCurso();
			$result = $daocurso->pesquisar($curso);
			
			if (!empty($result)){
				return array('sucess' => $result);
			}else{
				return array('erro' => 'Não existe curso com o código selecionado!');
			}
		}
		catch (Exception $e)
		{
			return array('erro' => $e->getMessage());
		}
	}
}

?>