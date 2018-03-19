<?php

require_once('../src/model/dados/idaohabilidade.php');

class DaoHabilidade implements iDaoHabilidade
{	
	function __construct(){
		
	}

	public function pesquisar(Habilidade $habilidade, $alt='false'){
		$comando = "select cd_habilidade, ds_habilidade, h.cd_tipo_habilidade, ds_tipo_habilidade
                   from habilidade h
                   inner join tipo_habilidade th on (th.cd_tipo_habilidade = h.cd_tipo_habilidade) ";
		$where = '';
        $orderby = ' order by cd_tipo_habilidade asc, ds_habilidade asc ';

		if (!empty($habilidade->getCdHabilidade())){
			if (empty($where)){
				$where = ' where cd_habilidade = :cd_habilidade';
			}else{
				$where = $where . ' and cd_habilidade = :cd_habilidade';
			}
		}

		
		if (!empty($habilidade->getDsHabilidade())){
			if (empty($where)){
				$where = ' where ds_habilidade like :descricao';
			}else{
				$where = $where . ' and ds_habilidade like :descricao';
			}
		}

		$db = new db();
		$stmt = db::getInstance()->prepare($comando . $where . $orderby);
		if (!empty($habilidade->getCdHabilidade()))
			$stmt->bindValue(':cd_habilidade', $habilidade->getCdHabilidade());
		if (!empty($habilidade->getDsHabilidade()))
			$stmt->bindValue(':descricao', '%'.$habilidade->getDsHabilidade().'%');

		$run = $stmt->execute();

		return ($stmt->fetchAll(PDO::FETCH_ASSOC));
	}

    /**
     * @param $cod_vaga
     * @return ArrayObject
     */
    public function listarHabilidadeVaga($cod_vaga)
    {

        $sql = 'select habilidade.ds_habilidade,vh.cd_habilidade,vh.nr_nivel from vaga_habilidade AS vh
                      JOIN vaga ON vh.cd_vaga = vaga.cd_vaga
                      JOIN habilidade ON habilidade.cd_habilidade = vh.cd_habilidade 
                      where vh.cd_vaga = :cod_vaga;';

        $db = new db();
        $stmt = db::getInstance()->prepare($sql);

        if (!empty($cod_vaga)) {

            $stmt->bindValue(':cod_vaga', $cod_vaga);

        }
        $run = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listaHab = new ArrayObject();

        foreach ($result as $row){

            $hab = new habilidade();
            $hab->setNrNivel($row['nr_nivel']);
            $hab->setCdHabilidade($row['cd_habilidade']);
            $hab->setDsHabilidade($row['ds_habilidade']);
            $listaHab->append($hab);

        }

        return $listaHab;

    }


    public function inserirHabilidadeVaga($cd_vaga, Habilidade $habilidade){
        $sql = "insert into vaga_habilidade (nr_nivel,cd_habilidade,cd_vaga) values (:nr_nivel,:cd_habilidade,:cd_vaga);";

        $stmt = db::getInstance()->prepare($sql);
        $run = $stmt->execute(array(
            ':nr_nivel' => $habilidade->getNrNivel(),
            ':cd_habilidade' => $habilidade->getCdHabilidade(),
            ':cd_vaga' => $cd_vaga
        ));

        return array($run);

    }
}
?>