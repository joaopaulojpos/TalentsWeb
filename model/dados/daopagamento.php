<?php
require_once('../../model/basica/pagamento.php');

class DaoPagamento
{

	public function cadastrar(Pagamento $p){
		$request = new RequestMethods();

		return $request->post($request::$url.'/pagamento', 
			array( 'cd_empresa' => $p->getCdEmpresa(),
				   'token' => $emp->getToken(), 
				   'vl_recarga' => $emp->getVlRecarga());
	}

	public function finalizar(Pagamento $p){
		$request = new RequestMethods();

		return $request->post($request::$url.'/pagamento', 
			array( 'cd_empresa' => $p->getCdEmpresa(),
				   'token' => $emp->getToken(), 
				   'tp_status' => $emp->getTpStatus());
	}

}
?>