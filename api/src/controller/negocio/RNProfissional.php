<?php

require_once('../src/model/dados/daoprofissional.php');

class RNProfissional{

	public function cadastrar($u){
		try{
			$daoprofissional = new daoprofissional();
			$result = $daoprofissional->cadastrar($u);

			return array('sucess' => $result);

		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}
	}


	public function logar($login, $senha){
		try{
			if (empty($login) || empty($senha)){
				return json_encode(array('erro' => 'Todos os campos precisam ser preenchidos!'));
				exit;
			}

			$profissional = new Profissional();

			$profissional->setDsEmail($login);
			$profissional->setDsSenha($senha);

			$daoprofissional = new DaoProfissional();

			$result = $daoprofissional->pesquisar($profissional);

			if (!empty($result)){
				return array('sucess' => $result);
			}else{
				return array('erro' => 'Dados inválidos!');
			}

		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}
	}

    public function pesquisar($profissional){
        try{
            $daoprofissional = new DaoProfissional();
            $result = $daoprofissional->pesquisar($profissional,false);

            if (!empty($result)){
                return array('sucess' => $result);
            }else{
                return array('erro' => 'A pesquisa não retornou nenhum registro!');
            }
        }catch (Exception $e){
            return array('erro' => $e->getMessage());
        }
    }

    public function listarVagasParaCandidatos($cd_profissional)
    {
        try{
            $daoprofissional = new DaoProfissional();

            //Verifica se o profissional existe
            $prof = new Profissional();
            $prof->setCdProfissional($cd_profissional);
            $profissional = $daoprofissional->pesquisarById($prof);
            if (empty($profissional)){
                return array('erro' => "Profissional não existe");
            }

            $result = $daoprofissional->listarVagaProfissional($cd_profissional,false);
            return array('sucess'=> $result);

        }catch (Exception $e){
            return array('erro' => $e->getMessage());
        }
    }

    public function listarProfissionalVaga($cd_vaga){
        $daoprofissional = new DaoProfissional();
        $result = $daoprofissional->listarProfissionalVaga($cd_vaga);
        if (count($result) <= 0){
            return array('erro' => "Ainda não existem profissionais interessados nesta vaga!");
        }
        return array('sucess' => $result);
    }

    public function getNotificacao($cd_profissional){
        try{
            $dao = new DaoProfissional();
            $result = $dao->getNotificacoes($cd_profissional);
            return array('sucess'=> $result);
        }catch (Exception $e){
            return array('erro' => $e->getMessage());
        }

    }


}

?>