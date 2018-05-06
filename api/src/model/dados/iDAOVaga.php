<?php
interface iDAOVaga{

    //Função cadastrar vaga
    public function salvar(Vaga $vaga);

    public function publicar($cd_vaga);

    public function pesquisar(Vaga $vagas, $alt='false' );

    public function curtirVaga($tp_acao,$cd_vaga,$cd_profissional);

    public function isCurtidaByProfissional($cd_vaga,$cd_profissional);

    public function fecharVaga($cd_vaga);
}

?>