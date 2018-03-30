<?php

require_once('../src/model/dados/idaocompetenciacomport.php');

class DAOCompetenciaComport implements iDAOCompetenciaComport
{	
	function __construct(){
		
	}

	public function pesquisar(CompetenciaComport $cc, $alt='false'){
    try{
  		$comando = "select cd_competencia_comport, ds_competencia_comport, cc.cd_tipo_competencia_comport, ds_tipo_competencia_comport
                    from competencia_comport cc
              inner join tipo_competencia_comport tct on (tct.cd_tipo_competencia_comport = cc.cd_tipo_competencia_comport) ";
  		$where = '';
      $orderby = ' order by ds_competencia_comport asc, ds_tipo_competencia_comport asc ';

  		if (!empty($cc->getCdCompetenciaComport())){
  			if (empty($where)){
  				$where = ' where cd_competencia_comport = :cd_competencia_comport';
  			}else{
  				$where = $where . ' and cd_competencia_comport = :cd_competencia_comport';
  			}
  		}
  		
  		if (!empty($cc->getDsCompetenciaComport())){
  			if (empty($where)){
  				$where = ' where ds_competencia_comport like :ds_competencia_comport';
  			}else{
  				$where = $where . ' and ds_competencia_comport like :ds_competencia_comport';
  			}
  		}

  		$stmt = db::getInstance()->prepare($comando . $where . $orderby);
  		if (!empty($cc->getCdCompetenciaComport()))
  			$stmt->bindValue(':cd_competencia_comport', $cc->getCdCompetenciaComport());
  		if (!empty($cc->getDsCompetenciaComport()))
  			$stmt->bindValue(':ds_competencia_comport', '%'.$cc->getDsCompetenciaComport().'%');

  		$run = $stmt->execute();

  		return ($stmt->fetchAll(PDO::FETCH_ASSOC));

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
    public function listarCompetenciasComportVaga($cod_vaga)
    {
      try{

        $sql = 'select cc.ds_competencia_comport,vct.cd_competencia_comport 
                  from vaga_competencia_comport vct
            inner join vaga v ON vct.cd_vaga = v.cd_vaga
            inner join competencia_comport cc ON cc.cd_competencia_comport = vct.cd_competencia_comport 
                 where vct.cd_vaga = :cod_vaga;';

        $stmt = db::getInstance()->prepare($sql);

        if (!empty($cod_vaga)) {
            $stmt->bindValue(':cod_vaga', $cod_vaga);
        }

        $run = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listaCc = new ArrayObject();
  
        foreach ($result as $row){
            $cc = new CompetenciaComport();
            //$cc->setNrNivel($row['nr_nivel']);
            $cc->setCdCompetenciaComport($row['cd_competencia_comport']);
            $cc->setDsCompetenciaComport($row['ds_competencia_comport']);
            $listaCc->append($cc);
        }
        return $listaCc;

      }catch(Exception $e){
        throw new Exception($e->getMessage());
      }finally{
        $stmt->closeCursor();
      }
    }


    public function inserirCompetenciaComportVaga($cd_vaga, CompetenciaComport $cc){
      try{
        $sql = "insert into vaga_competencia_comport (cd_vaga, cd_competencia_comport) values (:cd_vaga,:cd_competencia_comport);";

        $stmt = db::getInstance()->prepare($sql);
        $run = $stmt->execute(array(
            ':cd_vaga' => $cd_vaga,
            ':cd_competencia_comport' => $cc->getCdCompetenciaComport()
        ));

        return array($run);

      }catch(Exception $e){
        throw new Exception($e->getMessage());
      }finally{
        $stmt->closeCursor();
      }
    }
}
?>