<?php

require_once('../src/model/dados/idaoperguntaperfilcomp.php');

class DaoPerguntaperfilcomp implements iDAOperguntaperfilcomp
{	
	function __construct(){
		
	}

	public function listarPerguntas(){
		try{
			$comando = 'select cd_pergunta_perfil_comp,ds_pergunta from pergunta_perfil_comp';


			$stmt = db::getInstance()->prepare($comando);

            $listaPerguntas = [];
			$run = $stmt->execute();
            $result =$stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row){
                $pergunta = new perguntaperfilcomp();
                $pergunta->setCdPergunta($row['cd_pergunta_perfil_comp']);
                $pergunta->setDsPergunta($row['ds_pergunta']);
                foreach ($this->listarRespostas($pergunta->getCdPergunta()) as $alternativa) {
                    $pergunta->setAlternativas($alternativa);
                }
                array_push($listaPerguntas,$pergunta);
            }

			return $listaPerguntas;

		}catch(Exception $e){
			throw new Exception($e->getMessage());
		}finally{
			$stmt->closeCursor();
		}
	}

    public function listarRespostas($cd_pergunta){
	    try{
	    $comando = 'select cd_alternativa_perfil_comp,nr_letra_ref,ds_resposta 
                    from alternativa_perfil_comp 
                    where cd_pergunta_perfil_comp = :cd_pergunta';
	    $stmt = db::getInstance()->prepare($comando);
	    $stmt->bindValue(':cd_pergunta', $cd_pergunta);

        $run = $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listaRespostas = [];
        foreach ($result as $row){
            $alternativa = new alternativaperfilcomp();
            $alternativa->setCdAlternativaPerfilComp($row['cd_alternativa_perfil_comp']);
            $alternativa->setNrLetraRef($row['nr_letra_ref']);
            $alternativa->setDsResposta($row['ds_resposta']);
            array_push($listaRespostas,$alternativa);
        }
        return $listaRespostas;

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }




    public function cadastrarResposta($cd_pergunta_perfil_comp,$cd_profissional,$resposta){
        try{
            $sql = "insert into profissional_alternativa_perfil_comp (cd_alternativa_perfil_comp,cd_profissional,cd_pergunta_perfil_comp) 
                             values (:cd_alternativa_perfil_comp,:cd_profissional,:cd_pergunta_perfil_comp)";

            $stmt = db::getInstance()->prepare($sql);
            $run = $stmt->execute(array(
                ':cd_alternativa_perfil_comp' => $resposta,
                ':cd_profissional' => $cd_profissional,
                ':cd_pergunta_perfil_comp' => $cd_pergunta_perfil_comp
            ));

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }finally{
            $stmt->closeCursor();
        }
    }
    

}
?>