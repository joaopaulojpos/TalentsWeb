<?php

require_once('../../controller/fachada.php');


try{

	$cd_vaga = $_POST['cd_vaga'];

	$fachada = Fachada::getInstance();

	$array = $fachada->publicarVaga($cd_vaga);

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