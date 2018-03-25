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
				return array('erro' => 'A pesquisa não retornou nenhum registro!');
			}
		}
		catch (Exception $e)
		{
			return array('erro' => $e->getMessage());
		}
	}
}

?>