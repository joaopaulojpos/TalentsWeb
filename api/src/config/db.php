<?php
    class db {

    //USANDO PDO
    public static $instance;
    public function __construct() {
        $this->getInstance();
    }
    public static function getInstance() {
        if (!isset(self::$instance)) {
            //self::$instance = new PDO('mysql:host=localhost;dbname=id4854326_db_talents', 'id4854326_teste', '123456', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance = new PDO('mysql:host=localhost;dbname=id4854326_db_talents', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            //self::$instance = new PDO('mysql:host=mysql107.prv.f1.k8.com.br;dbname=plataformatalents', 'plataformatalen', 'talents2018', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
        return self::$instance;
    }
}

?>