<?php

require_once('idaovaga.php');

class DaoVaga implements iDAOVaga
{
    function __construct(){}

    /**
     * @param vaga $vaga
     * @return string
     */
    public function publicar(vaga $vaga){

        //Comando para inserir a vaga na base de dados
        $sql = "insert into vaga (nr_qtd_vaga,ds_observacao,dt_validade,tp_contratacao,nr_experiencia,nr_longitude,nr_latitude,ds_beneficios,ds_horario_expediente,dt_criacao,ds_titulo,vl_salario,cd_cargo,cd_empresa)
            values (:nr_qtd_vaga,:ds_observacao,:dt_validade,:tp_contratacao,:nr_experiencia,:nr_longitude,:nr_latitude,:ds_beneficios,:ds_horario_expediente,:dt_criacao,:ds_titulo,:vl_salario,:cd_cargo,:cd_empresa)";
        try {
            $db = db::getInstance();
            $stmt = $db->prepare($sql);
            $run = $stmt->execute(array(
                ':nr_qtd_vaga' => $vaga->getNrQtdVaga(),
                ':ds_observacao' => $vaga->getDsObservacao(),
                ':dt_validade' => $vaga->getDtValidade(),
                ':tp_contratacao' => $vaga->getTpContratacao(),
                ':nr_experiencia' => $vaga->getNrExperiencia(),
                ':nr_longitude' => $vaga->getNrLongitude(),
                ':nr_latitude' => $vaga->getNrLatitude(),
                ':ds_beneficios' => $vaga->getDsBeneficios(),
                ':ds_horario_expediente' => $vaga->getDsHorarioExpediente(),
                ':dt_criacao' => $vaga->getDtCriacao(),
                ':ds_titulo' => $vaga->getDsTitulo(),
                ':vl_salario' => $vaga->getVlSalario(),
                ':cd_cargo' => $vaga->getCargo()->getCdCargo(),
                ':cd_empresa' => $vaga->getEmpresa()->getCdEmpresa()

            ));
            //Guardando o id da última insersão para utiliza-lo
            $cdvaga = $db->lastInsertId();

            //Pegando os idiomas na lista na vaga e inserindo associando com o código da vaga
            foreach ($vaga->getIdiomas() as $idioma) {

                $daoidiomas = new DaoIdioma();
                $daoidiomas->inserirIdiomaVaga($cdvaga, $idioma);

            }

            //Pegando as competencias na lista na vagas inserindo associando com o código da vaga
            foreach ($vaga->getCompetenciasTecnicas() as $ct) {

                $daocompetenciatecnica = new DAOCompetenciaTecnica();
                $daocompetenciatecnica->inserirCompetenciaTecnicaVaga($cdvaga, $ct);

            }

            foreach ($vaga->getCompetenciasComport() as $cc) {

                $daocompetenciacomport = new DAOCompetenciaComport();
                $daocompetenciacomport->inserirCompetenciaComportVaga($cdvaga, $cc);

            }

            //Pegando as habilidades na lista na vagas inserindo associando com o código da vaga
            foreach ($vaga->getCursos() as $curso) {

                $daocurso = new DaoCurso();
                $daocurso->inserirCursoVaga($cdvaga, $curso);

            }

            return array('sucess' => 'Cadastrado com sucesso!');

        }catch (Exception $e){

            return array('erro' => $e->getMessage());

        }
    }

    /**
     * @param Vaga $vaga
     * @param string $alt
     * @return array
     */
    public function pesquisar(Vaga $vaga, $alt='false'){

        $comando = 'select 
                      v.cd_vaga,v.nr_qtd_vaga,v.ds_observacao,v.dt_validade,v.tp_contratacao,v.nr_longitude,v.nr_latitude,v.ds_beneficios,v.ds_horario_expediente,v.dt_criacao,v.ds_titulo,v.vl_salario,
                      c.cd_cargo,c.ds_cargo,
                      e.cd_empresa,e.ds_razao_social,e.ds_nome_fantasia,e.nr_porte,e.ds_nome_responsavel,e.ds_area_atuacao,e.ds_site,e.ds_telefone,e.nr_cnpj,e.ds_email,e.ds_senha,
                      ct.cd_competencia_tecnica,vct.nr_nivel,ct.ds_competencia_tecnica,
                      cc.cd_competencia_comport,cc.ds_competencia_comport,
                      vi.cd_idioma,i.ds_idioma,vi.nr_nivel
                    from vaga v
                    inner join cargo c ON c.cd_cargo = v.cd_cargo
                    inner join empresa e ON e.cd_empresa = v.cd_empresa
                    inner join vaga_competencia_tecnica vct ON vct.cd_vaga = v.cd_vaga
                    inner join competencia_tecnica ct ON ct.cd_competencia_tecnica = vct.cd_competencia_tecnica
                    inner join vaga_competencia_comport vcc ON vcc.cd_vaga = v.cd_vaga
                    inner join competencia_comport cc ON cc.cd_competencia_comport = vcc.cd_competencia_comport
                    inner join vaga_idioma AS vi ON vi.cd_vaga = v.cd_vaga
                    inner join idioma i ON vi.cd_idioma = i.cd_idioma
                    ORDER BY v.cd_vaga DESC
                    LIMIT 1;';

//TODO JOIN vaga_curso AS vcurso ON vaga.cd_vaga = vcurso.cd_vaga , JOIN formacao AS f ON f.cd_formacao = vcurso.cd_formacao
//TODO where v.cd_vaga not in (SELECT cd_vaga from profissional_vaga where cd_profissional = 1) ORDER BY v.cd_vaga DESC

        $where = '';

        if (!empty($vaga->getCdVaga())){

            if (empty($where)){

                $where = ' where vaga.cd_vaga = :cd_vaga';

            }else{

                $where = $where . ' and vaga.cd_vaga = :cd_vaga';

            }

        }

        $db = new db();
        $stmt = db::getInstance()->prepare($comando . $where);

        if (!empty($vaga->getCdVaga()))
            $stmt->bindValue(':cd_vaga', $vaga->getCdVaga());

        $run = $stmt->execute();

        //Lista de objetos vaga
        return $this->parseRowsToObjectVaga($stmt->fetchAll(PDO::FETCH_ASSOC)); //$stmt->fetchAll(PDO::FETCH_ASSOC);
    }

//--------------------------------------------- AUXILIARES -----------------------------------------------------------
    /**
     * Método responsável por transformar as linhas do banco na classe vaga
     * @param $result com o resultado do PDO::Fetch
     * @return ArrayObject uma lista de vagas
     */
    private function parseRowsToObjectVaga($result){
        $cd_vaga = 0;
        $listavagas = [];
        $daocompetenciatecnica = new DAOCompetenciaTecnica();
        $daocompetenciacomport = new DAOCompetenciaComport();
        $daoidioma = new DAOIdioma();

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

                //Cargo
                $cargo->setCdCargo($row['cd_cargo']);
                $cargo->setDsCargo($row['ds_cargo']);
                $vaga->setCargo($cargo);

                //Empresa
                $empresa->setCdEmpresa($row['cd_empresa']);
                $empresa->setDsAreaAtuacao($row['ds_area_atuacao']);
                $empresa->setDsEmail($row['ds_email']);
                $empresa->setDsNomeFantasia($row['ds_nome_fantasia']);
                $empresa->setDsRazaoSocial($row['ds_razao_social']);
                $empresa->setDsResponsavelCadastro($row['ds_nome_responsavel']);
                $empresa->setDsSenha($row['ds_senha']);
                $empresa->setDsSite($row['ds_site']);
                $empresa->setNrCnpj($row['nr_cnpj']);
                $empresa->setNrPorte($row['nr_porte']);
                $empresa->setDsTelefone($row['ds_telefone']);
                $vaga->setEmpresa($empresa);

                //TODO Listar dos profissionais e cursos
                /*Profissionais que curtiram a vaga
                foreach ($daoprofissional->listarProfissionalVaga($vaga->getCdVaga()) as $p) {

                    $vaga->setProfissionais($p);

                }*/

                /*Cursos
                foreach ($daocurso->listarCursoVaga($vaga->getCdVaga()) as $c) {

                    $vaga->setCursos($c);

                }*/

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

 ?>