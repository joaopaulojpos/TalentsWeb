
<?php

require_once('../../controller/fachada.php');

session_name('sessao');
session_start();

try{

	$fachada = Fachada::getInstance();

	$array = $fachada->empresaLogar($_POST['username'], $_POST['password']);

	foreach ($array as $key => $value) {
	    if ($key == 'sucess'){
	        $_SESSION['empresaLogada'] = json_decode(json_encode($value), true);
	        echo 1;
	    }else{
	        echo $value;   
	    }
	}
}catch(Exception $e){
	echo $e->getMessage();
}

?>