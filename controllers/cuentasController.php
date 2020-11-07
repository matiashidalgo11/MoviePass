<?php namespace controllers;

    use daos\DaoCuentas as DaoCuentas;
    use models\Cuenta as Cuenta;
    use models\Profile as Profile;
use PDOException;

class CuentasController
    {

        public function verificar($email="",$password=""){
            
            $DaoCuentas = DaoCuentas::GetInstance();
            
            $validator = $DaoCuentas->verificar($email,$password);

            if(!isset($validator) && isset($_SESSION['cuenta']))
            {
            include ROOT . VIEWS_PATH . "nav-bar.php";
            }
            else {

                if($validator == 1) $emailValidator = "is-invalid";
                else if ($validator == 2) $passValidator = "is-invalid"; $emailIngresado = $email;

            include ROOT . VIEWS_PATH . "login.php";
            }
        }

        public function registrarse(){

            include "views/register.php";
        }

        public function crear($email, $password, $rPassword , $dni ,$nombre, $apellido, $telefono, $direccion){

            if($password == $rPassword){

                $profile = new Profile($dni,$nombre,$apellido,$direccion,$telefono);

                $cuenta = new Cuenta(0,$email, $password,1);

                $cuenta->setProfile($profile);

                /* try{
                    $DaoCuentas = DaoCuentas::GetInstance();

                    $DaoCuentas->add($cuenta);

                }catch (PDOException $p){
                    if(strpos($p, "SQLSTATE[23000]")) {
                        echo "Accion para la exception";
                    }
                } */


                include VIEWS_PATH . "login.php";
            }else {

                $passValidator = "is-invalid";
                
                include "views/register.php";
            }
            
        }

        public function viewPerfil(){

            if(isset($_SESSION['cuenta']))
            {
            include ROOT . VIEWS_PATH . "nav-bar.php";
            include ROOT . VIEWS_PATH . "view-profile.php";
            }
            else {
            require_once "views/login.php";
            }
        }


    }

    