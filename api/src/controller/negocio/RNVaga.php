<?php

require_once('../src/model/dados/daovaga.php');

/**
 * User = Rhuan
 */
class RNVaga{

	public function publicar(Vaga $vaga){
		
        $daovaga = new DAOVaga();

        try {
            //Validações de campo

            $validacoes = array();

            if (empty($vaga->getNrQtdVaga()))
                array_push($validacoes, 'Número de vagas inválido!');
            if ($vaga->getNrQtdVaga() < 0)
                array_push($validacoes, 'Número de vagas precisa ser maior do que zero!');
            if (strlen($vaga->getDsObservacao()) > 1000)
                array_push($validacoes, 'Não é possível inserir um texto de observação tão grande, permitido no máximo 1000 caracteres!');
            if (empty($vaga->getTpContratacao() || strlen($vaga->getTpContratacao()) > 1))
                array_push($validacoes, 'Tipo de contratação inválido!');
            if (strlen($vaga->getDsBeneficios()) > 1000)
                array_push($validacoes, 'Não é possível inserir um texto de beneficíos tão grande, permitido no máximo 1000 caracteres!');
            if (empty($vaga->getDsTitulo()) || strlen($vaga->getDsTitulo()) > 100)
                array_push($validacoes, 'Não é possível inserir um texto de título tão grande, permitido no máximo 100 caracteres!');
            if (empty($vaga->getVlSalario()))
                array_push($validacoes, 'Salário inválido!');
            if ($vaga->getVlSalario() < 0)
                array_push($validacoes, 'Salário precisa ser maior do que zero!');
            $daocargo = new DaoCargo();
            if (empty($daocargo->pesquisar($vaga->getCargo())))
                array_push($validacoes, 'Cargo inválido!');
            //Verifica se a empresa existe
            $daoempresa = new DaoEmpresa();
            if (empty($daoempresa->pesquisar($vaga->getEmpresa()))) 
                 array_push($validacoes, 'Empresa não existe');

            if ($validacoes != null){
                return array('erro' => $validacoes);
                exit;
            }

            //Validar se o idioma existe
            foreach ($vaga->getIdiomas() as $idioma){
                $daoidioma = new DaoIdioma();
                if (empty($daoidioma->pesquisar($idioma)))
                    array_push($validacoes, "Idioma cod:".$idioma->getCdIdioma().", não existe!");
            }

           /*//Validar se o idioma existe
            foreach ($vaga->getHabilidades() as $habilidade){
                $daohabilidade = new DaoHabilidade();
                if (empty($daohabilidade->pesquisar($habilidade))){
                    return array('erro'=>"Habilidade cod:".$habilidade->getCdHabilidade().", não existe.");
                }
            }*/
            
            //------------------------------------------------------------------------------------------------------------\\

            $result = $daovaga->publicar($vaga);

            return array('sucess' => 'Cadastrado com sucesso!');

        }catch (Exception $e){

            return array('erro' => 'Não foi possível publicar a vaga');

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
				return array('erro' => 'Não existe vaga com o código selecionado!');
			}
		}
		catch (Exception $e)
		{
			return array('erro' => $e->getMessage());
		}
	
	}
}

?>