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


    public function inserirCursoProfissional($cd_profissional, $cd_curso, $ds_instituicao, $dt_fim, $dt_inicio, $nr_certificado, $tp_certificado_validado, $nr_periodo)
    {
        try{
            $dao = new daocurso();
            $result = $dao->inserirCursoProfissional($cd_profissional, $cd_curso, $ds_instituicao, $dt_fim, $dt_inicio, $nr_certificado, $tp_certificado_validado, $nr_periodo);
            return array('sucess');
        }catch (Exception $e){
            return array('erro'=> $e->getMessage());
        }
    }
}

?>