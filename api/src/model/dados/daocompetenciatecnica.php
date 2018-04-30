<?php

require_once('../src/model/dados/idaocompetenciatecnica.php');

class DAOCompetenciaTecnica implements iDAOCompetenciaTecnica
{	
	function __construct(){
		
	}

	public function pesquisar(CompetenciaTecnica $ct, $alt='false'){
    try{
  		$comando = "select cd_competencia_tecnica, ds_competencia_tecnica, ct.cd_tipo_competencia_tecnica, ds_tipo_competencia_tecnica
                    from competencia_tecnica ct
              inner join tipo_competencia_tecnica tct on (tct.cd_tipo_competencia_tecnica = ct.cd_tipo_competencia_tecnica) ";
  		$where = '';
          $orderby = ' order by ds_competencia_tecnica asc, ds_tipo_competencia_tecnica asc ';

  		if (!empty($ct->getCdCompetenciaTecnica())){
  			if (empty($where)){
  				$where = ' where cd_competencia_tecnica = :cd_competencia_tecnica';
  			}else{
  				$where = $where . ' and cd_competencia_tecnica = :cd_competencia_tecnica';
  			}
  		}

  		
  		if (!empty($ct->getDsCompetenciaTecnica())){
  			if (empty($where)){
  				$where = ' where ds_competencia_tecnica like :ds_competencia_tecnica';
  			}else{
  				$where = $where . ' and ds_competencia_tecnica like :ds_competencia_tecnica';
  			}
  		}

  		$stmt = db::getInstance()->prepare($comando . $where . $orderby);
  		if (!empty($ct->getCdCompetenciaTecnica()))
  			$stmt->bindValue(':cd_competencia_tecnica', $ct->getCdCompetenciaTecnica());
  		if (!empty($ct->getDsCompetenciaTecnica()))
  			$stmt->bindValue(':ds_competencia_tecnica', '%'.$ct->getDsCompetenciaTecnica().'%');

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
    public function listarCompetenciasComportProfissional($cd_profissional)
    {
      try{
        $sql = 'select pct.cd_competencia_tecnica, ct.ds_competencia_tecnica, pct.nr_nivel
                  from profissional_competencia_tecnica pct
             left join competencia_tecnica ct on ct.cd_competencia_tecnica = pct.cd_competencia_tecnica
                 where pct.cd_profissional = :cd_profissional
              order by ct.ds_competencia_tecnica ';

        $stmt = db::getInstance()->prepare($sql);

        if (!empty($cd_profissional))
            $stmt->bindValue(':cd_profissional', $cd_profissional);

        $run = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listaCt = new ArrayObject();

        foreach ($result as $row){
            $ct = new CompetenciaTecnica();
            $ct->setNrNivel($row['nr_nivel']);
            $ct->setCdCompetenciaTecnica($row['cd_competencia_tecnica']);
            $ct->setDsCompetenciaTecnica($row['ds_competencia_tecnica']);
            $listaCt->append($ct);
        }

        return $listaCt;
        
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
    public function listarCompetenciasTecnicaVaga($cod_vaga)
    {
      try{
        $sql = 'select ct.ds_competencia_tecnica,vct.cd_competencia_tecnica,vct.nr_nivel 
                  from vaga_competencia_tecnica vct
            inner join vaga v ON vct.cd_vaga = v.cd_vaga
            inner join competencia_tecnica ct ON ct.cd_competencia_tecnica = vct.cd_competencia_tecnica 
                 where vct.cd_vaga = :cod_vaga;';

        $stmt = db::getInstance()->prepare($sql);

        if (!empty($cod_vaga)) {
            $stmt->bindValue(':cod_vaga', $cod_vaga);
        }

        $run = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listaCt = new ArrayObject();

        foreach ($result as $row){
            $ct = new CompetenciaTecnica();
            $ct->setNrNivel($row['nr_nivel']);
            $ct->setCdCompetenciaTecnica($row['cd_competencia_tecnica']);
            $ct->setDsCompetenciaTecnica($row['ds_competencia_tecnica']);
            $listaCt->append($ct);
        }

        return $listaCt;

      }catch(Exception $e){
        throw new Exception($e->getMessage());
      }finally{
        $stmt->closeCursor();
      }
    }


    public function inserirCompetenciaTecnicaVaga($cd_vaga, CompetenciaTecnica $ct){
      try{
        $sql = "insert into vaga_competencia_tecnica (cd_vaga, cd_competencia_tecnica, nr_nivel) values (:cd_vaga,:cd_competencia_tecnica,:nr_nivel);";

        $stmt = db::getInstance()->prepare($sql);
        $run = $stmt->execute(array(
            ':cd_vaga' => $cd_vaga,
            ':cd_competencia_tecnica' => $ct->getCdCompetenciaTecnica(),
            ':nr_nivel' => $ct->getNrNivel()
        ));

        return array($run);

      }catch(Exception $e){
        throw new Exception($e->getMessage());
      }finally{
        $stmt->closeCursor();
      }
    }

    public function inserirCompetenciaTecnicaProfissional($cd_profissional,$competencias){

        foreach ($competencias as $competencia){
            $this->competenciaTecnicaProfissional($cd_profissional,$competencia['cd_competencia_tecnica'],$competencia['nr_nivel']);
        }
    }

    private function competenciaTecnicaProfissional($cd_profissional,$cd_competencia_tecnica,$nr_nivel)
    {
        try{
            $sql = "insert into profissional_competencia_tecnica (cd_profissional,cd_competencia_tecnica,nr_nivel) 
                         values (:cd_profissional,:cd_competencia_tecnica,:nr_nivel);";

            $stmt = db::getInstance()->prepare($sql);
            $run = $stmt->execute(array(
                ':cd_profissional' => $cd_profissional,
                ':cd_competencia_tecnica' => $cd_competencia_tecnica,
                ':nr_nivel' => $nr_nivel
            ));

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }
}
?>