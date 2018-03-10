<?php

require_once('../src/model/dados/idaocargo.php');

class DaoCargo implements iDAOCargo
{	
	function __construct(){
		
	}

	public function pesquisar(Cargo $cargo, $alt='false'){
		$comando = 'select * from cargo ';
		$where = '';

		if (!empty($cargo->getCdCargo())){
			if (empty($where)){
				$where = ' where cd_cargo = :cd_cargo';
			}else{
				$where = $where . ' and cd_cargo = :cd_cargo';
			}
		}

		
		if (!empty($cargo->getDsCargo())){
			if (empty($where)){
				$where = ' where ds_cargo like :descricao';
			}else{
				$where = $where . ' and ds_cargo like :descricao';
			}
		}

		
		$db = new db();
		$stmt = db::getInstance()->prepare($comando . $where);
		if (!empty($cargo->getCdCargo()))
			$stmt->bindValue(':cd_cargo', $cargo->getCdCargo());
		if (!empty($cargo->getDsCargo()))
			$stmt->bindValue(':descricao', '%'.$cargo->getDsCargo().'%');

		$run = $stmt->execute();

		return ($stmt->fetchAll(PDO::FETCH_ASSOC));
	}
}
?>