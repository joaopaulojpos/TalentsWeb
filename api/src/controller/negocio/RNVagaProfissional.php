<?php
require_once ('../src/model/dados/DAOVagaProfissional.php');
/**
 * Created by PhpStorm.
 * User: Rhuan
 * Date: 10/03/2018
 * Time: 10:38
 */

class RNVagaProfissional
{

    /** Método da curtida do profissional na vaga
     * @param VagaProfissional $vagaprofissional
     * @return array
     */
    public function curtirVaga(VagaProfissional $vagaprofissional){
        $daovagapro = new DAOVagaProfissional();
        $daoprofissional = new DaoProfissional();
        $daovaga = new DaoVaga();


        //Verifica se o campo tipo de ação está vazio
        if (empty($vagaprofissional->getTpAcao())){

            return array('erro' => 'Código do tipo de ação inválido');

        }

        //Verifica se o campo código do profissional está vazio
        if (empty($vagaprofissional->getProfissional()->getCdProfissional())){

            return array('erro' => 'Código do profissional inválido');

        }

        //Verifica se o campo código da vaga está vazio
        if (empty($vagaprofissional->getVaga()->getCdVaga())){

            return array('erro' => 'Código da vaga inválido');

        }

        //Verifica se a vaga existe
        $vaga = $daovaga->pesquisar($vagaprofissional->getVaga());
        if (empty($vaga)){

            return array('erro' => 'Vaga não encontrada');

        }

        //Verifica se o profissional existe
        $profissional = $daoprofissional->pesquisarById($vagaprofissional->getProfissional());
        if (empty($profissional)){

            return array('erro' => "Profissional não existe");

        }

        //Verifica se a vaga já foi curtida pelo profissional
        $result = $daovagapro->isCurtidaByProfissional($vagaprofissional);
        if (!empty($result)){

            return array('erro'=> "A vaga já foi curtida");

        }

        $result = $daovagapro->curtirVaga($vagaprofissional);

        return array('sucess' => 'Vaga curtida!');
    }

}