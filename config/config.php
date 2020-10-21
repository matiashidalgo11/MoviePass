<?php

define('ROOT', dirname(__DIR__) . "/");
define('FRONT_ROOT', 'http://localhost/MoviePass5/');
define('VIEWS_PATH','views/');
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");

define('KEY_TMDB', '73738116e9432d71990567aeec929b73');
define('IMG_BASE_TMBD','https://image.tmdb.org/t/p/');
define('HOST_URL', '//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/");