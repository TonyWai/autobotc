<?php
require_once('./vendor/autoload.php');

#Namespce
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

$channel_token='3LtCAoEO06hmq622dXan5OCA3DKlltrIvzPkGKZWkscKglmY8b2P1inShw5vHwhhU97ibyBdasIeEsHGAeDLNyqlrmgtL4sCayHhw5Q6s+XVSe7UJaYn5OAQDtsoqlqy3NrUX/0Qav4Y/S1hNTP7LQdB04t89/1O/w1cDnyilFU=';
$channel_secret='dac747867a7c9c0072bdaa1a1030c932';

#Get message from Line API
$content=file_get_contents('php://input');
$events=json_decode($content, true);

if(!is_null($events['events'])){
    foreach($events['events'] as $event){
        if($event['type']='message'){
            switch($event['message']['type']){
                case 'text':
                    $replyToken=$event['replyToken'];

                    $respMessage = 'Hello, your message is '. $event['message']['text'];

                    $httpClient=new CurlHTTPClient($channel_token);
                    $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
                    $textMessageBuilder = new TextMessageBuilder($respMessage);
                    $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                break;
            }
        }
    }
}else{
    echo 'event is null';
}

echo 'OK_wingit';
