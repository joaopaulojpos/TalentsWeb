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
				return array('erro' => 'A pesquisa não retornou nenhum registro!');
			}
		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}
	}

    public function inserirIdiomaProfissional($cd_profissional,$idiomas)
    {
        try{
            $dao = new DaoIdioma();
            $result = $dao->idiomaProfissional($cd_profissional,$idiomas);
            return array('sucess');
        }catch (Exception $e){
            return array('erro'=> $e->getMessage());
        }
    }
}

?>