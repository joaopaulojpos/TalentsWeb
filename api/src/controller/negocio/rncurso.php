<?php

require_once('../src/model/dados/daocurso.php');

class RNCurso{

	public function pesquisar($curso){
		try{
			$daocurso = new daocurso();
			$result = $daocurso->pesquisar($curso);
			
			if (!empty($result)){
				return array('sucess' => $result);
			}else{
				return array('erro' => 'A pesquisa não retornou nenhum registro!');
			}
		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}
	}


    public function inserirCursoProfissional($cd_profissional,$cursos)
    {
        try{
            $dao = new daocurso();
            $result = $dao->cursoProfissional($cd_profissional,$cursos);
            return array('sucess');
        }catch (Exception $e){
            return array('erro'=> $e->getMessage());
        }
    }
}

?>