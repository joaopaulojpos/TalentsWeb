<?php

require_once('../../model/basica/vaga.php');
require_once('../../model/basica/cargo.php');
require_once('../../model/basica/idioma.php');
require_once('../../model/basica/competenciatecnica.php');
require_once('../../model/basica/competenciacomport.php');
require_once('../../model/basica/curso.php');
require_once('../../controller/fachada.php');

try{
	$fachada = Fachada::getInstance();

	$titulo = $_POST['titulo'];
	$cd_cargo = $_POST['cargo'];
	$observacao = $_POST['observacao'];
	$tipo_contratacao = $_POST['tipocontratacao'];
	$salario = $_POST['salario'];
	$jornada_trabalho = $_POST['jornadatrabalho'];
	$experiencia = $_POST['experiencia'];
	$quantidadevaga = $_POST['quantidadevagas'];
	$beneficios = $_POST['beneficios'];
	$idiomaCodigo = json_decode(stripslashes($_POST['idiomaCodigo']));
	$idiomaNivel = json_decode(stripslashes($_POST['idiomaNivel']));
	$tecnicaCodigo = json_decode(stripslashes($_POST['tecnicaCodigo']));
	$comportCodigo = json_decode(stripslashes($_POST['comportCodigo']));
	$cursoCodigo = json_decode(stripslashes($_POST['cursoCodigo']));

	//Inicializando os objetos
	$vaga = new Vaga();
	$cargo = new Cargo();
	$idioma = new Idioma();

	//preenchendo os campos do objeto vaga
	$vaga->setDsTitulo($titulo);
	$vaga->setNrQtdVaga($quantidadevaga);
	$vaga->setTpContratacao($tipo_contratacao);
	$vaga->setDsBeneficios($beneficios);
	$vaga->setDsHorarioExpediente($jornada_trabalho);
	$vaga->setVlSalario($salario);
	$vaga->setDtCriacao(date("Y-m-d"));
	$vaga->setDtValidade(date("Y-m-d"));
	$vaga->setDsObservacao($observacao);
	$vaga->setNrExperiencia($experiencia);

	//prenchendo os campos do objeto cargo 
	$cargo->setCdCargo($cd_cargo);

	//preenchendo na vaga os idiomas
	for ($i = 0; $i < sizeof($idiomaCodigo); $i++) {
    	$idioma = new Idioma();
    	$idioma->setCdIdioma($idiomaCodigo[$i]);
    	$idioma->setNrNivel($idiomaNivel[$i]);

		$vaga->setIdiomas($idioma); 
	}

	//preenchendo na vaga as habilidades
	for ($i = 0; $i < sizeof($tecnicaCodigo); $i++) {
    	$competenciatecnica = new CompetenciaTecnica();
    	$competenciatecnica->setCdCompetenciaTecnica($tecnicaCodigo[$i]);

		$vaga->setCompetenciasTecnicas($competenciatecnica); 
	}

	//preenchendo na vaga as habilidades
	for ($i = 0; $i < sizeof($comportCodigo); $i++) {
    	$competenciacomport = new CompetenciaComport();
    	$competenciacomport->setCdCompetenciaComport($comportCodigo[$i]);

		$vaga->setCompetenciasComport($competenciacomport); 
	}

	//preenchendo na vaga os cursos
	for ($i = 0; $i < sizeof($cursoCodigo); $i++) {
    	$curso = new Curso();
    	$curso->setCdCurso($cursoCodigo[$i]);

		$vaga->setCursos($curso); 
	}

	$vaga->setCargo($cargo);

	$array = $fachada->publicarVaga($vaga);

	if ($array == null){
		echo 'Cadastrado com sucesso!';
		exit;
	}


	foreach ($array as $key => $value) {
	    if ($key == 'sucess'){
	        echo 1;
	    }else{
	    	$texto = 'Verifique as mensagens abaixo para prosseguir com o cadastro da vaga: <br>';
	    	foreach ($value as $key => $value2) {
	        	$texto = $texto.'<br>*'.$value2;
	    	}
	    	echo $texto; 
	    }
	}
	
	
}catch(Exception $e){
	echo $e->getMessage();
}

?>
