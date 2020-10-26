<?php namespace controllers;

    use daos\DaoCuentas as DaoCuentas;
    use models\Cliente as Cliente;

    class CuentasController
    {

        public function verificar($email="",$password=""){
            
            $DaoCuentas = DaoCuentas::GetInstance();
            
            $DaoCuentas->verificar($email,$password);
            
            if(isset($_SESSION['cuenta']))
            {
            require_once "views/template.php";
            }
            else {
            require_once "views/login.php";
            }
        }

        public function registrarse(){

            require_once "views/register.php";
        }

        public function crear($email, $password, $rPassword , $nombre, $apellido, $telefono, $domicilio){

            if($password == $rPassword){

                $cuenta = new Cliente(1,$email, $password,1, $nombre, $apellido, $telefono, $domicilio);

                $DaoCuentas = DaoCuentas::GetInstance();

                $DaoCuentas->add($cuenta);

                require_once VIEWS_PATH . "login.php";
            }else {
                
                require_once "views/register.php";
            }
            
        }
    }

    