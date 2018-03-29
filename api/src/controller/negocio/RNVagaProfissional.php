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
    public function curtirVaga($tp_acao,$cd_vaga,$cd_profissional){
        $daovagapro = new DAOVagaProfissional();
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

        //Verifica se a vaga existe
        $vaga1 = new Vaga();
        $vaga1->setCdVaga($cd_vaga);
        $vaga = $daovaga->pesquisar($vaga1);
        if (empty($vaga)){

            return array('erro' => 'Vaga não encontrada');

        }

        //Verifica se o profissional existe
        $prof = new Profissional();
        $prof->setCdProfissional($cd_profissional);
        $profissional = $daoprofissional->pesquisarById($prof);
        if (empty($profissional)){

            return array('erro' => "Profissional não existe");

        }

        //Verifica se a vaga já foi curtida pelo profissional
        $result = $daovagapro->isCurtidaByProfissional($cd_vaga,$cd_profissional);
        if (!empty($result)){

            return array('erro'=> "A vaga já foi curtida");

        }

        $result = $daovagapro->curtirVaga($tp_acao,$cd_vaga,$cd_profissional);

        return array('sucess' => 'Vaga curtida!');
    }

    public function listarVagasParaCandidatos($cd_profissional)
    {
        $daovagapro = new DAOVagaProfissional();
        $daoprofissional = new DaoProfissional();

        $result = $daovagapro->pesquisaa($cd_profissional,false);
//TODO validar se o profissional já curtiu alguma vaga antes.Pq Se colocar um cod_pro que não está na tabela N-N ele tras todos os registros.
        return array('sucess'=> $result);

    }

}