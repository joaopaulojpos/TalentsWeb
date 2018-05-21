<?php

require_once('../src/model/dados/idaopagamento.php');

class DaoPagamento implements iDAOPagamento
{	
	function __construct(){
	}

	public function cadastrar(Pagamento $p){
		try{
			$comando = "insert into pagamento (cd_empresa, vl_recarga, dt_recarga, token, payerid, tp_status) 
							 values (:cd_empresa, :vl_recarga, :dt_recarga, :token, :payerid, :tp_status)";
			$stmt = db::getInstance()->prepare($comando);

			$stmt->bindValue(':cd_empresa', $p->getCdEmpresa());
			$stmt->bindValue(':vl_recarga', $p->getVlRecarga());
			$stmt->bindValue(':dt_recarga', $p->getDtRecarga());
			$stmt->bindValue(':token', $p->getToken());
			$stmt->bindValue(':payerid', $p->getPayerId());
			$stmt->bindValue(':tp_status', $p->getTpStatus());

			$run = $stmt->execute();

		}catch(Exception $e){
			throw new Exception($e->getMessage());
		}finally{
			$stmt->closeCursor();
		}
	}

	public function finalizar(Pagamento $p){
		try{
			$comando = "update empresa set vl_saldo = vl_saldo + (select distinct vl_recarga from pagamento where token = :token and tp_status = 'F') where cd_empresa = (select distinct cd_empresa from pagamento where token = :token and tp_status = 'F') ";
			$stmt = db::getInstance()->prepare($comando);

			$stmt->bindValue(':token', $p->getToken());
			$run = $stmt->execute();

			$stmt->closeCursor();

			$comando = "update pagamento set tp_status = :tp_status, payerid = :payerid where token = :token";
			$stmt = db::getInstance()->prepare($comando);

			$stmt->bindValue(':tp_status', $p->getTpStatus());
			$stmt->bindValue(':payerid', $p->getPayerId());

			$stmt->bindValue(':token', $p->getToken());
			$run = $stmt->execute();
		
		}catch(Exception $e){
			throw new Exception($e->getMessage());
		}finally{
			$stmt->closeCursor();
		}
	}

}

?>