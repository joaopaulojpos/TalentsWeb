<?php

require_once('../src/model/dados/idaoidioma.php');

class DaoIdioma implements iDaoIdioma
{	
	function __construct(){
		
	}

	public function pesquisar(Idioma $idioma, $alt='false'){
		$comando = 'select * from idioma ';
		$where = '';

		if (!empty($idioma->getCdIdioma())){
			if (empty($where)){
				$where = ' where cd_idioma = :cd_idioma';
			}else{
				$where = $where . ' and cd_idioma = :cd_idioma';
			}
		}

		
		if (!empty($idioma->getDsIdioma())){
			if (empty($where)){
				$where = ' where ds_idioma like :descricao';
			}else{
				$where = $where . ' and ds_idioma like :descricao';
			}
		}

		
		$db = new db();
		$stmt = db::getInstance()->prepare($comando . $where);
		if (!empty($idioma->getCdIdioma()))
			$stmt->bindValue(':cd_idioma', $idioma->getCdIdioma());
		if (!empty($idioma->getDsIdioma()))
			$stmt->bindValue(':descricao', '%'.$idioma->getDsIdioma().'%');

		$run = $stmt->execute();

		return ($stmt->fetchAll(PDO::FETCH_ASSOC));
	}
}
?>