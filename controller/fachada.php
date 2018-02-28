<?php
    require_once('../../model/basica/empresa.php');
    require_once('../../model/dados/DAOEmpresa.php');

    class Fachada {

    //USANDO PDO
    public static $instance;
    public function __construct() {
        if ( session_status() !== PHP_SESSION_ACTIVE )
            session_start();
    }
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new Fachada();
        }
        return self::$instance;
    }


   /* public function __construct(){
        session_start();
        $usuario = NULL;
        if($this->isLoggedUser())   
            $usuario = $this->getUser();
    
        $this->set("usuario", $usuario);
    }

    /*public function set($nome , $valor){
        global $variables;
        $variables[$nome] = $valor;
    }*/
    
    public function startLogin($empresa){
        session_unset('empresa');
        $_SESSION['empresa'] = $empresa;
    }
    public function getUser(){
        return $_SESSION['usuario'];
    }
    public function getIdUser(){
        return $_SESSION['usuario'][0]["id"];
    }
    public function isLoggedUser(){
        return (isset($_SESSION['usuario']))? true : false;     
    }
    public function stopLogin(){
        session_destroy();
    }



    //EMPRESA
    public function empresaCadastrar($empresa){
        $daoempresa = new DaoEmpresa();
        $result = json_decode($daoempresa->cadastrar($empresa));
        $mensagem = '';

        foreach ($result as $key => $value) {
            if ($key == 'sucess'){
                $this->empresaLogar($empresa->getDsEmail(), $empresa->getDsSenha());
            }else{
                unset ($_SESSION['empresa']);
                $_SESSION['mensagem'] = $value;   
                $mensagem = header("location: cadastro.php"); 
            }
        }
    }

    public function empresaLogar($login, $senha){
        $daoempresa = new DaoEmpresa();
        $empresa = new Empresa();
        $empresa->setDsEmail($login);
        $empresa->setDsSenha($senha);
        $result = json_decode($daoempresa->logar($empresa));
        $mensagem = '';

        foreach ($result as $key => $value) {
            if ($key == 'sucess'){
                $_SESSION['empresa'] = json_decode(json_encode($value), true);
                $mensagem = header("location: vaga.php");
            }else{
                unset ($_SESSION['empresa']);
                $_SESSION['mensagem'] = $value;   
                $mensagem = header("location: login.php"); 
            }
        }
    }
}