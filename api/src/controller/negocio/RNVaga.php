<?php

require_once('../src/model/dados/daovaga.php');

/**
 * User = Rhuan
 */
class RNVaga{

	public function publicar(Vaga $vaga){
		try {

            $daovaga = new DAOVaga();
        
            //Validações de campo

            $validacoes = array();

            if (empty($vaga->getDsTitulo()))
                array_push($validacoes, 'Título inválido!');
            if (strlen($vaga->getDsTitulo()) > 100)
                array_push($validacoes, 'Não é possível inserir um texto de título tão grande, permitido no máximo 100 caracteres!');
            
            if (Empty($vaga->getCargo()->getCdCargo()))
                array_push($validacoes, 'Cargo inválido!');
            if (empty($vaga->getTpContratacao() || strlen($vaga->getTpContratacao()) > 1))
                array_push($validacoes, 'Tipo de contratação inválido!');
            if (empty($vaga->getVlSalario()))
                array_push($validacoes, 'Salário inválido!');
            if ($vaga->getVlSalario() < 0)
                array_push($validacoes, 'Salário precisa ser maior do que zero!');
            if (empty($vaga->getDsHorarioExpediente() || strlen($vaga->getDsHorarioExpediente()) > 1))
                array_push($validacoes, 'Jornada de trabalho inválido!');
            if (empty($vaga->getNrQtdVaga()))
                array_push($validacoes, 'Número de vagas inválido!');
            if ($vaga->getNrQtdVaga() < 0)
                array_push($validacoes, 'Número de vagas precisa ser maior do que zero!');
            if (empty($vaga->getDsBeneficios()))
                array_push($validacoes, 'Benefícios inválidos!');
            if (strlen($vaga->getDsBeneficios()) > 1000)
                array_push($validacoes, 'Não é possível inserir um texto de beneficíos tão grande, permitido no máximo 1000 caracteres!');
            if (strlen($vaga->getDsObservacao()) > 1000)
                array_push($validacoes, 'Não é possível inserir um texto de observação tão grande, permitido no máximo 1000 caracteres!');

            $vagavalidar = new Vaga();
            $vagavalidar->setDsTitulo($vaga->getDsTitulo());
            $vagavalidar->setDtCriacao($vaga->getDtCriacao());
            $result = $daovaga->duplicidade($vagavalidar);
            if (!empty($result))
                array_push($validacoes, $result);


            /**/
            $daocargo = new DaoCargo();
            if (empty($daocargo->pesquisar($vaga->getCargo())))
                array_push($validacoes, 'Cargo inválido!');
            $daoempresa = new DaoEmpresa();
            if (empty($daoempresa->pesquisar($vaga->getEmpresa()))) 
                 array_push($validacoes, 'Empresa não existe');

            //Verifica se tem algum elemento dentro do array de validações
            if ($validacoes != null){
                return array('erro' => $validacoes);
                exit;
            }

            //Validar se os idiomas existem
            foreach ($vaga->getIdiomas() as $idioma){
                $daoidioma = new DaoIdioma();
                if (empty($daoidioma->pesquisar($idioma)))
                    array_push($validacoes, "Idioma - cód:".$idioma->getCdIdioma().", não existe!");
            }

            //Validar se as competencias existem
            foreach ($vaga->getCompetenciasTecnicas() as $ct){
                $daocompetenciatecnica = new DAOCompetenciaTecnica();
                if (empty($daocompetenciatecnica->pesquisar($ct))){
                   array_push($validacoes, "Competência técnica - cód:".$ct->getCdCompetenciaTecnica().", não existe!");
                }
            }

            foreach ($vaga->getCompetenciasComport() as $cc){
                $daocompetenciacomport = new DAOCompetenciaComport();
                if (empty($daocompetenciacomport->pesquisar($cc))){
                   array_push($validacoes, "Competência comportamental - cód:".$cc->getCdCompetenciaComport().", não existe!");
                }
            }

            //Validar se os cursos existem
            foreach ($vaga->getCursos() as $curso){
                $daocurso = new DaoCurso();
                if (empty($daocurso->pesquisar($curso))){
                    array_push($validacoes, "Curso - cód:".$curso->getCdCurso().", não existe!");
                }
            }
            
            //------------------------------------------------------------------------------------------------------------\

            $daovaga->publicar($vaga);

            return array('sucess' => 'Cadastrado com sucesso!');

        }catch (Exception $e){
            return array('erro' => $e->getMessage());
        }
	}

    /**
     * @param $tp_acao
     * @param $cd_vaga
     * @param $cd_profissional
     * @return array
     */
    public function curtirVaga($tp_acao,$cd_vaga,$cd_profissional){
        try{
            $daoprofissional = new DaoProfissional();
            $daovaga = new DaoVaga();


            //Verifica se o campo tipo de ação está vazio
            if (empty($tp_acao)){
                return array('erro' => 'Código do tipo de ação inválido');
            }

            //Verifica se o campo código do profissional está vazio
            if (empty($cd_profissional)){
                return array('erro' => 'Código do profissional inválido');
            }

            //Verifica se o campo código da vaga está vazio
            if (empty($cd_vaga)){
                return array('erro' => 'Código da vaga inválido');
            }


            //Verifica se o profissional existe
            $prof = new Profissional();
            $prof->setCdProfissional($cd_profissional);
            $profissional = $daoprofissional->pesquisarById($prof);
            if (empty($profissional)){
                return array('erro' => "Profissional não existe");
            }

            //Verifica se a vaga já foi curtida pelo profissional
            $result = $daovaga->isCurtidaByProfissional($cd_vaga,$cd_profissional);
            if (!empty($result)){
                return array('erro'=> "A vaga já foi curtida");
            }

            $result = $daovaga->curtirVaga($tp_acao,$cd_vaga,$cd_profissional);

            return array('sucess' => 'Vaga curtida!');

        }catch (Exception $e){
            return array('erro' => $e->getTrace());
        }
    }

	public function pesquisar($vaga){
		try
        {
			$daovaga = new DAOVaga();
			$result = $daovaga->pesquisar($vaga);
			
			if (!empty($result)){
				return array('sucess' => $result);
			}else{
				return array('erro' => 'A pesquisa não retornou nenhum registro!');
			}
            
		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}
	
	}
}

?>