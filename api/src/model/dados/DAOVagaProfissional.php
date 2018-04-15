<?php
require_once ('../src/model/dados/idaovagaprofissional.php');

class DAOVagaProfissional implements iDAOVagaProfissional
{

    /**
     * @param VagaProfissional $vagaProfissional
     * @return array
     */
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

    /**
     * Verifica se a vaga já foi curtida pelo profissional
     * @param VagaProfissional $vagaProfissional
     * @return
     */
    public function isCurtidaByProfissional($cd_vaga,$cd_profissional)
    {
        try{
            $sql = 'select * from profissional_vaga
                    WHERE cd_vaga = :cd_vaga 
                      AND cd_profissional = :cd_profissional' ;

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

    public function listarProfissionalVaga($cod_vaga)
    {
        try{
            $sql = 'select b_foto,
                           dt_nascimento,
                           profissional.cd_profissional,
                           profissional.ds_email,
                           profissional.nr_longitude,
                           tp_conta,
                           tp_sexo,
                           profissional.ds_nome,
                           profissional.nr_latitude
                      from profissional_vaga AS vp
                inner join vaga ON vp.cd_vaga = vaga.cd_vaga
                inner join profissional ON profissional.cd_profissional = vp.cd_profissional 
                     where vp.cd_vaga = :cod_vaga;';

            $stmt = db::getInstance()->prepare($sql);

            if (!empty($cod_vaga))
                $stmt->bindValue(':cod_vaga', $cod_vaga);

            $run = $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $listaprofissional = new ArrayObject();
            foreach ($result as $row){
                $profissional = new profissional();
                $profissional->setBfoto($row['b_foto']);
                $profissional->setCdprofissional($row['cd_profissional']);
                $profissional->setDsEmail($row['ds_email']);
                $profissional->setDsnome($row['ds_nome']);
                $profissional->setTpconta($row['tp_conta']);
                $profissional->setTpsexo($row['tp_sexo']);
                $profissional->setNrlatitude($row['nr_latitude']);
                $profissional->setNrlogitude($row['nr_longitude']);
                $listaprofissional->append($profissional);
            }
            return $listaprofissional;

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
    public function pesquisa($cd_profissional, $alt='false'){
        try{
            $comando = 'select v.cd_vaga,v.nr_qtd_vaga,v.ds_observacao,v.dt_validade,v.tp_contratacao,v.nr_longitude,v.nr_latitude,v.ds_beneficios,
                               v.ds_horario_expediente,v.dt_criacao,v.ds_titulo,v.vl_salario,v.tp_status,v.nr_experiencia,v.ds_endereco,
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
                         where v.cd_vaga not in (SELECT cd_vaga from profissional_vaga where cd_profissional = :cod_prof)
                      ORDER BY v.cd_vaga DESC
                         LIMIT 1;';

            //TODO JOIN vaga_curso AS vcurso ON vaga.cd_vaga = vcurso.cd_vaga , JOIN formacao AS f ON f.cd_formacao = vcurso.cd_formacao

            $stmt = db::getInstance()->prepare($comando);

            if (!empty($cd_profissional))
                $stmt->bindValue(':cod_prof', $cd_profissional);

            $run = $stmt->execute();

            $conversor = new conversorDeObjetos();

            //Lista de objetos vaga
            return $conversor->parseRowsToObjectVaga($stmt->fetchAll(PDO::FETCH_ASSOC));

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }
}