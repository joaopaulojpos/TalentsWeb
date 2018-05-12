<?php
require_once('../../model/basica/idioma.php');

class DaoIdioma
{

	public function pesquisar(Idioma $idioma){
		$request = new RequestMethods();
		return $request->get($request::$url.'/idiomas');
	}
}
?>