<?php
require_once('RequestMethods.php');

class DAOVaga
{
	public function publicar(Vaga $vaga){
		try{
        return $this->post('http://localhost/talentsweb/api/public/api/vaga/publicar',
			array( 
			'nr_qtd_vaga' => $vaga->getNrQtdVaga(),
			'ds_observacao' => $vaga->getDsObservacao(),
			'dt_validade' => $vaga->getDtValidade(),
			'tp_contratacao' => $vaga->getTpContratacao(),
			'nr_longitude' => $vaga->getNrLongitude(),
			'nr_latitude' => $vaga->getNrLatitude(),
			'ds_beneficios' => $vaga->getDsBeneficios(),
			'nr_experiencia' => $vaga->getNrExperiencia(),
			'ds_horario_expediente' => $vaga->getDsHorarioExpediente(),
			'dt_criacao' => $vaga->getDtCriacao(),
			'ds_titulo' => $vaga->getDsTitulo(),
			'vl_salario' => $vaga->getVlSalario(),
			'cd_cargo' => $vaga->getCargo()->getCdCargo(),
			'cd_empresa' => 1,
			'idiomas'=>json_encode($vaga->getIdiomas()),
			'habilidades'=>json_encode($vaga->getHabilidades()),
			'cursos'=>json_encode($vaga->getCursos())));
    	}catch(Exception $e){
            return array('erro' => 'Erro publicação da vaga' );
        }

	}
	public function pesquisar(){
	    //Classe padrão com as configurações para GET/POST
        $request = new RequestMethods();

        return $request->get("http://localhost/talentsweb/api/public/api/vagas",array());
    }

	public function post($url, $params){

		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, 
		http_build_query($params)); 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
		// This should be the default Content-type for POST requests 
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded")); 
		$result = curl_exec($ch); 

		if(curl_errno($ch) !== 0) { 
			return json_encode('Erro: não foi possível conectar ao servidor!'); 
		} 
		curl_close($ch); 
		return $result; 
	}
}
?>