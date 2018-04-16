<?php
interface iDAOPerguntaperfilcomp{

    public function listarPerguntas();
    public function listarRespostas($cd_pergunta);
    public function cadastrarResposta($cd_alternativa_perfil_comp,$cd_profissional,$cd_pergunta_perfil_comp);
    public function CalculoPerfilComp($cd_profissional);
}

 ?>