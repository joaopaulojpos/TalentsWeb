<?php

require_once('../src/model/dados/daoperguntaperfilcomp.php');


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


	public function cadastrarResposta($CdPergunta,$cd_profissional,$Resposta){	
		try{
			$daoPerguntaperfilcomp = new DaoPerguntaperfilcomp();
			$perguntaperfilcomp = new perguntaperfilcomp();
			$prof = new Profissional();

            $perguntaperfilcomp->setResposta($Resposta);
            $prof->setCdProfissional($cd_profissional);
            $perguntaperfilcomp->setCdPergunta($CdPergunta);
			
			
			$result = $daoPerguntaperfilcomp->cadastrarResposta($CdPergunta,$cd_profissional,$Resposta);

			return array('sucess' => 'Cadastrado com sucesso!');

		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}
	}

}

?>