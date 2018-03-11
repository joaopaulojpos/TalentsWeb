<?php
/**
 * Created by PhpStorm.
 * User: Rhuan
 * Date: 10/03/2018
 * Time: 21:27
 */

class VagaProfissional
{
    private $tp_acao;
    private $vaga;
    private $profissional;

    public function __construct(){}

    /**
     * @return mixed
     */
    public function getTpAcao()
    {
        return $this->tp_acao;
    }

    /**
     * @param mixed $tp_acao
     */
    public function setTpAcao($tp_acao)
    {
        $this->tp_acao = $tp_acao;
    }

    /**
     * @return mixed
     */
    public function getVaga()
    {
        return $this->vaga;
    }

    /**
     * @param Vaga $vaga
     */
    public function setVaga(Vaga $vaga)
    {
        $this->vaga = $vaga;
    }

    /**
     * @return Profissional
     */
    public function getProfissional()
    {
        return $this->profissional;
    }

    /**
     * @param Profissional $profissional
     */
    public function setProfissional(Profissional $profissional)
    {
        $this->profissional = $profissional;
    }
}