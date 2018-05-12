<?php
require_once('../../model/basica/competenciacomport.php');

class DAOCompetenciaComport
{

	public function pesquisar(CompetenciaComport $ct){
		$request = new RequestMethods();
		return $request->get($request::$url.'/competencias_comport');
	}
}
?>