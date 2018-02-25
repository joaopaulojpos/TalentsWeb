<?php

interface iDAOEmpresa
{
	public function cadastrar(Empresa $u);
	public function alterar(Empresa $u);
	public function excluir(Empresa $u);
	public function pesquisar(Empresa $u, $alt='false' );
}

?>