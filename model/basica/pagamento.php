<?php
class pagamento implements JsonSerializable
{

    private $cd_pagamento;
    
    private $vl_recarga;
    private $dt_recarga;
    private $token;
    private $payerid;
    private $tp_status;

    private $cd_empresa;


    function __construct(){}

    function setCdPagamento($cd_pagamento){
        $this->cd_pagamento = trim($cd_pagamento);
    }
    function getCdPagamento(){
        return $this->cd_pagamento;
    }

    function setVlRecarga($vl_recarga){
        $this->vl_recarga = trim($vl_recarga);
    }
    function getVlRecarga(){
        return $this->vl_recarga;
    }

    function setToken($token){
        $this->token = trim($token);
    }
    function getToken(){
        return $this->token;
    }

    function setPayerId($payerid){
        $this->payerid = trim($payerid);
    }
    function getPayerId(){
        return $this->payerid;
    }

    function setTpStatus($tp_status){
        $this->tp_status = trim($tp_status);
    }
    function getTpStatus(){
        return $this->tp_status;
    }

    function setCdEmpresa($cd_empresa){
        $this->cd_empresa = trim($cd_empresa);
    }
    function getCdEmpresa(){
        return $this->cd_empresa;
    }


    public function jsonSerialize(){
        return
            [
                'cd_pagamento'=>$this->cd_pagamento,
                'vl_recarga'=>$this->vl_recarga,
                'dt_recarga'=>$this->dt_recarga,
                'token'=>$this->token,
                'payerid'=>$this->payerid,
                'tp_status'=>$this->tp_status,
                'cd_empresa'=>$this->cd_empresa
            ];
    }
}
 ?>