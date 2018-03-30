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
        try{
            //Comando para inserir a vaga na base de dados
            $sql = "insert into vaga (nr_qtd_vaga,ds_observacao,dt_validade,tp_contratacao,nr_experiencia,nr_longitude,nr_latitude,ds_beneficios,ds_horario_expediente,
                                      dt_criacao,ds_titulo,vl_salario,cd_cargo,cd_empresa,tp_status)
                         values (:nr_qtd_vaga,:ds_observacao,:dt_validade,:tp_contratacao,:nr_experiencia,:nr_longitude,:nr_latitude,:ds_beneficios,:ds_horario_expediente,
                                 :dt_criacao,:ds_titulo,:vl_salario,:cd_cargo,:cd_empresa,:tp_status)";
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
                    ':cd_empresa' => $vaga->getEmpresa()->getCdEmpresa(),
                    ':tp_status' => 'A'

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

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }

    /**
     * @param Vaga $vaga
     * @param string $alt
     * @return array
     */
    public function pesquisar(Vaga $vaga, $alt='false'){
        try{
            $comando = 'select v.cd_vaga,v.nr_qtd_vaga,v.ds_observacao,v.dt_validade,v.tp_contratacao,v.nr_longitude,v.nr_latitude,v.ds_beneficios,
                               v.ds_horario_expediente,v.dt_criacao,v.ds_titulo,v.vl_salario,v.tp_status,v.nr_experiencia,
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
                      ORDER BY RAND()
                         LIMIT 1;';
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
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $conversor = new conversorDeObjetos();

            return $conversor->parseRowsToObjectVaga($result); //$stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }
}
?>