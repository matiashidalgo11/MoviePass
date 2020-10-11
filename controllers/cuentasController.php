<?php namespace controllers;

    use daos\DaoCuentas as DaoCuentas;

    class CuentasController
    {
        private $cuentas_dao;

        function __construct(){
            $this->cuentas_dao = new DaoCuentas();
        }
        
        public function verificar($email="",$password=""){
            
            DaoCuentas::verificar($email,$password);
            if(isset($_SESSION['cuenta']))
            {
            require_once "views/template.php";
            }
            else {
            require_once "views/login.php";
            }
        }
    }

    