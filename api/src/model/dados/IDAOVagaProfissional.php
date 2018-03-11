<?php
/**
 * Created by PhpStorm.
 * User: Rhuan
 * Date: 10/03/2018
 * Time: 22:33
 */

interface IDAOVagaProfissional
{
    public function curtirVaga(VagaProfissional $vagaProfissional);

    public function isCurtidaByProfissional(VagaProfissional $vagaProfissional);
}