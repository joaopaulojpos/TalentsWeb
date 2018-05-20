<?php

require_once('../../controller/fachada.php');


try{

	$fachada = Fachada::getInstance();

	$array = $fachada->likeProfissionalVaga($_POST['cd_vaga'], $_POST['cd_profissional']);

	$texto = '';

	foreach ($array as $key => $value) {
	    if ($key == 'sucess'){
	        echo 1;
	    }elseif($key == 'topic'){

        }else{
	    	echo $value;
	    }
	}

}catch(Exception $e){
	echo $e->getMessage();
}

?>