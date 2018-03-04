<?php
interface iDAOVaga{

    //Função cadastrar vaga
    public function cadastrar(Vaga $vaga);

    public function pesquisar(Vaga $vagas, $alt='false' );
}

 ?>