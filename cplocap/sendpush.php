<?php 
    require_once 'vendor/autoload.php';
    //Make Envirement here
    putenv('GOOGLE_APPLICATION_CREDENTIALS=/home1/foursonlineco/public_html/foursdelivery-firebase-adminsdk-plptj-d8c228a45d.json');
    $scope = 'https://www.googleapis.com/auth/firebase.messaging';
    $client = new Google_Client();
    $client->setAuthConfig('/home1/foursonlineco/public_html/foursdelivery-firebase-adminsdk-plptj-d8c228a45d.json');
    $client->setScopes($scope);
    $client->useApplicationDefaultCredentials();
    //Got auth token
    $credentials = $client->fetchAccessTokenWithAssertion();
   
    //This is auth token
    $accessToken = $credentials['access_token'];
    $accessKey = $credentials['token_type'];
    
    //This is api key not going to use now.
    define('SERVER_API_KEY','AIzaSyBrk7UCbg69P6Lv7FhSmsrlxJUeqkxuktc');
    
    //Its a dummy payload but not working
    $payload = array('message'=>array('notification'=>array('title'=>'FCM Message','body'=>'This is a message from FCM')),'webpush'=>array('headers'=>array('Urgency'=>'high')),'notification'=>array('body'=>'This is Test Message','requireInteraction'=>'true','badge'=>'images/favicon.png'),'token'=>'f5SFD9fM3T81HhrSXEtn53:APA91bFNLxTr4tbeZULB0d0UWMB41F-DDv2tZ_UhQAV7TS6z5FnZuWOVsF2trl2ph8NTJO94HpvcAAfgv3X-kH36Zx1UCFJvG8osCNaDEKBZyQWIrZZVpFdcJI0mA31YuXj466BifNV6');
    
    //Actual api fire to send notification
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/foursdelivery/messages:send');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '{
      "message": {
       
        "token" : "e0sYXIZWSAaYo_SIGdx5DP:APA91bHayFeILw5lGJDSazMb1EnFAS1LYNhoTy0t3-VHScKUHcNxlmZuBq-0Z8ncxzVgdtPNothu-5OWVEt2IEkmzi5LuT-9KIqzem1FoEuqwnpU187RbRnL4OCwXHab1Ej_IokE1qcc",
        "notification": {
          "title": "FCM Message",
          "body": "This is a message from FCM"
        },
        "webpush": {
          "headers": {
            "Urgency": "high"
          },
          "notification": {
            "body": "This is a message from FCM to web",
            "requireInteraction": "true",
            "badge": "images/favicon.png"
          }
        }
      }
    }');
    
    $headers = array();
    $headers[] = 'Authorization: Bearer '.$accessToken;
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    echo $result;
   
?>