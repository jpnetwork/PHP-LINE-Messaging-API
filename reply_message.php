<?php

$accessToken = "ACCESS-TOKEN";
  
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
 
$arrayHeader = array();
$arrayHeader[] = "Content-Type: application/json";
$arrayHeader[] = "Authorization: Bearer {$accessToken}";
 
if($arrJson['events'][0]['message']['text'] == "Hello"){
  $arrayPostData = array();
  $arrayPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrayPostData['messages'][0]['type'] = "text";
  $arrayPostData['messages'][0]['text'] = "Hello ,your ID is ".$arrJson['events'][0]['source']['userId'];
} } else {
  $arrayPostData = array();
  $arrayPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrayPostData['messages'][0]['type'] = "text";
  $arrayPostData['messages'][0]['text'] = "Welcome!";
}
 
replyMsg($arrayHeader,$arrayPostData);
 
   function replyMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/reply";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
