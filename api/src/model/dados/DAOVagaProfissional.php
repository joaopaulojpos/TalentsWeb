<?php
require_once ('IDAOVagaProfissional.php');

class DAOVagaProfissional implements IDAOVagaProfissional
{

    /**
     * @param VagaProfissional $vagaProfissional
     * @return array
     */
    public function curtirVaga(VagaProfissional $vagaProfissional){
        $sql = "insert into profissional_vaga (tp_acao,cd_vaga,cd_profissional) values (:tp_acao,:cd_vaga,:cd_profissional);";
        $stmt = db::getInstance()->prepare($sql);
        $run = $stmt->execute(array(
            ':tp_acao' => $vagaProfissional->getTpAcao(),
            ':cd_vaga' => $vagaProfissional->getVaga()->getCdVaga(),
            ':cd_profissional' => $vagaProfissional->getProfissional()->getCdProfissional()
        ));
        return array($run);
    }

    /**
     * Verifica se a vaga já foi curtida pelo profissional
     * @param VagaProfissional $vagaProfissional
     * @return array
     */
    public function isCurtidaByProfissional(VagaProfissional $vagaProfissional)
    {
        $sql = 'select * from profissional_vaga AS pv JOIN profissional AS p ON pv.cd_profissional= p.cd_profissional
JOIN vaga AS v ON v.cd_vaga = pv.cd_vaga WHERE pv.cd_vaga = :cd_vaga AND pv.cd_profissional = :cd_profissional' ;


        $db = new db();
        $stmt = db::getInstance()->prepare($sql);
        $run = $stmt->execute(array(
            'cd_vaga' => $vagaProfissional->getVaga()->getCdVaga(),
            'cd_profissional' => $vagaProfissional->getProfissional()->getCdProfissional()
        ));
        return ($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
}