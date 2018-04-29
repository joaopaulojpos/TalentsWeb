<?php

require_once('../src/model/dados/idaocurso.php');

class DaoCurso implements iDAOCurso
{	
	function __construct(){
		
	}

	public function pesquisar(Curso $curso, $alt='false'){
    try{
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

  		$stmt = db::getInstance()->prepare($comando . $where . $orderby);
  		if (!empty($curso->getCdCurso()))
  			$stmt->bindValue(':cd_curso', $curso->getCdCurso());
  		if (!empty($curso->getDsCurso()))
  			$stmt->bindValue(':descricao', '%'.$curso->getDsCurso().'%');

  		$run = $stmt->execute();

  		return ($stmt->fetchAll(PDO::FETCH_ASSOC));

    }catch(Exception $e){
      throw new Exception($e->getMessage());
    }finally{
      $stmt->closeCursor();
    }
	}

    /**
     * @param $cd_profissional
     * @return ArrayObject
     */
    public function listarCursoProfissional($cd_profissional)
    {
      try{
        $sql = 'select pc.cd_curso, c.ds_curso
                  from profissional_curso pc
             left join curso c on c.cd_curso = pc.cd_curso
                  where pc.cd_profissional = :cd_profissional';

        $stmt = db::getInstance()->prepare($sql);

        if (!empty($cd_profissional))
            $stmt->bindValue(':cd_profissional', $cd_profissional);

        $run = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listaCurso = new ArrayObject();

        foreach ($result as $row){
            $curso = new curso();
            $curso->setCdCurso($row['cd_curso']);
            $curso->setDsCurso($row['ds_curso']);
            $listaCurso->append($curso);
        }
        return $listaCurso;

      }catch(Exception $e){
        throw new Exception($e->getMessage());
      }finally{
        $stmt->closeCursor();
      }
    }

    /**
     * @param $cod_vaga
     * @return ArrayObject
     */
    public function listarCursoVaga($cod_vaga)
    {
      try{
        $sql = 'select curso.ds_curso,vc.cd_curso, formacao.ds_formacao 
                  from vaga_curso AS vc
            inner join vaga ON vc.cd_vaga = vaga.cd_vaga
            inner join curso ON curso.cd_curso = vc.cd_curso
            inner join formacao on formacao.cd_formacao = curso.cd_formacao
                 where vc.cd_vaga = :cod_vaga;';

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

      }catch(Exception $e){
        throw new Exception($e->getMessage());
      }finally{
        $stmt->closeCursor();
      }
    }

    public function inserirCursoVaga($cd_vaga, Curso $curso){
      try{
        $sql = "insert into vaga_curso (cd_curso,cd_vaga) values (:cd_curso,:cd_vaga);";

        $stmt = db::getInstance()->prepare($sql);
        $run = $stmt->execute(array(
            ':cd_curso' => $curso->getCdCurso(),
            ':cd_vaga' => $cd_vaga
        ));

        return array($run);

      }catch(Exception $e){
        throw new Exception($e->getMessage());
      }finally{
        $stmt->closeCursor();
      }
    }

    public function cursoProfissional($cd_profissional,$cursos)
    {
        foreach ($cursos as $curso){
            $this->inserirCursoProfissional($cd_profissional, $curso['cd_curso'], $curso['ds_instituicao'], $curso['dt_fim'], $curso['dt_inicio'], $curso['nr_certificado'], $curso['tp_certificado_validado'], $curso['nr_periodo']);
        }
    }

    private function inserirCursoProfissional($cd_profissional, $cd_curso, $ds_instituicao, $dt_fim, $dt_inicio, $nr_certificado, $tp_certificado_validado, $nr_periodo)
    {
        try{
            $sql = "INSERT INTO profissional_curso
                    (cd_curso,
                    cd_profissional,
                    ds_instituicao,
                    dt_fim,
                    dt_inicio,
                    tp_certificado_validado,
                    nr_cerificado,
                    nr_periodo)
                    VALUES
                    (:cd_curso,
                    :cd_profissional,
                    :ds_instituicao,
                    :dt_fim,
                    :dt_inicio,
                    :tp_certificado_validado,
                    :nr_cerificado,
                    :nr_periodo);";

            $stmt = db::getInstance()->prepare($sql);
            $run = $stmt->execute(array(
                ':cd_profissional' => $cd_profissional,
                ':cd_curso' => $cd_curso,
                ':ds_instituicao' => $ds_instituicao,
                ':dt_fim' => $dt_fim,
                ':dt_inicio' => $dt_inicio,
                ':nr_cerificado' => $nr_certificado,
                ':tp_certificado_validado' => $tp_certificado_validado,
                ':nr_periodo' => $nr_periodo
            ));

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }
}
?>