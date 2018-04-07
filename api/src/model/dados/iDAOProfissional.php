<?php

interface iDAOProfissional
{
	public function cadastrar(Profissional $u);
	public function alterar(Profissional $u);
	public function excluir(Profissional $u);
	public function pesquisar(Profissional $u, $alt='false' );
    public function listarVagaProfissional($cd_profissional);
    public function listarProfissionalVaga($cd_vaga);
}

?>