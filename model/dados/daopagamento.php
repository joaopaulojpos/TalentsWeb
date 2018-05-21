<?php
require_once('../../model/basica/pagamento.php');

class DaoPagamento
{

	public function cadastrar(Pagamento $p){
		$request = new RequestMethods();

		return $request->post($request::$url.'/pagamento', 
			array( 'cd_empresa' => $p->getCdEmpresa(),
				   'token' => $p->getToken(), 
				   'vl_recarga' => $p->getVlRecarga()));
	}

	public function finalizar(Pagamento $p){
		$request = new RequestMethods();

		return $request->post($request::$url.'/pagamento/finalizar', 
			array( 'cd_empresa' => $p->getCdEmpresa(),
				   'token' => $p->getToken(), 
				   'tp_status' => $p->getTpStatus(),
				   'payerid' => $p->getPayerId()));
	}

}
?>