<?php

interface iDAOEmpresa
{
	public function cadastrar(Empresa $u);
	public function alterar(Empresa $u);
	public function excluir(Empresa $u);
	public function pesquisar(Empresa $u, $alt='false' );
    public function pesquisarVagas(Empresa $emp);
	public function match($cd_vaga,$cd_profissional);
	public function recarregarSaldo(Empresa $u, $vl_recarga);
}

?>