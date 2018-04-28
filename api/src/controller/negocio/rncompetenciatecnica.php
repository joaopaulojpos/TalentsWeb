<?php

class RNCompetenciaTecnica{

	public function pesquisar(CompetenciaTecnica $ct){
		try{
			$daocompetenciatecnica = new DAOCompetenciaTecnica();
			$result = $daocompetenciatecnica->pesquisar($ct);
			
			if (!empty($result)){
				return array('sucess' => $result);
			}else{
				return array('erro' => 'A pesquisa não retornou nenhum registro!');
			}
		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}
	}

    public function inserirCompetenciaTecnicaProfissional($cd_profissional,$competencias)
    {
        try{
            $dao = new DAOCompetenciaTecnica();
            $result = $dao->inserirCompetenciaTecnicaProfissional($cd_profissional,$competencias);
            return array('sucess');
        }catch (Exception $e){
            return array('erro'=> $e->getMessage());
        }
    }
}

?>