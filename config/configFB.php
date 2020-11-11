<?php namespace config;

    if(session_status() === PHP_SESSION_DISABLED || session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once('Facebook/autoload.php');

    $FBObject = new \Facebook\Facebook([
        'app_id' => '404625403905272',
        'app_secret' => '7256a02412f437a4b557affa9799c442',
        'default_graph_version' => 'v2.10',
        'persistent_data_handler'=>'session'
    ]);

    $handler = $FBObject -> getRedirectLoginHelper();


?>