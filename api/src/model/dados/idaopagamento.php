<?php
interface iDAOPagamento{

    public function cadastrar(Pagamento $p);
	public function finalizar(Pagamento $p);

}

?>