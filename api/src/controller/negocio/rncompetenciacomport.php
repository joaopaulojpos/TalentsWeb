<?php

class RNCompetenciaComport{

	public function pesquisar(CompetenciaComport $cc){
		try{
			$daocompetenciacomport = new DAOCompetenciaComport();
			$result = $daocompetenciacomport->pesquisar($cc);
			
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