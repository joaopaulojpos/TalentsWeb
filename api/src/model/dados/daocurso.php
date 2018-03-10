<?php

require_once('../src/model/dados/idaocurso.php');

class DaoCurso implements iDAOCurso
{	
	function __construct(){
		
	}

	public function pesquisar(Curso $curso, $alt='false'){
		$comando = 'select * from curso ';
		$where = '';

		if (!empty($curso->getCdCurso())){
			if (empty($where)){
				$where = ' where cd_curso = :cd_curso';
			}else{
				$where = $where . ' and cd_curso = :cd_curso';
			}
		}

		
		if (!empty($curso->getDsCurso())){
			if (empty($where)){
				$where = ' where ds_curso like :descricao';
			}else{
				$where = $where . ' and ds_curso like :descricao';
			}
		}

		
		$db = new db();
		$stmt = db::getInstance()->prepare($comando . $where);
		if (!empty($curso->getCdCurso()))
			$stmt->bindValue(':cd_curso', $curso->getCdCurso());
		if (!empty($curso->getDsCurso()))
			$stmt->bindValue(':descricao', '%'.$curso->getDsCurso().'%');

		$run = $stmt->execute();

		return ($stmt->fetchAll(PDO::FETCH_ASSOC));
	}
}
?>