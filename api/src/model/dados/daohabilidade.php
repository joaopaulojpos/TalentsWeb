<?php

require_once('../src/model/dados/idaohabilidade.php');

class DaoHabilidade implements iDaoHabilidade
{	
	function __construct(){
		
	}

	public function pesquisar(Habilidade $habilidade, $alt='false'){
		$comando = 'select * from habilidade ';
		$where = '';

		if (!empty($habilidade->getCdHabilidade())){
			if (empty($where)){
				$where = ' where cd_habilidade = :cd_habilidade';
			}else{
				$where = $where . ' and cd_habilidade = :cd_habilidade';
			}
		}

		
		if (!empty($habilidade->getDsHabilidade())){
			if (empty($where)){
				$where = ' where ds_habilidade like :descricao';
			}else{
				$where = $where . ' and ds_habilidade like :descricao';
			}
		}

		
		$db = new db();
		$stmt = db::getInstance()->prepare($comando . $where);
		if (!empty($habilidade->getCdHabilidade()))
			$stmt->bindValue(':cd_habilidade', $habilidade->getCdHabilidade());
		if (!empty($habilidade->getDsHabilidade()))
			$stmt->bindValue(':descricao', '%'.$habilidade->getDsHabilidade().'%');

		$run = $stmt->execute();

		return ($stmt->fetchAll(PDO::FETCH_ASSOC));
	}
}
?>