<?php

require_once('../src/model/dados/iDAOEmpresa.php');

class DaoEmpresa implements iDAOEmpresa
{	
	function __construct(){
		
	}
	public function cadastrar(Empresa $emp){
		
		$comando = "insert into empresa (nr_cnpj, ds_razao_social, ds_nome_fantasia, nr_porte, ds_nome_responsavel, ds_area_atuacao, ds_site, ds_telefone, ds_email, ds_senha) values (:nr_cnpj, :ds_razao_social, :ds_nome_fantasia, :nr_porte, :ds_nome_responsavel, :ds_area_atuacao, :ds_site, :ds_telefone, :ds_email, :ds_senha)";
		$stmt = db::getInstance()->prepare($comando);

		$stmt->bindValue(':nr_cnpj', $emp->getNrCnpj());
		$stmt->bindValue(':ds_razao_social', $emp->getDsRazaoSocial());
		$stmt->bindValue(':ds_nome_fantasia', $emp->getDsNomeFantasia());
		$stmt->bindValue(':nr_porte', $emp->getNrPorte());
		$stmt->bindValue(':ds_nome_responsavel', $emp->getDsResponsavelCadastro());
		$stmt->bindValue(':ds_area_atuacao', $emp->getDsAreaAtuacao());
		$stmt->bindValue(':ds_site', $emp->getDsSite());
		$stmt->bindValue(':ds_telefone', $emp->getDsTelefone());
		$stmt->bindValue(':ds_email', $emp->getDsEmail());
		$stmt->bindValue(':ds_senha', $emp->getDsSenha());
		$run = $stmt->execute();
	}
	public function alterar(Empresa $emp){
		$comando = "update empresa set nr_cnpj = :nr_cnpj, ds_razao_social = :ds_razao_social, ds_nome_fantasia = :ds_nome_fantasia, nr_porte = :nr_porte, ds_nome_responsavel = :ds_nome_responsavel, ds_area_atuacao = :ds_area_atuacao, ds_site = :ds_site, ds_telefone = :ds_telefone, ds_email = :ds_email, ds_senha = :ds_senha where cd_empresa = :cd_empresa";
		$stmt = db::getInstance()->prepare($comando);

		$stmt->bindValue(':nr_cnpj', $emp->getNrCnpj());
		$stmt->bindValue(':ds_razao_social', $emp->getDsRazaoSocial());
		$stmt->bindValue(':ds_nome_fantasia', $emp->getDsNomeFantasia());
		$stmt->bindValue(':nr_porte', $emp->getNrPorte());
		$stmt->bindValue(':ds_nome_responsavel', $emp->getDsResponsavelCadastro());
		$stmt->bindValue(':ds_area_atuacao', $emp->getDsAreaAtuacao());
		$stmt->bindValue(':ds_site', $emp->getDsSite());
		$stmt->bindValue(':ds_telefone', $emp->getDsTelefone());
		$stmt->bindValue(':ds_email', $emp->getDsEmail());
		$stmt->bindValue(':ds_senha', $emp->getDsSenha());
		$stmt->bindValue(':cd_empresa', $emp->getCdEmpresa());
		$run = $stmt->execute();
	}

	public function excluir(Empresa $emp){
	}
	public function pesquisar(Empresa $emp, $alt='false'){
		$comando = 'select * from empresa ';
		$where = '';

		if (!empty($emp->getCdEmpresa())){
			if (empty($where)){
				$where = ' where cd_empresa = :cd_empresa';
			}else{
				$where = $where . ' and cd_empresa = :cd_empresa';
			}
		}

		if (!empty($emp->getDsSenha())){
			if (empty($where)){
				$where = ' where ds_senha = :senha';
			}else{
				$where = $where . ' and ds_senha = :senha';
			}
		}
		
		if (!empty($emp->getDsEmail())){
			if (empty($where)){
				$where = ' where (ds_email = :login or ds_cnpj = :login)';
			}else{
				$where = $where . ' and (ds_email = :login or nr_cnpj = :login)';
			}
		}

		
		$db = new db();
		$stmt = db::getInstance()->prepare($comando . $where);
		if (!empty($emp->getCdEmpresa()))
			$stmt->bindValue(':cd_empresa', $emp->getCdEmpresa());
		if (!empty($emp->getDsSenha()))
			$stmt->bindValue(':senha', $emp->getDsSenha());
		if (!empty($emp->getDsEmail()))
			$stmt->bindValue(':login', $emp->getDsEmail());

		$run = $stmt->execute();

		return ($stmt->fetchAll(PDO::FETCH_ASSOC));
	}
}
?>