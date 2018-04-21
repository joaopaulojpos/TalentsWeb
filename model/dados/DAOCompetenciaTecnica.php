<?php
require_once('../../model/basica/competenciatecnica.php');

class DAOCompetenciaTecnica
{

	public function pesquisar(CompetenciaTecnica $ct){
		$request = new RequestMethods();
		return $request->get($request::$url.'/competencias_tecnicas');
	}
}
?>