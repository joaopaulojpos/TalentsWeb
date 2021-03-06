<?php

require_once('../src/model/dados/daoempresa.php');

class RNEmpresa{

	public function cadastrar($empresa){	
		try{
			$daoempresa = new DaoEmpresa();
			$result = $daoempresa->cadastrar($empresa);

			return array('sucess' => 'Cadastrado com sucesso!');

		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}
	}

	public function alterar($empresa){
		try{
			$daoempresa = new DaoEmpresa();
			$result = $daoempresa->alterar($empresa);

			return array('sucess' => 'Alterado com sucesso!');

		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}

	}

	public function salvar(Empresa $empresa){
		try{
			$validacoes = array();
			$alterar = ($empresa->getCdEmpresa() != null) && ($empresa->getCdEmpresa() > 0);

			if($empresa == null)
				array_push($validacoes, 'Todos os campos precisam ser preenchido!');
			if (empty($empresa->getNrCnpj()))
				array_push($validacoes, 'CNPJ precisa ser preenchido!');
			if (empty($empresa->getDsRazaoSocial()))
				array_push($validacoes, 'Razão Social precisa ser preenchido!');
			if (empty($empresa->getDsNomeFantasia()))
				array_push($validacoes, 'Nome Fantasia precisa ser preenchido!');
			if (empty($empresa->getNrPorte()))
				array_push($validacoes, 'Porte precisa ser preenchido!');
			if (empty($empresa->getDsAreaAtuacao()))
				array_push($validacoes,  'Área de Atuação precisa ser preenchido!');
			if (empty($empresa->getDsResponsavelCadastro()))
				array_push($validacoes, 'Responsável precisa ser preenchido!');
			if (empty($empresa->getDsSite()))
				array_push($validacoes, 'Site precisa ser preenchido!');
			if (empty($empresa->getDsEmail()))
				array_push($validacoes, 'Email precisa ser preenchido!');
			if (empty($empresa->getDsTelefone()))
				array_push($validacoes, 'Telefone precisa ser preenchido!');
			if (empty($empresa->getDsSenha()))
				array_push($validacoes, 'Senha precisa ser preenchido!');

			if ($validacoes != null){
				return array('erro' => $validacoes);
				exit;
			}

			if ($alterar){
				$empresavalidar = new Empresa();
				$empresavalidar->setCdEmpresa($empresa->getCdEmpresa());
				$empresavalidar->setNrCnpj($empresa->getNrCnpj());
				$daoempresa = new DaoEmpresa();
				$result = $daoempresa->pesquisar($empresavalidar, true);
				if (!empty($result))
					array_push($validacoes, 'Já existe uma outra empresa cadastrada com esses mesmos dados!');
			}else{
				$empresavalidar = new Empresa();
				$empresavalidar->setNrCnpj($empresa->getNrCnpj());
				$daoempresa = new DaoEmpresa();
				$result = $daoempresa->pesquisar($empresavalidar);
				if (!empty($result))
					array_push($validacoes, 'Já existe uma empresa cadastrada com esses dados!');
			}

			if ($validacoes != null){
				return array('erro' => $validacoes);
				exit;
			}

			if ($alterar){
				return $this->alterar($empresa);
			}else{
				return $this->cadastrar($empresa);
			}
			
		}catch (Exception $e){
            return array('erro' => $e->getMessage());
        }
	}

	public function logar($login, $senha){

		try{

			$validacoes = array();
			//valida se login e senha foram passados por parametros
			if (empty($login))
				array_push($validacoes, 'Login precisa ser preenchido!');
			if (empty($senha))
				array_push($validacoes, 'Senha precisa ser preenchido!');

			if ($validacoes != null){
				return array('erro' => $validacoes);
				exit;
			}

			$empresa = new Empresa();

			$empresa->setDsEmail($login);
			$empresa->setDsSenha($senha);

			$daoempresa = new DaoEmpresa();

			//pesquisa na daoempresa utilizando as variaveis preenchidas como filtro
			$result = $daoempresa->pesquisar($empresa);

			if (!empty($result)){
				return array('sucess' => $result);
			}else{
				return array('erro' => 'Login e/ou senha inválido(s)!');
			}
		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}
	}

	public function pesquisar($empresa){
		try{
			$daoempresa = new DaoEmpresa();
			$result = $daoempresa->pesquisar($empresa);
			
			if (!empty($result)){
				return array('sucess' => $result);
			}else{
				return array('erro' => 'A pesquisa não retornou nenhum registro!');
			}
		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}
	}

	public function pesquisarVagas($empresa, $filtro){
		try{
			$validacoes = array();
			if (empty($empresa->getCdEmpresa()))
				array_push($validacoes, 'Não foi possivel carregar vagas pois o código da empresa não foi localizado!');

			if ($filtro != "A" && $filtro != "T")
				array_push($validacoes, 'Filtro utilizado inválido!');

			if ($validacoes != null){
				return array('erro' => $validacoes);
				exit;
			}

			$daoempresa = new DaoEmpresa();
			$result = $daoempresa->pesquisarVagas($empresa, $filtro);
			
			if (!empty($result)){
				return array('sucess' => $result);
			}else{
				return array('erro' => 'A pesquisa não retornou nenhum registro!');
			}
		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}
	}

	public function match($cd_vaga,$cd_profissional){
	    try{
	        $dao = new DaoEmpresa();

	        $result = $dao->match($cd_vaga,$cd_profissional);
	        return $result;
        }catch (Exception $e){
            return array('erro' => $e->getMessage());
        }
    }
}

?>