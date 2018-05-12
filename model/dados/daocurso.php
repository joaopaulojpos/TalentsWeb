<?php
require_once('../../model/basica/curso.php');

class DaoCurso
{

	public function pesquisar(Curso $curso){
		$request = new RequestMethods();
		return $request->get($request::$url.'/cursos');
	}

}
?>