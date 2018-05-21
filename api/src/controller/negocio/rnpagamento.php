<?php

require_once('../src/model/dados/daopagamento.php');

class RNPagamento{

	public function cadastrar(Pagamento $pagamento){	
		try{
			$daopagamento = new DaoPagamento();
			$result = $daopagamento->cadastrar($pagamento);

			return array('sucess' => 'Cadastrado com sucesso!');

		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}
	}

	public function finalizar(Pagamento $pagamento){	
		try{
			$daopagamento = new DaoPagamento();
			$result = $daopagamento->finalizar($pagamento);

			return array('sucess' => 'Finalizado com sucesso!');

		}catch (Exception $e){
			return array('erro' => $e->getMessage());
		}
	}
}

?>