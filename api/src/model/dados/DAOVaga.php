<?php

require_once('idaovaga.php');

class DaoVaga implements iDAOVaga
{
    function __construct(){}

    public function publicar(vaga $vaga){
        $sql = "insert into vaga (cd_vaga,nr_qtd_vaga,ds_observacao,dt_validade,tp_contratacao,nr_longitude,nr_latitude,ds_beneficios,ds_horario_expediente,dt_criacao,ds_titulo,vl_salario,cd_cargo,cd_empresa)
            values (:cd_vaga,:nr_qtd_vaga,:ds_observacao,:dt_validade,:tp_contratacao,:nr_longitude,:nr_latitude,:ds_beneficios,:ds_horario_expediente,:dt_criacao,:ds_titulo,:vl_salario,:cd_cargo,:cd_empresa);";
        $stmt = db::getInstance()->prepare($sql);
        $run = $stmt->execute(array(
				':cd_vaga' => $vaga->getCdVaga(),
                ':nr_qtd_vaga' => $vaga->getNrQtdVaga(),
                ':ds_observacao' => $vaga->getDsObservacao(),
                ':dt_validade' => $vaga->getDtValidade(),
                ':tp_contratacao' => $vaga->getTpContratacao(),
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
    }

    public function pesquisar(Vaga $vaga, $alt='false'){
        $comando = 'select v.cd_vaga,nr_qtd_vaga,ds_observacao,dt_validade,tp_contratacao,nr_longitude,nr_latitude,ds_beneficios,ds_horario_expediente,dt_criacao,ds_titulo,vl_salario,cargo.cd_cargo,ds_cargo,e.cd_empresa,
 ds_razao_social,ds_nome_fantasia,nr_porte,ds_nome_responsavel,ds_area_atuacao,ds_site,ds_telefone,nr_cnpj,ds_email,ds_senha,f.cd_formacao,ds_formacao,vh.cd_habilidade,vh.nr_nivel,h.ds_habilidade,vi.cd_idioma,ds_idioma
 from vaga AS v JOIN vaga_curso AS vcurso ON v.cd_vaga = vcurso.cd_vaga
JOIN vaga_habilidade as vh ON vh.cd_vaga = v.cd_vaga JOIN vaga_idioma as vi ON vi.cd_vaga = v.cd_vaga JOIN cargo ON cargo.cd_cargo = v.cd_cargo
 JOIN empresa as e ON e.cd_empresa = v.cd_empresa JOIN formacao AS f ON f.cd_formacao = vcurso.cd_formacao JOIN habilidade AS h ON h.cd_habilidade = vh.cd_habilidade
 JOIN idioma AS i ON i.cd_idioma = vi.cd_idioma;';
        $where = '';

        if (!empty($vaga->getCdVaga())){
            if (empty($where)){
                $where = ' where v.cd_vaga = :cd_vaga';
            }else{
                $where = $where . ' and v.cd_vaga = :cd_vaga';
            }
        }

        
        $db = new db();
        $stmt = db::getInstance()->prepare($comando . $where);
        if (!empty($vaga->getCdVaga()))
            $stmt->bindValue(':cd_vaga', $vaga->getCdVaga());

        $run = $stmt->execute();

        return ($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

}

 ?>