<?php

require_once('../../controller/fachada.php');


try{

	$cd_vaga = $_POST['cd_vaga'];
	$tp_status = $_POST['tp_status'];

	$fachada = Fachada::getInstance();

	if ($tp_status == 'A'){
		$array = $fachada->publicarVaga($cd_vaga);
	}else if ($tp_status == 'F'){
		$array = $fachada->fecharVaga($cd_vaga);
	}else{
		echo 'Comando inválido';
	}
	
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