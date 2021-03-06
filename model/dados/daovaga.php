<?php
require_once('requestmethods.php');

class DAOVaga
{

	public function publicar($cd_vaga){
		try{
            $request = new RequestMethods();

            return $request->post($request::$url.'/vaga/publicar',
                array( 
                'cd_vaga' => $cd_vaga));
        }catch(Exception $e){
            return array('erro' => 'Erro ao publicar vaga!' );
        }
	}

    public function salvar(Vaga $vaga){
        try{
            $request = new RequestMethods();

            return $request->post($request::$url.'/vaga/salvar',
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
                'ds_endereco' => $vaga->getDsEndereco(),
                'tp_status'=>$vaga->getTpStatus(),
                'ds_segunda_etapa'=>$vaga->getDsSegundaEtapa(),
                'cd_cargo' => $vaga->getCargo()->getCdCargo(),
                'cd_empresa' => $vaga->getEmpresa()->getCdEmpresa(),
                'idiomas'=>json_encode($vaga->getIdiomas()),
                'competencias_tecnicas'=>json_encode($vaga->getCompetenciasTecnicas()),
                'competencias_comport'=>json_encode($vaga->getCompetenciasComport()),
                'cursos'=>json_encode($vaga->getCursos())));
        }catch(Exception $e){
            return array('erro' => 'Erro ao salvar vaga!' );
        }
    }

    public function fechar($cd_vaga){
        try{
            $request = new RequestMethods();

            return $request->post($request::$url.'/vaga/fechar',
                array( 
                'cd_vaga' => $cd_vaga));
        }catch(Exception $e){
            return array('erro' => 'Erro ao fechar vaga!' );
        }
    }

	public function pesquisar(){
        $request = new RequestMethods();

        return $request->get($request::$url.'/vagas',array());
    }

    public function pesquisarVaga($cd_vaga){
        $request = new RequestMethods();

        return $request->get($request::$url.'/vaga/buscar/'.$cd_vaga,array());
    }

    public function listarProfissionaisVaga($cd_vaga){
    	$request = new RequestMethods();
    	
    	return $request->get($request::$url.'/vaga/'.$cd_vaga.'/profissionais',array());
    }

    public function likeProfissionalVaga($cd_vaga, $cd_profissional){
    	try{
    	$request = new RequestMethods();
    	
    	return $request->post($request::$url.'/vaga/like/profissional',
    		array(
    		'cd_vaga' => $cd_vaga,
    		'cd_profissional' => $cd_profissional));
    	}catch(Exception $e){
            return array('erro' => 'Erro publicação da vaga' );
        }
        
    }
}
?>