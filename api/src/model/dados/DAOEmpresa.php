<?php
require_once('../src/model/basica/Empresa.php');
require_once('../src/model/dados/iDAOEmpresa.php');
require_once('../src/config/db.php');

class DaoEmpresa implements iDAOEmpresa
{	
	function __construct(){
		
	}
	public function cadastrar(Empresa $u){
		$comando = "insert into empresa (nome, sobrenome, login, senha) values (:nome, :sobrenome, :login, :senha)";
		$stmt = db::getInstance()->prepare($comando);
		$run = $stmt->execute(array(
    			':nome' => $u->getNome(),
    			':sobrenome' => $u->getSobrenome(),
    			':login' => $u->getLogin(),
				':senha' => $u->getSenha()
 		));
	}
	public function alterar(Empresa $u){
		$comando = "update tb_Empresa set nome = :nome, sobrenome = :sobrenome, login = :login, senha = :senha where id = :id";
		$stmt = db::getInstance()->prepare($comando);
		$run = $stmt->execute(array(
    			':nome' => $u->getNome(),
    			':sobrenome' => $u->getSobrenome(),
    			':login' => $u->getLogin(),
				':senha' => $u->getSenha(),
				':id' => $u->getId()
 		));
	}
	public function excluir(Empresa $u){
	}
	public function pesquisar(Empresa $u, $alt='false'){
		$comando = 'select * from empresa ';
		$where = '';



		if (!empty($u->getDsSenha())){
			if (empty($where)){
				$where = ' where ds_senha = :senha';
			}else{
				$where = $where . ' and ds_senha = :senha';
			}
		}
		
		if (!empty($u->getDsEmail())){
			if (empty($where)){
				$where = ' where ds_email = :email';
			}else{
				$where = $where . ' and ds_email = :email';
			}
		}

		
		$db = new db();
		$stmt = db::getInstance()->prepare($comando . $where);
		if (!empty($u->getDsSenha()))
			$stmt->bindValue(':senha', $u->getDsSenha());
		if (!empty($u->getDsEmail()))
			$stmt->bindValue(':email', $u->getDsEmail());

		$run = $stmt->execute();

		return ($stmt->fetchAll(PDO::FETCH_ASSOC));
	}
}
?>