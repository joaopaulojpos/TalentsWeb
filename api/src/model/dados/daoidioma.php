<?php

require_once('../src/model/dados/idaoidioma.php');

class DaoIdioma implements iDAOIdioma
{	
	function __construct(){
		
	}

	public function pesquisar(Idioma $idioma, $alt='false'){
    try{
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

  		$stmt = db::getInstance()->prepare($comando . $where);
  		if (!empty($idioma->getCdIdioma()))
  			$stmt->bindValue(':cd_idioma', $idioma->getCdIdioma());
  		if (!empty($idioma->getDsIdioma()))
  			$stmt->bindValue(':descricao', '%'.$idioma->getDsIdioma().'%');

  		$run = $stmt->execute();

  		return ($stmt->fetchAll(PDO::FETCH_ASSOC));

    }catch(Exception $e){
      throw new Exception($e->getMessage());
    }finally{
      $stmt->closeCursor();
    }
	}

    /**
     * @param $cd_vaga
     * @param Idioma $idioma
     * @return array
     */
    public function inserirIdiomaVaga($cd_vaga, Idioma $idioma){
      try{
        $sql = "insert into vaga_idioma (nr_nivel,cd_idioma,cd_vaga) values (:nr_nivel,:cd_idioma,:cd_vaga);";

        $stmt = db::getInstance()->prepare($sql);
        $run = $stmt->execute(array(
            ':nr_nivel' => $idioma->getNrNivel(),
            ':cd_idioma' => $idioma->getCdIdioma(),
            ':cd_vaga' => $cd_vaga
        ));

        return array($run);

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
    public function listarIdiomaProfissional($cd_profissional)
    {
      try{
        $sql = 'select pi.cd_idioma, i.ds_idioma, pi.nr_nivel
                  from profissional_idioma pi
             left join idioma i on i.cd_idioma = pi.cd_idioma
                 where pi.cd_profissional = :cd_profissional
              order by i.ds_idioma asc '; 

        $stmt = db::getInstance()->prepare($sql);

        if (!empty($cd_profissional))
            $stmt->bindValue(':cd_profissional', $cd_profissional);

        $run = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listaIdioma = new ArrayObject();

        foreach ($result as $row){
            $idioma = new idioma();
            $idioma->setNrNivel($row['nr_nivel']);
            $idioma->setCdIdioma($row['cd_idioma']);
            $idioma->setDsIdioma($row['ds_idioma']);
            $listaIdioma->append($idioma);
        }

        return $listaIdioma;
        
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
    public function listarIdiomaVaga($cod_vaga)
    {
      try{
        $sql = 'select idioma.ds_idioma,vi.cd_idioma,vi.nr_nivel 
                  from vaga_idioma AS vi
            inner join vaga ON vi.cd_vaga = vaga.cd_vaga
            inner join idioma ON idioma.cd_idioma = vi.cd_idioma 
                 where vi.cd_vaga = :cod_vaga;';

        $stmt = db::getInstance()->prepare($sql);

        if (!empty($cod_vaga))
            $stmt->bindValue(':cod_vaga', $cod_vaga);

        $run = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listaIdioma = new ArrayObject();

        foreach ($result as $row){
            $idioma = new idioma();
            $idioma->setNrNivel($row['nr_nivel']);
            $idioma->setCdIdioma($row['cd_idioma']);
            $idioma->setDsIdioma($row['ds_idioma']);
            $listaIdioma->append($idioma);
        }

        return $listaIdioma;
        
      }catch(Exception $e){
        throw new Exception($e->getMessage());
      }finally{
        $stmt->closeCursor();
      }
    }

    public function inserirIdiomaProfissional($cd_profissional,$cd_idioma,$nr_nivel)
    {
        try{
            $sql = "insert into profissional_idioma (cd_profissional,cd_idioma,nr_nivel) 
                         values (:cd_profissional,:cd_idioma,:nr_nivel);";

            $stmt = db::getInstance()->prepare($sql);
            $run = $stmt->execute(array(
                ':cd_profissional' => $cd_profissional,
                ':cd_idioma' => $cd_idioma,
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