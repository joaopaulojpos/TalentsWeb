<?php

require_once('../src/model/dados/iDAOalternativaperfilcomp.php');

class Daoalternativaperfilcomp implements iDAOalternativaperfilcomp
{	
	function __construct(){
		
	}

	public function pesquisar(alternativaperfilcomp $alternativaperfilcomp, $alt='false'){
		try{
			$comando = 'select * from alternativa_perfil_comp ';
			$where = '';
			$orderby = ' order by cd_pergunta_perfil_comp asc';

			if (!empty($alternativaperfilcomp->getAlternativa_perfil_comp())){
				if (empty($where)){
					$where = ' where cd_alternativa_perfil_comp = :cd_alternativa_perfil_comp';
				}else{
					$where = $where . ' and cd_alternativa_perfil_comp = :cd_alternativa_perfil_comp';
				}
			}

			if (!empty($alternativaperfilcomp->getDs_resposta())){
				if (empty($where)){
					$where = ' where ds_resposta like :descricao';
				}else{
					$where = $where . ' and ds_resposta like :descricao';
				}
			}

			$stmt = db::getInstance()->prepare($comando . $where . $orderby);
			if (!empty($alternativaperfilcomp->getAlternativa_perfil_comp()))
				$stmt->bindValue(':cd_pergunta_perfil_comp', $alternativaperfilcomp->getAlternativa_perfil_comp());
			if (!empty($alternativaperfilcomp->getDs_resposta()))
				$stmt->bindValue(':descricao', '%'.$alternativaperfilcomp->getDs_resposta().'%');

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