<?php
    require_once('../../model/basica/empresa.php');
    require_once('../../model/dados/DAOEmpresa.php');
    require_once('../../model/basica/vaga.php');
    require_once('../../model/dados/DAOVaga.php');
    require_once('../../model/basica/cargo.php');
    require_once('../../model/dados/DAOCargo.php');


    class Fachada {

    //USANDO PDO
    public static $instance;
    public function __construct() {

    }
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new Fachada();
        }
        return self::$instance;
    }


    //EMPRESA
    public function empresaCadastrar($empresa){
        $daoempresa = new DaoEmpresa();
        $result = json_decode($daoempresa->cadastrar($empresa));
        
        return json_decode(json_encode($result, true));
    }

    public function empresaLogar($login, $senha){
        $daoempresa = new DaoEmpresa();
        $empresa = new Empresa();
        $empresa->setDsEmail($login);
        $empresa->setDsSenha($senha);
        $result = json_decode($daoempresa->logar($empresa));
        
        return json_decode(json_encode($result, true));
    }

    //Vaga
    public function publicarVaga($vaga){
        $daovaga = new DAOVaga();
        $result = json_decode($daovaga->publicar($vaga));

        echo var_dump($result);
        
        return json_decode(json_encode($result, true));
    }   

    public function pesquisarVagas($vaga){
        $daovaga = new DAOVaga();
        return $daovaga->pesquisar($vaga);
    }

    //Cargo
    public function cargoPesquisar(){
        $daocargo = new DAOCargo();
        $cargo = new Cargo();
        $result = json_decode($daocargo->pesquisar($cargo));
        
        return json_decode(json_encode($result, true));
    }
}