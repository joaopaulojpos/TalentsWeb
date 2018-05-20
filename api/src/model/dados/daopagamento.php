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
			$comando = "update pagamento set tp_status = :tp_status, payerid = :payerid, where token = :token";
			$stmt = db::getInstance()->prepare($comando);

			$stmt->bindValue(':tp_status', 'A');
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