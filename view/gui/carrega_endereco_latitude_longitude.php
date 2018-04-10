<?php       	  

//Buscando localização da vaga
$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];

$ds_localizacao = '';

try{
//criando o recurso cURL
  $cr = curl_init();
  //definindo a url de busca 
  curl_setopt($cr, CURLOPT_URL, "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude);
  //definindo a url de busca 
  curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
  //definindo uma variável para receber o conteúdo da página...
  $retorno = json_decode(curl_exec($cr), true);
  //fechando-o para liberação do sistema.
  curl_close($cr); //fechamos o recurso e liberamos o sistema...

  var_dump($retorno);
  //mostrando o conteúdo...          
  foreach ($retorno["results"] as $key => $retorno) {
    $ds_localizacao = $retorno["formatted_address"];
    break;
  }

  echo trim($ds_localizacao);
}catch(Exception $e){
  echo trim($e->getMessage());
}

?>              