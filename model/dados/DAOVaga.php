<?php
require_once('RequestMethods.php');

class DAOVaga
{

	public function publicar(Vaga $vaga){
		try{
			$request = new RequestMethods();

	        return $request->post('http://localhost/talentsweb/api/public/api/vaga/publicar',
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
				'cd_empresa' => $vaga->getEmpresa()->getCdEmpresa(),
				'idiomas'=>json_encode($vaga->getIdiomas()),
				'competencias_tecnicas'=>json_encode($vaga->getCompetenciasTecnicas()),
				'competencias_comport'=>json_encode($vaga->getCompetenciasComport()),
				'cursos'=>json_encode($vaga->getCursos())));
    	}catch(Exception $e){
            return array('erro' => 'Erro publicação da vaga' );
        }

	}
	public function pesquisar(){
        $request = new RequestMethods();

        return $request->get("http://localhost/talentsweb/api/public/api/vagas",array());
    }
}
?>