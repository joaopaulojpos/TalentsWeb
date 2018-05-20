<?php
//Incluindo o arquivo que contém a função sendNvpRequest
require 'sendNvpRequest.php';
 
//Vai usar o Sandbox, ou produção?
$sandbox = true;
 
//Baseado no ambiente, sandbox ou produção, definimos as credenciais
//e URLs da API.
if ($sandbox) {
    //credenciais da API para o Sandbox
    $user = 'talents.plataform_api1.gmail.com';
    $pswd = 'EU4B4FUCA5ZQFVTC';
    $signature = 'AxBJBKQFyfDFiuXqOX27VOyv.6hDAA.Y2hq9FqydG2vgDsH9R.yGs3o1';
 
    //URL da PayPal para redirecionamento, não deve ser modificada
    $paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
} else {
    //credenciais da API para produção
    $user = 'usuario';
    $pswd = 'senha';
    $signature = 'assinatura';
 
    //URL da PayPal para redirecionamento, não deve ser modificada
    $paypalURL = 'https://www.paypal.com/cgi-bin/webscr';
}
 
//Campos da requisição da operação SetExpressCheckout, como ilustrado acima.
$requestNvp = array(
    'USER' => $user,
    'PWD' => $pswd,
    'SIGNATURE' => $signature,
 
    'VERSION' => '108.0',
    'METHOD'=> 'SetExpressCheckout',

    'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
    'PAYMENTREQUEST_0_AMT' => '11.00',
    'PAYMENTREQUEST_0_CURRENCYCODE' => 'BRL',
    'PAYMENTREQUEST_0_ITEMAMT' => '11.00',
    'PAYMENTREQUEST_0_INVNUM' => '777777',
    'L_PAYMENTTYPE0' => 'Any',
    'SOLUTIONTYPE' => 'Sole',
    'LANDINGPAGE' => 'Billing',
    'NOSHIPPING' => '1',
    'LOGOIMG' => 'https://www.iotalents.com/v2/images/logo.png',
    'TOTALTYPE' => 'Total',
    'BRANDNAME' => 'Talents',
  
    'L_PAYMENTREQUEST_0_NAME0' => 'Item A',
    'L_PAYMENTREQUEST_0_DESC0' => 'Produto A – 110V',
    'L_PAYMENTREQUEST_0_AMT0' => '11.00',
    'L_PAYMENTREQUEST_0_QTY0' => '1',
    'L_PAYMENTREQUEST_0_ITEMAMT' => '11.00',
    'L_PAYMENTREQUEST_0_ITEMCATEGORY0' => 'Digital',

    'HDRIMG' => 'https://www.paypal-brasil.com.br/desenvolvedores/wp-content/uploads/2014/04/hdr.png',
    'LOCALECODE' => 'pt_BR',
 
    'RETURNURL' => 'http://plataformatalent.tmp.k8.com.br/view/gui/recarga_saldo_sucesso.php',
    'CANCELURL' => 'http://plataformatalent.tmp.k8.com.br/view/gui/recarga_saldo_cancelado.php',
    'BUTTONSOURCE' => 'BR_EC_EMPRESA'
);
 
//Envia a requisição e obtém a resposta da PayPal
$responseNvp = sendNvpRequest($requestNvp, $sandbox);
 
//Se a operação tiver sido bem sucedida, redirecionamos o cliente para o
//ambiente de pagamento.
if (isset($responseNvp['ACK']) && $responseNvp['ACK'] == 'Success') {
    $query = array(
        'cmd'    => '_express-checkout',
        'token'  => $responseNvp['TOKEN']
    );
 
    $redirectURL = sprintf('%s?%s', $paypalURL, http_build_query($query));
 
    header("Location: " . $redirectURL);
} else {
    //Opz, alguma coisa deu errada.
    //Verifique os logs de erro para depuração.
    echo var_dump($responseNvp);
    die;
}
