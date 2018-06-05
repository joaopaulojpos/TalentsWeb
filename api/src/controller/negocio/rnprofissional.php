<?php

require_once('../src/model/dados/daoprofissional.php');

class RNProfissional{

	public function cadastrar($profissional){
		try{
			$daoprofissional = new DaoProfissional();
			$result = $daoprofissional->cadastrar($profissional);

			return array('sucess' => $result);

		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}
	}

	public function alterar($profissional){
		try{
			$daoprofissional = new DaoProfissional();
			$result = $daoprofissional->alterar($profissional);

			return array('sucess' => 'Alterado com sucesso!');

		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}

    }
    
    public function salvar(Profissional $profissional){
		try{
			$validacoes = array();
			$alterar = ($profissional->getCdProfissional() != null) && ($profissional->getCdProfissional() > 0);

			if($profissional == null)
				array_push($validacoes, 'Todos os campos precisam ser preenchido!');
			if (empty($profissional->getBfoto()))
				array_push($validacoes, 'A Foto precisa ser preenchido!');
			if (empty($profissional->getDsSenha()))
				array_push($validacoes, 'A Senha precisa ser preenchido!');
			if (empty($profissional->getDtNascimento()))
				array_push($validacoes, 'Data de Nascimento precisa ser preenchido!');
			if (empty($profissional->getNrlatitude()))
				array_push($validacoes, 'A Latitude precisa ser preenchido!');
			if (empty($profissional->getNrlogitude()))
				array_push($validacoes,  'A Logintude precisa ser preenchido!');
			if (empty($profissional->getTpconta()))
				array_push($validacoes, 'Tipo Conta precisa ser preenchido!');
			if (empty($profissional->getTpsexo()))
				array_push($validacoes, 'O Sexo precisa ser preenchido!');
			if (empty($profissional->getDsnome()))
				array_push($validacoes, 'O Nome precisa ser preenchido!');
			if (empty($profissional->getDsEmail()))
				array_push($validacoes, 'O Email precisa ser preenchido!');

			if ($validacoes != null){
				return array('erro' => $validacoes);
				exit;
			}

			if ($alterar){
				$profissionalvalidar = new Profissional();
				$profissionalvalidar->setCdProfissional($profissional->getCdProfissional());
				$profissionalvalidar->setDsEmail($profissional->getDsEmail());
				$daoprofissional = new DaoProfissional();
				$result = $daoprofissional->pesquisar($profissionalvalidar, true);
			}else{
				$profissionalvalidar = new Profissional();
				$profissionalvalidar->setDsEmail($profissional->getDsEmail());
				$daoprofissional = new DaoProfissional();
				$result = $daoprofissional->pesquisar($profissionalvalidar);
				if (!empty($result))
					array_push($validacoes, 'Já existe uma Profissional cadastrada com esses dados !');
			}

			if ($validacoes != null){
				return array('erro' => $validacoes);
				exit;
			}

			if ($alterar){
				return $this->alterar($profissional);
			}else{
				return $this->cadastrar($profissional);
			}
			
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
    public function getProfissional($ds_email){
        try{
        	if (empty($ds_email)){
				return json_encode(array('erro' => 'Todos os campos precisam ser preenchidos!'));
				exit;
			}

			$profissional = new Profissional();

			$profissional->setDsEmail($ds_email);

			$daoprofissional = new DaoProfissional();

			$result = $daoprofissional->getProfissional($profissional);
    
            return array('sucess'=> $result);
        }catch (Exception $e){
            return array('erro' => $e->getMessage());
        }

    }
    public function listarCursosCandidatos($cd_profissional)
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

            $result = $daoprofissional->listarCursosProfissional($cd_profissional,false);
            return array('sucess'=> $result);

        }catch (Exception $e){
            return array('erro' => $e->getMessage());
        }
    }
    public function listarIdiomasCandidatos($cd_profissional)
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

            $result = $daoprofissional->listarIdiomasProfissional($cd_profissional,false);
            return array('sucess'=> $result);

        }catch (Exception $e){
            return array('erro' => $e->getMessage());
        }
    }
    public function listarCompetenciasCandidatos($cd_profissional)
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

            $result = $daoprofissional->listarCompetenciasProfissional($cd_profissional,false);
            return array('sucess'=> $result);

        }catch (Exception $e){
            return array('erro' => $e->getMessage());
        }
    }
    public function listarCargosCandidatos($cd_profissional)
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

            $result = $daoprofissional->listarCargosProfissional($cd_profissional,false);
            return array('sucess'=> $result);

        }catch (Exception $e){
            return array('erro' => $e->getMessage());
        }
    }

    public function updateToken($cd_profissional,$token)
    {
        try{
            $daoprofissional = new DaoProfissional();

            //Verifica se o profissional existe
            $daoprofissional->updateToken($cd_profissional,$token);

            return array('sucess');
        }catch (Exception $e){
            return array('erro' => $e->getMessage());
        }
    }

}

?>
