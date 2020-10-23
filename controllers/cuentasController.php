<?php namespace controllers;

    use daos\DaoCuentas as DaoCuentas;
    use models\Cliente as Cliente;

    class CuentasController
    {
        private $cuentas_dao;

        function __construct(){
            $this->cuentas_dao = new DaoCuentas();
        }
        
        public function verificar($email="",$password=""){
            
            
            $this->cuentas_dao->verificar($email,$password);
            
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

                $this->cuentas_dao->add($cuenta);

                require_once VIEWS_PATH . "login.php";
            }else {
                
                require_once "views/register.php";
            }
            
        }
    }

    