<?php

require_once('../src/model/dados/iDAOperguntaperfilcomp.php');

class DaoPerguntaperfilcomp implements iDAOperguntaperfilcomp
{	
	function __construct(){
		
	}

	public function pesquisar(Perguntaperfilcomp $perguntaperfilcomp, $alt='false'){
		try{
			$comando = 'select * from pergunta_perfil_comp ';
			$where = '';
			$orderby = ' order by cd_pergunta_perfil_comp asc';

			if (!empty($perguntaperfilcomp->getCdPergunta())){
				if (empty($where)){
					$where = ' where cd_pergunta_perfil_comp = :cd_pergunta_perfil_comp';
				}else{
					$where = $where . ' and cd_pergunta_perfil_comp = :cd_pergunta_perfil_comp';
				}
			}

			if (!empty($perguntaperfilcomp->getDsPergunta())){
				if (empty($where)){
					$where = ' where ds_pergunta like :descricao';
				}else{
					$where = $where . ' and ds_pergunta like :descricao';
				}
			}

			$stmt = db::getInstance()->prepare($comando . $where . $orderby);
			if (!empty($perguntaperfilcomp->getCdPergunta()))
				$stmt->bindValue(':cd_pergunta_perfil_comp', $perguntaperfilcomp->getCdPergunta());
			if (!empty($perguntaperfilcomp->getDsPergunta()))
				$stmt->bindValue(':descricao', '%'.$perguntaperfilcomp->getDsPergunta().'%');

			$run = $stmt->execute();

			return ($stmt->fetchAll(PDO::FETCH_ASSOC));

		}catch(Exception $e){
			throw new Exception($e->getMessage());
		}finally{
			$stmt->closeCursor();
		}
	}
}
?>