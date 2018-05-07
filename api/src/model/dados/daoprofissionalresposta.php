<?php

require_once('../src/model/dados/idaoprofissionalresposta.php');

class DAOProfissionalresposta implements iDAOProfissionalresposta
{	
	function __construct(){
		
	}
	public function cadastrarResposta(Profissionalrespota $emp){
		try{
			$comando = "insert into profissional_alternativa_perfil_comp (cd_alternativa_perfil_comp,cd_profissional,cd_pergunta_perfil_comp) 
							 values (:cd_alternativa_perfil_comp,:cd_profissional,:cd_pergunta_perfil_comp)";
			$stmt = db::getInstance()->prepare($comando);

			$stmt->bindValue(':cd_alternativa_perfil_comp', $emp->getAlternativa_perfil_comp());
			$stmt->bindValue(':cd_profissional', $emp->getCdProfissional());
			$stmt->bindValue(':cd_pergunta_perfil_comp', $emp->getCdPergunta());
			$run = $stmt->execute();

		}catch(Exception $e){
			throw new Exception($e->getMessage());
		}finally{
			$stmt->closeCursor();
		}
	}
}
?>