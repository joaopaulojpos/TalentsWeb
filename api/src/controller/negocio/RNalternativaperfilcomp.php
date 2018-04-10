<?php

class RNalternativaperfilcomp{

	public function pesquisar(Alternativaperfilcomp $cc){
		try{
			$daoalternativaperfilcomp = new DAOalternativaperfilcomp();
			$result = $daoalternativaperfilcomp->pesquisar($cc);
			
			if (!empty($result)){
				return array('sucess' => $result);
			}else{
				return array('erro' => 'A pesquisa não retornou nenhum registro!');
			}
		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}
	}
}

?>