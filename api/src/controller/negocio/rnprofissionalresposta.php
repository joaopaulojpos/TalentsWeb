<?php

require_once('../src/model/dados/daoprofissionalresposta.php');

class RNprofissionalresposta{

	public function cadastrarResposta($profissionalresposta){	
		try{
			$daoProfissionalresposta = new DAOProfissionalresposta();
			$result = $daoProfissionalresposta->cadastrarResposta($profissionalresposta);

			return array('sucess' => 'Cadastrado com sucesso!');

		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}
	}


	public function salvar(Profissionalresposta $profissionalresposta){
		try{
			$validacoes = array();

			if($profissionalresposta == null)
				array_push($validacoes, 'Erro01');
			if (empty($empresa->getAlternativa_perfil_comp()))
				array_push($validacoes, 'Você precisa escolher ao menos uma alternativa');

			if ($validacoes != null){
				return array('erro' => $validacoes);
				exit;
			}
			
		}catch (Exception $e){
            return array('erro' => $e->getMessage());
        }
	}
}
?>	