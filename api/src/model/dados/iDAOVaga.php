<?php
interface iDAOVaga{

    //Função cadastrar vaga
    public function publicar(Vaga $vaga);

    public function pesquisar(Vaga $vagas, $alt='false' );

    public function curtirVaga($tp_acao,$cd_vaga,$cd_profissional);

    public function isCurtidaByProfissional($cd_vaga,$cd_profissional);
}

?>