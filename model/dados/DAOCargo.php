<?php
require_once('../../model/basica/cargo.php');

class DaoCargo
{

	public function pesquisar(Cargo $cargo){
		//return $this->get('https://jpo1994.000webhostapp.com/api/public/api/cargos');
		return $this->get('http://localhost/talentsweb/api/public/api/cargos');
	}

	public function get($url){

		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
		$result = curl_exec($ch); 

		if(curl_errno($ch) !== 0) { 
			return json_encode('Erro: não foi possível conectar ao servidor!'); 
		} 
		curl_close($ch); 
		return $result; 
	}
}
?>