<?php

require_once('../../model/basica/vaga.php');
require_once('../../model/basica/cargo.php');
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

	$vaga = new Vaga();
	$cargo = new Cargo();
	$vaga->setDsTitulo($titulo);
	$vaga->setNrQtdVaga($quantidadevaga);
	$vaga->setTpContratacao($tipo_contratacao);
	$vaga->setDsBeneficios($beneficios);
	$vaga->setDsHorarioExpediente($jornada_trabalho);
	$vaga->setVlSalario($salario);
	$vaga->setDtCriacao(date("d/m/Y"));
	$vaga->setDtValidade(date("d/m/Y"));
	$vaga->setDsObservacao($observacao);

	$cargo->setCdCargo($cd_cargo);

	$vaga->setCargo($cargo);

	$array = $fachada->publicarVaga($vaga);

	foreach ($array as $key => $value) {
	    if ($key == 'sucess'){
	        echo 1;
	    }else{
	        echo $value; 
	    }
	}
}catch(Exception $e){
	echo $e->getMessage();
}

?>
