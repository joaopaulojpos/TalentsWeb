<?php
/**
 * Created by PhpStorm.
 * User: Rhuan
 * Date: 10/03/2018
 * Time: 22:33
 */

interface IDAOVagaProfissional
{
    public function curtirVaga($tp_acao,$cd_vaga,$cd_profissional);

    public function isCurtidaByProfissional($cd_vaga,$cd_profissional);
}