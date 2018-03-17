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

    /**
     * @param $cod_vaga
     * @return ArrayObject
     */
    public function listarCursoVaga($cod_vaga)
    {

        $sql = 'select curso.ds_curso,vc.cd_curso,vc.ds_instituicao from vaga_curso AS vc
                      JOIN vaga ON vc.cd_vaga = vaga.cd_vaga
                      JOIN curso ON curso.cd_curso = vc.cd_curso 
                      where vc.cd_vaga = :cod_vaga;';

        $db = new db();
        $stmt = db::getInstance()->prepare($sql);

        if (!empty($cod_vaga))
            $stmt->bindValue(':cod_vaga', $cod_vaga);

        $run = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listaCurso = new ArrayObject();
        foreach ($result as $row){
            $curso = new curso();
            $curso->setDsInstituicao($row['ds_instituicao']);
            $curso->setCdCurso($row['cd_curso']);
            $curso->setDsCurso($row['ds_curso']);
            $listaCurso->append($curso);
        }
        return $listaCurso;
    }
}
?>