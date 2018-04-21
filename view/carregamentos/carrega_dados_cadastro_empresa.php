<?php

$cnpj = $_POST['cnpj'];
//criando o recurso cURL
$cr = curl_init();

//definindo a url de busca 
curl_setopt($cr, CURLOPT_URL, "https://www.receitaws.com.br/v1/cnpj/".$cnpj);

//definindo a url de busca 
curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);

//definindo uma variável para receber o conteúdo da página...
$retorno = curl_exec($cr);

//fechando-o para liberação do sistema.
curl_close($cr); //fechamos o recurso e liberamos o sistema...

//mostrando o conteúdo...
echo $retorno;

?>