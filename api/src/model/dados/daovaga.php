<?php

require_once('../src/model/dados/idaovaga.php');

class DaoVaga implements iDAOVaga
{
    function __construct(){}

    /**
     * @param vaga $vaga
     * @return string
     */
    public function salvar(vaga $vaga){
        try{
            //Comando para inserir a vaga na base de dados
            $sql = "insert into vaga (nr_qtd_vaga,ds_observacao,dt_validade,tp_contratacao,nr_experiencia,nr_longitude,nr_latitude,ds_beneficios,ds_horario_expediente,
                                      dt_criacao,ds_titulo,vl_salario,ds_endereco,cd_cargo,cd_empresa,tp_status,ds_segunda_etapa)
                         values (:nr_qtd_vaga,:ds_observacao,:dt_validade,:tp_contratacao,:nr_experiencia,:nr_longitude,:nr_latitude,:ds_beneficios,:ds_horario_expediente,
                                 :dt_criacao,:ds_titulo,:vl_salario,:ds_endereco,:cd_cargo,:cd_empresa,:tp_status,:ds_segunda_etapa)";
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
                ':ds_endereco' => $vaga->getDsEndereco(),
                ':cd_cargo' => $vaga->getCargo()->getCdCargo(),
                ':cd_empresa' => $vaga->getEmpresa()->getCdEmpresa(),
                ':tp_status' => $vaga->getTpStatus(),
                ':ds_segunda_etapa' => $vaga->getDsSegundaEtapa()

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

            $stmt->closeCursor();

            $comando = "update empresa set vl_saldo = vl_saldo - 200 where cd_empresa = :cd_empresa";

            $stmt = db::getInstance()->prepare($comando);

            $stmt->bindValue(':cd_empresa', $vaga->getEmpresa()->getCdEmpresa());

            $run = $stmt->execute();

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }

    public function publicar($cd_vaga){
        try{

            $comando = "update vaga set tp_status = 'A' where cd_vaga = :cd_vaga";

            $stmt = db::getInstance()->prepare($comando);

            $stmt->bindValue(':cd_vaga', $cd_vaga);

            $run = $stmt->execute();

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }

    }

    public function duplicidade(Vaga $vaga){
        try{
            $comando = 'select v.cd_vaga,v.nr_qtd_vaga,v.ds_observacao,v.dt_validade,v.tp_contratacao,v.nr_longitude,v.nr_latitude,v.ds_beneficios,
                               v.ds_horario_expediente,v.dt_criacao,v.ds_titulo,v.vl_salario,v.tp_status,v.nr_experiencia,v.ds_endereco,
                               c.cd_cargo,c.ds_cargo,
                               ct.cd_competencia_tecnica,vct.nr_nivel,ct.ds_competencia_tecnica,
                               cc.cd_competencia_comport,cc.ds_competencia_comport,
                               vi.cd_idioma,i.ds_idioma,vi.nr_nivel,
                               "" ds_nome_fantasia
                          from vaga v
                    inner join cargo c ON c.cd_cargo = v.cd_cargo
                    left join vaga_competencia_tecnica vct ON vct.cd_vaga = v.cd_vaga
                    left join competencia_tecnica ct ON ct.cd_competencia_tecnica = vct.cd_competencia_tecnica
                    left join vaga_competencia_comport vcc ON vcc.cd_vaga = v.cd_vaga
                    left join competencia_comport cc ON cc.cd_competencia_comport = vcc.cd_competencia_comport
                    left join vaga_idioma AS vi ON vi.cd_vaga = v.cd_vaga
                    left join idioma i ON vi.cd_idioma = i.cd_idioma ';
            $where = '';
            $orderBy = '';

            if (!empty($vaga->getCdVaga())){
                if (empty($where)){
                    $where = ' where v.cd_vaga = :cd_vaga';
                }else{
                    $where = $where . ' and v.cd_vaga = :cd_vaga';
                }
            }

            if (!empty($vaga->getDsTitulo())){
                if (empty($where)){
                    $where = ' where v.ds_titulo = :ds_titulo';
                }else{
                    $where = $where . ' and v.ds_titulo = :ds_titulo';
                }
            }

            if (!empty($vaga->getDtCriacao())){
                if (empty($where)){
                    $where = ' where v.dt_criacao = :dt_criacao';
                }else{
                    $where = $where . ' and v.dt_criacao = :dt_criacao';
                }
            }

            $db = new db();
            $stmt = db::getInstance()->prepare($comando . $where. $orderBy);

            if (!empty($vaga->getCdVaga()))
                $stmt->bindValue(':cd_vaga', $vaga->getCdVaga());
            if (!empty($vaga->getDsTitulo()))
                $stmt->bindValue(':ds_titulo', $vaga->getDsTitulo());
            if (!empty($vaga->getDtCriacao()))
                $stmt->bindValue(':dt_criacao', $vaga->getDtCriacao());

            $run = $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $conversor = new conversorDeObjetos();
            $stmt->closeCursor();
            return $conversor->parseRowsToObjectVaga($result); //$stmt->fetchAll(PDO::FETCH_ASSOC);
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
                               v.ds_horario_expediente,v.dt_criacao,v.ds_titulo,v.vl_salario,v.tp_status,v.nr_experiencia,v.ds_endereco,
                               c.cd_cargo,c.ds_cargo,
                               ct.cd_competencia_tecnica,vct.nr_nivel,ct.ds_competencia_tecnica,
                               cc.cd_competencia_comport,cc.ds_competencia_comport,
                               vi.cd_idioma,i.ds_idioma,vi.nr_nivel,
                               "" ds_nome_fantasia
                          from vaga v
                    inner join cargo c ON c.cd_cargo = v.cd_cargo
                    left join vaga_competencia_tecnica vct ON vct.cd_vaga = v.cd_vaga
                    left join competencia_tecnica ct ON ct.cd_competencia_tecnica = vct.cd_competencia_tecnica
                    left join vaga_competencia_comport vcc ON vcc.cd_vaga = v.cd_vaga
                    left join competencia_comport cc ON cc.cd_competencia_comport = vcc.cd_competencia_comport
                    left join vaga_idioma AS vi ON vi.cd_vaga = v.cd_vaga
                    left join idioma i ON vi.cd_idioma = i.cd_idioma ';

            $where = '';

            if (!empty($vaga->getCdVaga())){
                if (empty($where)){
                    $where = ' where v.cd_vaga = :cd_vaga';
                }else{
                    $where = $where . ' and v.cd_vaga = :cd_vaga';
                }
            }

            if (!empty($vaga->getEmpresa()->getCdEmpresa())){
                if (empty($where)){
                    $where = ' where v.cd_empresa = :cd_empresa';
                }else{
                    $where = $where . ' and v.cd_empresa = :cd_empresa';
                }
            }

            $db = new db();
            $stmt = db::getInstance()->prepare($comando . $where);

            if (!empty($vaga->getCdVaga()))
                $stmt->bindValue(':cd_vaga', $vaga->getCdVaga());
            if (!empty($vaga->getEmpresa()->getCdEmpresa()))
                $stmt->bindValue(':cd_empresa', $vaga->getEmpresa()->getCdEmpresa());

            $run = $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $conversor = new conversorDeObjetos();
            $stmt->closeCursor();
            return $conversor->parseRowsToObjectVaga($result); //$stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
           
        }
    }

    public function curtirVaga($tp_acao,$cd_vaga,$cd_profissional){
        try{
            $sql = "insert into profissional_vaga (tp_acao,cd_vaga,cd_profissional) 
                         values (:tp_acao,:cd_vaga,:cd_profissional);";

            $stmt = db::getInstance()->prepare($sql);
            $run = $stmt->execute(array(
                ':tp_acao' => $tp_acao,
                ':cd_vaga' => $cd_vaga,
                ':cd_profissional' => $cd_profissional
            ));

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }

    public function likeProfissionalVaga($cd_vaga,$cd_profissional){
        try{
            $sql = "update profissional_vaga set match_empresa = 1 where cd_vaga = :cd_vaga and cd_profissional = :cd_profissional;";

            $stmt = db::getInstance()->prepare($sql);
            $run = $stmt->execute(array(
                ':cd_vaga' => $cd_vaga,
                ':cd_profissional' => $cd_profissional
            ));

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }

    /**
     * @param $cd_vaga
     * @param $cd_profissional
     * @return array
     * @throws Exception
     */
     public function isCurtidaByProfissional($cd_vaga,$cd_profissional)
    {
        try{
            $sql = 'select * from profissional_vaga
                    WHERE cd_vaga = :cd_vaga 
                      AND cd_profissional = :cd_profissional';

            $stmt = db::getInstance()->prepare($sql);
            $run = $stmt->execute(array(
                'cd_vaga' => $cd_vaga,
                'cd_profissional' => $cd_profissional
            ));
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }

    /**
     * @param $cd_vaga
     * @param $cd_profissional
     * @return array
     * @throws Exception
     */
     public function isCurtidaByEmpresa($cd_vaga,$cd_profissional)
    {
        try{
            $sql = "select * from profissional_vaga
                    WHERE cd_vaga = :cd_vaga 
                      AND cd_profissional = :cd_profissional
                      AND match_empresa = 1";

            $stmt = db::getInstance()->prepare($sql);
            $run = $stmt->execute(array(
                'cd_vaga' => $cd_vaga,
                'cd_profissional' => $cd_profissional
            ));
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }


    public function fecharVaga($cd_vaga){
        try{
            $sql = "update vaga set    tp_status = 'F' 
                     where  cd_vaga = :cd_vaga";

            $stmt = db::getInstance()->prepare($sql);
            $run = $stmt->execute(array(
                ':cd_vaga' => $cd_vaga
            ));
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }

    public function getByIdToNotification($cd_vaga){
         try{
             $sql = 'select vaga.ds_titulo,empresa.ds_nome_fantasia from vaga 
                    join empresa on empresa.cd_empresa = vaga.cd_empresa
                    where vaga.cd_vaga = :cd_vaga;';
             $db = db::getInstance();

             $stmt = $db->prepare($sql);
             $stmt->bindValue(':cd_vaga',$cd_vaga);
             $stmt->execute();
             $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

             $vaga = new vaga();
             $empresa = new empresa();
             //$empresa->setDsNomeFantasia($result['ds_nome_fantasia']);
             //$vaga->setDsTitulo($result['ds_titulo']);
             //$vaga->setEmpresa($empresa);

             return $result;

         }catch (PDOException $e){
            throw new Exception($e->getMessage());
         }finally{
            $stmt->closeCursor();
         }
    }


}
?>