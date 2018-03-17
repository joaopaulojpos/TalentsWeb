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

            //Verifica se o campo quantidade de vagas está vazio
            if (empty($vaga->getNrQtdVaga())) {

                return array('erro' => 'Número de vagas inválido');

            }

            //Verifica se o campo
            if (strlen($vaga->getDsObservacao()) > 1000) {

                return array('erro' => 'Código observação inválido');

            }

            //Verifica se o campo data de validade está vazio
            if (empty($vaga->getDtValidade())) {

                return array('erro' => 'Data de validade inválido');

            }

            //Verifica se o campo tipo de contratação
            if (empty($vaga->getTpContratacao() || strlen($vaga->getTpContratacao()) > 1)) {

                return array('erro' => 'Tipo de contratação inválido');

            }

            //TODO REGEX para latitude e longitude

            //Verifica se o campo beneficios
            if (strlen($vaga->getDsBeneficios()) > 1000) {

                return array('erro' => 'Benefícios inválido');

            }

            //TODO DateFormat para data de criação

            //TODO Regex para Horário expediente => '07:00-17:00'

            //Verifica se o campo titulo da vaga está vazio ou maior que 100
            if (empty($vaga->getDsTitulo()) || strlen($vaga->getDsTitulo()) > 100) {

                return array('erro' => 'Titulo da vaga não pode ser vazio ou ter mais de 100 caracteres.');

            }

            //Verifica se o campo salário está vazio
            if (empty($vaga->getVlSalario())) {

                return array('erro' => 'Salário inválido');

            }

            //Validar se o idioma existe
            foreach ($vaga->getIdiomas() as $idioma){
                $daoidioma = new DaoIdioma();
                if (empty($daoidioma->pesquisar($idioma))){
                    return array('erro'=>"Idioma cod:".$idioma->getCdIdioma().", não existe.");
                }
            }

            //Validar se o idioma existe
            foreach ($vaga->getHabilidades() as $habilidade){
                $daohabilidade = new DaoHabilidade();
                if (empty($daohabilidade->pesquisar($habilidade))){
                    return array('erro'=>"Habilidade cod:".$habilidade->getCdHabilidade().", não existe.");
                }
            }


            //Verifica se o cargo existe
            $daocargo = new DaoCargo();
            if (empty($daocargo->pesquisar($vaga->getCargo()))) {

                return array('erro' => 'Cargo não existe');

            }

            //Verifica se a empresa existe
            $daoempresa = new DaoEmpresa();
            if (empty($daoempresa->pesquisar($vaga->getEmpresa()))) {

                return array('erro' => 'Empresa não existe');

            }
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