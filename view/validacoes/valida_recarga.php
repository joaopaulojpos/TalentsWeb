<?php
//Incluindo o arquivo que contém a função sendNvpRequest
require 'sendNvpRequest.php';
require_once('../../model/basica/pagamento.php');
require_once('../../controller/fachada.php');
 
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
    'PAYMENTREQUEST_0_AMT' => $_POST['valor'],
    'PAYMENTREQUEST_0_CURRENCYCODE' => 'BRL',
    'PAYMENTREQUEST_0_ITEMAMT' => $_POST['valor'],
    'L_PAYMENTTYPE0' => 'Any',
    'SOLUTIONTYPE' => 'Sole',
    'LANDINGPAGE' => 'Billing',
    'NOSHIPPING' => '1',
    'LOGOIMG' => 'http://plataformatalent.tmp.k8.com.br/view/gui/images/logo.png',
    'TOTALTYPE' => 'Total',
    'BRANDNAME' => 'Talents',
  
    'L_PAYMENTREQUEST_0_NAME0' => 'Recarga Talents',
    'L_PAYMENTREQUEST_0_DESC0' => 'Recarga de saldo',
    'L_PAYMENTREQUEST_0_AMT0' => $_POST['valor'],
    'L_PAYMENTREQUEST_0_QTY0' => '1',
    'L_PAYMENTREQUEST_0_ITEMAMT' => $_POST['valor'],
    'L_PAYMENTREQUEST_0_ITEMCATEGORY0' => 'Digital',

    'HDRIMG' => 'https://www.paypal-brasil.com.br/desenvolvedores/wp-content/uploads/2014/04/hdr.png',
    'LOCALECODE' => 'pt_BR',
 
    'RETURNURL' => 'http://plataformatalent.tmp.k8.com.br/view/gui/recarga_saldo_sucesso.php',
    'CANCELURL' => 'http://plataformatalent.tmp.k8.com.br/view/gui/dashboard.php',
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

    $valor = $_POST['valor'];
    $cd_empresa = $_POST['cd_empresa'];
    $token = $responseNvp['TOKEN'];

    $fachada = Fachada::getInstance();
    $pagamento = new Pagamento();
    $pagamento->setCdEmpresa($cd_empresa);
    $pagamento->setVlRecarga($valor);
    $pagamento->setToken($token);
    $array = $fachada->pagamentoCadastrar($pagamento);

    $texto = '';

    foreach ($array as $key => $value) {
        if ($key == 'sucess'){
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

    $redirectURL = sprintf('%s?%s', $paypalURL, http_build_query($query));
 
    header("Location: " . $redirectURL);
} else {
    //Opz, alguma coisa deu errada.
    //Verifique os logs de erro para depuração.
    echo var_dump($responseNvp);
    die;
}
