<?php
interface iDAOVaga{

    //Função cadastrar vaga
    public function publicar(Vaga $vaga);

    public function pesquisar(Vaga $vagas, $alt='false' );
}

 ?>