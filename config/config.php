<?php

define('ROOT', dirname(__DIR__) . "/");
define('FRONT_ROOT', 'http://localhost/xampp/MoviePassFinal/');
define('VIEWS_PATH','views/');
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");

//Constantes para API TMDB 
define('KEY_TMDB', '73738116e9432d71990567aeec929b73');
define('IMG_BASE_TMBD','https://image.tmdb.org/t/p/');
define('HOST_URL', '//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/");

//Constantes para BD 
define("DB_HOST", "localhost");
define("DB_NAME", "MoviePass");
define("DB_USER", "root");
define("DB_PASS", "");

//phpmailer  
define("EMAIL","BoleteriaMoviePass@gmail.com"); 
define("EMAIL_PASS","1BoleteriaMoviePass1"); 
define("MAILER_PATH",FRONT_ROOT."PHPMailer/");