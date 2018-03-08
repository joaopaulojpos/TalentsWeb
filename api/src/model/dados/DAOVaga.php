<?php
require_once('../src/model/basica/vaga.php');
require_once('iDAOVaga.php');
require_once('../src/config/db.php');

class DaoVaga implements iDAOVaga
{
    function __construct(){}

    public function publicar(vaga $vaga){
        $sql = "insert into vaga (cd_vaga,nr_qtd_vaga,ds_observacao,dt_validade,tp_contratacao,nr_longitude,nr_latitude,ds_beneficios,ds_horario_expediente,dt_criacao,ds_titulo,vl_salario,cd_cargo,cd_empresa)
values (:cd_vaga,:nr_qtd_vaga,:ds_observacao,:dt_validade,:tp_contratacao,:nr_longitude,:nr_latitude,:ds_beneficios,:ds_horario_expediente,:dt_criacao,:ds_titulo,:vl_salario,:cd_cargo,:cd_empresa);";
        $stmt = db::getInstance()->prepare($sql);
        $run = $stmt->execute(array(
				':cd_vaga' => $vaga->getCdVaga(),
                ':nr_qtd_vaga' => $vaga->getNrQtdVaga(),
                ':ds_observacao' => $vaga->getDsObservacao(),
                ':dt_validade' => $vaga->getDtValidade(),
                ':tp_contratacao' => $vaga->getTpContratacao(),
                ':nr_longitude' => $vaga->getNrLongitude(),
                ':nr_latitude' => $vaga->getNrLatitude(),
                ':ds_beneficios' => $vaga->getDsBeneficios(),
                ':ds_horario_expediente' => $vaga->getDsHorarioExpediente(),
                ':dt_criacao' => $vaga->getDtCriacao(),
                ':ds_titulo' => $vaga->getDsTitulo(),
                ':vl_salario' => $vaga->getVlSalario(),
                ':cd_cargo' => $vaga->getCargo()->getCdCargo(),
                ':cd_empresa' => $vaga->getEmpresa()->getCdEmpresa()
        ));
    }

    public function pesquisar(Vaga $vaga, $alt='false'){

        $sql = 'select * from empresa ';
		
		$db = new db();
		$stmt = db::getInstance()->prepare($sql);
		
		$run = $stmt->execute();

		return ($stmt->fetchAll(PDO::FETCH_ASSOC));
	}
}

 ?>