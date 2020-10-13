<?php namespace config;

    class Autoload {

        public static function start() {



            spl_autoload_register(function($classPath) {


                // Model\User

                // Invierto las barras

                $pathBarrasInvertidas = str_replace("\\", "/", $classPath);

                // Model/User
                
                $classFile = strtolower(ROOT . $pathBarrasInvertidas . ".php");

                include_once($classFile);
            });
        }
    }
?>
