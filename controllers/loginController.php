<?php namespace controllers;

    class LoginController {

        function init(){

            //Creo la url para redireccionar cuando vuelva de facebook si entra por fb
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