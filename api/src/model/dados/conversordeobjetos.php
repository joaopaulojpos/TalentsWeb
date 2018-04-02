<?php

class conversorDeObjetos{

    //--------------------------------------------- AUXILIARES -----------------------------------------------------------
    /**
     * Método responsável por transformar as linhas do banco na classe vaga
     * @param $result com o resultado do PDO::Fetch
     * @return ArrayObject uma lista de vagas
     */
    public function parseRowsToObjectVaga($result){
        $cd_vaga = 0;
        $listavagas = [];
        $daocompetenciatecnica = new DAOCompetenciaTecnica();
        $daocompetenciacomport = new DAOCompetenciaComport();
        $daoidioma = new DAOIdioma();
        $daocurso = new DAOCurso();

        foreach ($result as $row) {

            //Verifica o código da vaga, para não inserir duplicado
            if ($cd_vaga <> $row['cd_vaga']) {

                $vaga = new Vaga();
                $cargo = new Cargo;
                $empresa = new Empresa();
                $vaga->setCdVaga($row['cd_vaga']);
                $vaga->setNrQtdVaga($row['nr_qtd_vaga']);
                $vaga->setDsObservacao($row['ds_observacao']);
                $vaga->setDtValidade($row['dt_validade']);
                $vaga->setTpContratacao($row['tp_contratacao']);
                $vaga->setNrLongitude($row['nr_longitude']);
                $vaga->setNrLatitude($row['nr_latitude']);
                $vaga->setDsBeneficios($row['ds_beneficios']);
                $vaga->setDsHorarioExpediente($row['ds_horario_expediente']);
                $vaga->setDtCriacao($row['dt_criacao']);
                $vaga->setDsTitulo($row['ds_titulo']);
                $vaga->setVlSalario($row['vl_salario']);
                $vaga->setNrExperiencia($row['nr_experiencia']);
                $vaga->setTpStatus($row['tp_status']);

                //Cargo
                $cargo->setCdCargo($row['cd_cargo']);
                $cargo->setDsCargo($row['ds_cargo']);
                $vaga->setCargo($cargo);

                //Empresa
                $empresa->setDsNomeFantasia($row['ds_nome_fantasia']);
                $vaga->setEmpresa($empresa);

                //TODO Listar dos profissionais e cursos
                /*Profissionais que curtiram a vaga
                foreach ($daoprofissional->listarProfissionalVaga($vaga->getCdVaga()) as $p) {
                    $vaga->setProfissionais($p);
                }*/

                //Cursos
                foreach ($daocurso->listarCursoVaga($vaga->getCdVaga()) as $c) {
                    $vaga->setCursos($c);
                }

                //competencias
                foreach ($daocompetenciatecnica->listarCompetenciasTecnicaVaga($vaga->getCdVaga()) as $ct) {
                    $vaga->setCompetenciasTecnicas($ct);
                }
                foreach ($daocompetenciacomport->listarCompetenciasComportVaga($vaga->getCdVaga()) as $cc) {
                    $vaga->setCompetenciasComport($cc);
                }

                //Idiomas
                foreach ($daoidioma->listarIdiomaVaga($vaga->getCdVaga()) as $i) {
                    $vaga->setIdiomas($i);
                }

                //Adiciona uma vaga na lista de vagas
                array_push($listavagas, $vaga);
                //modifica o atributo com o código da vaga atual
                $cd_vaga=$row['cd_vaga'];
            }
        }
        //Retorna a lista de vagas
        return $listavagas;
    }

}