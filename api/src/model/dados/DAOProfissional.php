<?php
require_once('../src/model/basica/Profissional.php');
require_once('../src/model/dados/iDAOProfissional.php');
require_once('../src/config/db.php');

class DaoProfissional implements iDAOProfissional
{	
	function __construct(){
		
	}
	public function cadastrar(Profissional $u){
		$comando = "insert into profissional (b_foto,ds_senha,dt_nascimento,ds_email,nr_latitude,nr_longitude,tp_conta,tp_sexo,ds_nome) 
		            values (:b_foto,:ds_senha,:dt_nascimento,:ds_email,:nr_latitude,:nr_longitude,:tp_conta,:tp_sexo,:ds_nome)";
		$stmt = db::getInstance()->prepare($comando);
		$run = $stmt->execute(array(
    			':b_foto' => $u->getBfoto(),
    			':ds_senha' => $u->getDsSenha(),
    			':dt_nascimento' => $u->getDtNascimento(),
				':ds_email' => $u->getDsEmail(),
				':nr_latitude' => $u->getNrlatitude(),
				':nr_longitude' => $u->getNrlogitude(),
				':tp_conta' => $u->getTpconta(),
				':tp_sexo' => $u->getTpsexo(),
				':ds_nome' => $u->getDsnome(),
 		));
	}
	public function alterar(Profissional $u){
		$comando = "update profissional set b_foto = :b_foto, ds_senha = :ds_senha, dt_nascimento = :dt_nascimento, ds_email = :ds_email,nr_latitude= :nr_latitude,nr_longitude = :nr_latitude,tp_conta= :tp_conta,tp_sexo = :tp_sexo,ds_nome = :ds_nome where cd_profissional = :cd_profissional";
		$stmt = db::getInstance()->prepare($comando);
		$run = $stmt->execute(array(
				':b_foto' => $u->getBfoto(),
    			':ds_senha' => $u->getDsSenha(),
    			':dt_nascimento' => $u->getDtNascimento(),
				':ds_email' => $u->getDsEmail(),
				':nr_latitude' => $u->getNrlatitude(),
				':nr_longitude' => $u->getNrlogitude(),
				':tp_conta' => $u->getTpconta(),
				':tp_sexo' => $u->getTpsexo(),
				':ds_nome' => $u->getDsnome(),
				':cd_profissional' => $u->getCdProfissional()
 		));
	}
	public function excluir(Profissional $u){
	}
	public function pesquisar(Profissional $u, $alt='false'){
		$comando = 'select * from profissional ';
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