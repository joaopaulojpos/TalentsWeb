<?php

require_once('../src/model/dados/idaocargo.php');

class DaoCargo implements iDAOCargo
{	
	function __construct(){
		
	}

	public function pesquisar(Cargo $cargo, $alt='false'){
		try{
			$comando = 'select * from cargo ';
			$where = '';
			$orderby = ' order by ds_cargo asc';

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

			$stmt = db::getInstance()->prepare($comando . $where . $orderby);
			if (!empty($cargo->getCdCargo()))
				$stmt->bindValue(':cd_cargo', $cargo->getCdCargo());
			if (!empty($cargo->getDsCargo()))
				$stmt->bindValue(':descricao', '%'.$cargo->getDsCargo().'%');

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
    public function listarCargoProfissional($cd_profissional)
    {
      try{
        $sql = 'select pc.cd_cargo, c.ds_cargo, pc.ds_empresa, pc.dt_inicio, pc.dt_fim
                  from profissional_cargo pc
             left join cargo c on c.cd_cargo = pc.cd_cargo
                 where pc.cd_profissional = :cd_profissional
              order by c.ds_cargo asc ';

        $stmt = db::getInstance()->prepare($sql);

        if (!empty($cd_profissional))
            $stmt->bindValue(':cd_profissional', $cd_profissional);

        $run = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listaCargo = new ArrayObject();

        foreach ($result as $row){
            $cargo = new Cargo();
            $cargo->setCdCargo($row['cd_cargo']);
            $cargo->setDsCargo($row['ds_cargo']);
            $cargo->setDsEmpresa($row['ds_empresa']);
            $cargo->setDtInicio($row['dt_inicio']);
            $cargo->setDtFim($row['dt_fim']);
            $listaCargo->append($cargo);
        }
        return $listaCargo;

      }catch(Exception $e){
        throw new Exception($e->getMessage());
      }finally{
        $stmt->closeCursor();
      }
    }
}
?>