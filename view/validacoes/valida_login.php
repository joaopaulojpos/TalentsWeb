<?php

require_once('../../controller/fachada.php');


try{

	$fachada = Fachada::getInstance();

	$array = $fachada->empresaLogar($_POST['username'], $_POST['password']);

	$texto = '';

	foreach ($array as $key => $value) {
	    if ($key == 'sucess'){
	    	$_SESSION['empresaLogada'] = json_decode(json_encode($value), true);
	        echo 1;
	    }else{
	    	if (is_array($value)){	
		    	foreach ($value as $key => $value2) {
		        	$texto = $texto.'<br>*'.$value2;
		    	}
	    	}else{
	    		$texto = $value;
	    	}
	    	echo $texto; 
	    }
	}

}catch(Exception $e){
	echo $e->getMessage();
}

?>