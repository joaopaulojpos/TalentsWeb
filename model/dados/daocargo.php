<?php
require_once('../../model/basica/cargo.php');

class DaoCargo
{

	public function pesquisar(Cargo $cargo){
		$request = new RequestMethods();
		return $request->get($request::$url.'/cargos');
	}
}
?>