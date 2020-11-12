<?php namespace controllers;

    class LoginController {

        function init(){

            require_once ('config/configFB.php');


            $redirectTo = "http://localhost/MoviePass/fb-callback.php";
            $data = ['email'];
            $fullURL = $handler->getLoginUrl($redirectTo, $data);
        
            
            $homeController = new HomeController();
            $homeController->navBar();
        
            require_once ROOT."/views/login.php";
        }
    }

?>