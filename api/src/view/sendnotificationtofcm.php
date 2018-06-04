<?php
/**
 * Created by PhpStorm.
 * User: Rhuan
 * Date: 18/05/2018
 * Time: 09:57
 */

use paragraph1\phpFCM\Client;
use paragraph1\phpFCM\Message;
use paragraph1\phpFCM\Recipient\Topic;
use paragraph1\phpFCM\Notification;


class sendnotificationtofcm
{

    public function sendtotopic($topic,$notification)
    {
        try {
            $apiKey = 'AAAAOF3Q56o:APA91bG_xHb9D7xhSpkHy--ntyz96pNJfp-FtNQ1OPi1YAO4PX1FCe6gTcD2eblZfd0iBwKHxEqrBGZCDd-9mbueP5mm2LKwLvT04XaLtpZUO7zRSb_C3RJUfd45_HT2Fn6pB9L8zwvE';
            $client = new Client();
            $client->setApiKey($apiKey);
            $client->injectHttpClient(new \GuzzleHttp\Client());

            $message = new Message();
            $message->addRecipient(new Topic($topic));
            $message->setNotification(new Notification('Vagas Talents', 'Parabéns, você foi selecionado pela empresa '
                . $notification['ds_nome_fantasia']
                . ' para a vaga de ' . $notification['ds_titulo']));
            //$message->setNotification(new Notification($notification['title'], $notification['body']));

            $response = $client->send($message);
            if($response->getStatusCode() == 200){
                return $response->getStatusCode();
            }
            else{
                return 0;
            }

        }catch (\GuzzleHttp\Exception\ConnectException $e){
            return array('erro' => $e->getMessage());
        }
    }

    public function sendtouser($token)
    {
        $apiKey = 'AAAAOF3Q56o:APA91bG_xHb9D7xhSpkHy--ntyz96pNJfp-FtNQ1OPi1YAO4PX1FCe6gTcD2eblZfd0iBwKHxEqrBGZCDd-9mbueP5mm2LKwLvT04XaLtpZUO7zRSb_C3RJUfd45_HT2Fn6pB9L8zwvE';
        $client = new Client();
        $client->setApiKey($apiKey);
        $client->injectHttpClient(new \GuzzleHttp\Client());

        $note = new Notification('test title', 'testing body');
        $note->setIcon('notification_icon_resource_name')
            ->setColor('#ffffff')
            ->setBadge(1);

        $message = new Message();
        $message->addRecipient(new Device($token));
        $message->setNotification($note)
            ->setData(array('someId' => 111));

        $response = $client->send($message);
        var_dump($response->getStatusCode());
    }
}