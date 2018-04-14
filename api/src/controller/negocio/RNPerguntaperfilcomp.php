<?php

class RNPerguntaperfilcomp{

	public function listarPerguntas(){
		try{
			$daoPerguntaperfilcomp = new DaoPerguntaperfilcomp();
			$result = $daoPerguntaperfilcomp->listarPerguntas();
			
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