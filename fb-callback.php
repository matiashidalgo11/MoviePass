<?php
    
    require_once("config/configFB.php");

    try {
        $accessToken = $handler->getAccessToken();
    }catch(\Facebook\Exceptions\FacebookResponseException $e){
        echo "Response Exception: " . $e->getMessage();
        exit();
    }catch(\Facebook\Exceptions\FacebookSDKException $e){
        echo "SDK Exception: " . $e->getMessage();
        exit();
    }
    
    if($accessToken){

    
        $oAuth2Client = $FBObject->getOAuth2Client();
        if(!$accessToken->isLongLived())
            $accessToken = $oAuth2Client->getLongLivedAccesToken($accessToken);
        
            $response = $FBObject->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
            $userData = $response->getGraphNode()->asArray();
            $_SESSION['fb-userData'] = $userData;
            //$_SESSION['access_token'] = (string) $accessToken;

            //llamar a home controller;
            header('Location: index.php');
            exit();


    }else{

    }
    

?>