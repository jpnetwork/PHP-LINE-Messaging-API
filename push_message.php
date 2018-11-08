<?php 

$accessToken = "ACCESS_TOKEN";
   $arrayHeader = array();
   $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Authorization: Bearer {$accessToken}";
   
  
   $user_id = 'xxxxxxxxxxxx';
   
   
      $arrayPostData['to'] = $user_id;
      
      //Text
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "สวัสดีครับ";
      
      //Sticker
      $arrayPostData['messages'][1]['type'] = "sticker";
      $arrayPostData['messages'][1]['packageId'] = "2";
      $arrayPostData['messages'][1]['stickerId'] = "34";
      
      //Images
      $arrayPostData['messages'][2]['type'] = "image";
      $arrayPostData['messages'][2]['originalContentUrl'] = "https://yourweb.com/image.png";
      $arrayPostData['messages'][2]['previewImageUrl'] = "https://yourweb.com/image.png";
      
      
    pushMsg($arrayHeader,$arrayPostData);
 
   function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/push";
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
