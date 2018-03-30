<?php

require_once('../src/model/dados/idaocurso.php');

class DaoCurso implements iDAOCurso
{	
	function __construct(){
		
	}

	public function pesquisar(Curso $curso, $alt='false'){
		$comando = 'select cd_curso, ds_curso, f.ds_formacao from curso c inner join formacao f on (f.cd_formacao = c.cd_formacao) ';
		$where = '';
        $orderby = ' order by ds_formacao asc, ds_curso asc ';

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
		$stmt = db::getInstance()->prepare($comando . $where . $orderby);
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

        $sql = 'select curso.ds_curso,vc.cd_curso, formacao.ds_formacao 
                  from vaga_curso AS vc
                  JOIN vaga ON vc.cd_vaga = vaga.cd_vaga
                  JOIN curso ON curso.cd_curso = vc.cd_curso
                  JOIN formacao on formacao.cd_formacao = curso.cd_formacao
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
            $curso->setCdCurso($row['cd_curso']);
            $curso->setDsCurso($row['ds_curso']);
            $curso->setFormacao($row['ds_formacao']);
            $listaCurso->append($curso);
        }
        return $listaCurso;
    }

    public function inserirCursoVaga($cd_vaga, Curso $curso){
        $sql = "insert into vaga_curso (cd_curso,cd_vaga) values (:cd_curso,:cd_vaga);";

        var_dump($curso);

        $stmt = db::getInstance()->prepare($sql);
        $run = $stmt->execute(array(
            ':cd_curso' => $curso->getCdCurso(),
            ':cd_vaga' => $cd_vaga
        ));

        return array($run);

    }
}
?>