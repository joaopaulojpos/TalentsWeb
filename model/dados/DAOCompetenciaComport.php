<?php
require_once('../../model/basica/competenciacomport.php');

class DAOCompetenciaComport
{

	public function pesquisar(CompetenciaComport $ct){
		$request = new RequestMethods();
		return $request->get('http://localhost/talentsweb/api/public/api/competencias_comport');
	}
}
?>