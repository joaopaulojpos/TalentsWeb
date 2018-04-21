<?php
/**
 * Created by PhpStorm.
 * User: Rhuan
 * Date: 10/03/2018
 * Time: 18:32
 */

class RequestMethods
{

     public static $url = "http://talents.heliohost.org/api/public/api";
     //http://localhost/talentsweb/api/public/api

    /**
     * @param $url
     * @param $params
     * @return mixed|string
     */
    public function get($url){

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
        $result = curl_exec($ch); 

        if(curl_errno($ch) !== 0) { 
            return json_encode('Erro: não foi possível conectar ao servidor!'); 
        } 
        curl_close($ch); 
        return $result; 
    }

    public function post($url, $params){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            http_build_query($params));
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        // This should be the default Content-type for POST requests
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));
        $result = curl_exec($ch);

        if(curl_errno($ch) !== 0) {
            return json_encode('Erro: não foi possível conectar ao servidor!');
        }
        curl_close($ch);
        return $result;
    }
}