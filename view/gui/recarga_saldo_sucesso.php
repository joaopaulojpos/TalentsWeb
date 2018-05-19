<?php
include "menu.php";

  if (!isset($_SESSION['empresaLogada'])) {   //Verifica se h� se��es
    session_destroy();            //Destroi a se��o por seguran�a
    header("Location: login.php"); 
    exit; //Redireciona o visitante para login
  }

  $empresa = $_SESSION['empresaLogada']; 


  if ( isset( $_GET[ 'token' ] ) ) {
    $token = $_GET[ 'token' ];

   /* $nvp = array(
        'TOKEN'     => $token,
        'METHOD'    => 'GetExpressCheckoutDetails',
        'VERSION'   => '124.0', 
                'PWD'       => 'EU4B4FUCA5ZQFVTC',
                'USER'      => 'talents.plataform_api1.gmail.com',
                'SIGNATURE'     => 'AxBJBKQFyfDFiuXqOX27VOyv.6hDAA.Y2hq9FqydG2vgDsH9R.yGs3o1' 
    );

    $curl = curl_init();

    curl_setopt( $curl , CURLOPT_URL , 'https://api-3t.sandbox.paypal.com/nvp' );
    curl_setopt( $curl , CURLOPT_SSL_VERIFYPEER , false );
    curl_setopt( $curl , CURLOPT_RETURNTRANSFER , 1 );
    curl_setopt( $curl , CURLOPT_POST , 1 );
    curl_setopt( $curl , CURLOPT_POSTFIELDS , http_build_query( $nvp ) );

    $response = urldecode( curl_exec( $curl ) ); 
    
    $responseNvp = array();
     

    if ( preg_match_all( '/(?<name>[^\=]+)\=(?<value>[^&]+)&?/' , $response , $matches ) ) {
        foreach ( $matches[ 'name' ] as $offset => $name ) {
            $responseNvp[ $name ] = $matches[ 'value' ][ $offset ];
        }
    }

    if ( isset( $responseNvp[ 'TOKEN' ] ) && isset( $responseNvp[ 'ACK' ] ) ) {
        if ( $responseNvp[ 'TOKEN' ] == $token && $responseNvp[ 'ACK' ] == 'Success' ) {
            $nvp[ 'PAYERID' ]           = $responseNvp[ 'PAYERID' ];
            $nvp[ 'PAYMENTREQUEST_0_AMT' ]      = $responseNvp[ 'PAYMENTREQUEST_0_AMT' ];
            $nvp[ 'PAYMENTREQUEST_0_CURRENCYCODE' ] = $responseNvp[ 'PAYMENTREQUEST_0_CURRENCYCODE' ];
                       // $nvp[ 'SUBJECT' ]                       = $responseNvp[ 'SUBJECT' ];
            $nvp[ 'METHOD' ]            = 'DoExpressCheckoutPayment';
            $nvp[ 'PAYMENTREQUEST_0_PAYMENTACTION' ]= 'SALE'; 
            curl_setopt( $curl , CURLOPT_POSTFIELDS , http_build_query( $nvp ) );

            $response = urldecode( curl_exec( $curl ) );
            $responseNvp = array();

            if ( preg_match_all( '/(?<name>[^\=]+)\=(?<value>[^&]+)&?/' , $response , $matches ) ) {
                foreach ( $matches[ 'name' ] as $offset => $name ) {
                    $responseNvp[ $name ] = $matches[ 'value' ][ $offset ];
                }
            }
            if ( $responseNvp[ 'PAYMENTINFO_0_PAYMENTSTATUS' ] == 'Completed' ) {
              
                echo 'Parabéns, sua compra foi concluída com sucesso';
                                echo '<br />';
                                echo '<br />';
            } else {
                echo 'Não foi possível concluir a transação';
            }
        } else {
            echo 'Não foi possível concluir a transação';
        }
    } else {
        echo 'Não foi possível concluir a transação';
    }
   echo $response;
   curl_close( $curl );*/
}

?>

<section class="section">
        <div>
            <div class="row">
                <div class="col s12 m4 push-m4">
                    <div class="card white altcard">
                        <div class="card-content white-text">
                            <span class="card-title grey-text">Recarga efetuada com sucesso!</span>
                            <p><h2 class="center-align grey-text">Confirmado!</h2></p>
                            <p class="center-align grey-text">Seu saldo atual é: <?php echo 'R$ ' . number_format($empresa[0]['vl_saldo'], 2, '.', ''); ?> e já pode ser utilizado!</p>
                            <p class="center-align grey-text" style="margin-top: 15px;">
	                            <form method="get" action="dashboard.php">
	                            	<button class="btn waves-effect waves-light col s12 m12 teal darken-1" type="submit" id="buttonSubmit" name="buttonSubmit">Continuar</button>
	                        	</form>
	                        </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </section>
<?php

include "foooter.php";

?>

<!-- SCRIPT MANUAIS -->

