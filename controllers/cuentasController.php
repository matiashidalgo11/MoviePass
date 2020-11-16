<?php

namespace controllers;

use daos\DaoCuentas as DaoCuentas;
use daos\DaoProfiles;
use models\Cuenta as Cuenta;
use models\Profile as Profile;
use PDOException;

class CuentasController
{
    private $daoCuenta;
    private $statusController;
    private $loginController;

    function __construct()
    {
        $this->daoCuenta = DaoCuentas::GetInstance();
        $this->statusController = new StatusController();
        $this->loginController = new LoginController();
    }


    //Verificacion normal ingresando email y password;
    public function verificar($email = "", $password = "")
    {

        
        if($this->daoCuenta->exist($email)){
            //Se encuentra el email;
            $cuenta = $this->daoCuenta->getByEmail($email);

            if ($cuenta->getPassword() == $password) {
                //Login existoso
                $_SESSION['cuenta'] = $cuenta;


                $this->statusController->typeSession();

            }else {
                //pass incorrecto
                $_SESSION['loginValidator']['passValidator'] = "is-invalid";
                $_SESSION['loginValidator']['emailValidator']= "is-valid";
                $this->loginController->init();
            }

        }else{
            //no existe una cuenta;
            $_SESSION['loginValidator']['emailValidator']= "is-invalid";


            $this->loginController->init();
        }

    }

    //Verificacion via api de fb
    public function verificarByFb()
    {

        if (isset($_SESSION['fb-userData'])) {


            $email = $_SESSION['fb-userData']['email'];
            $idFb = $_SESSION['fb-userData']['id'];


            if ($this->daoCuenta->exist($email)) {

                
                //borro los datos traidos de la api
                unset($_SESSION['fb-userData']);

                $cuenta = $this->daoCuenta->getByEmail($email);
                
                //Si no existe un idFb asociado se lo setea
                if (!($this->daoCuenta->existIdFb($idFb))) {

                    $cuenta->setIdFb($idFb);
                    $this->daoCuenta->setIdFb($cuenta);

                }

                $_SESSION['cuenta'] = $cuenta;

                $this->statusController->typeSession();
         

            } else {
                //llamo a registrarse con los datos de fb api desde el sesion
                $this->registrarse();

            }
        }
    }

    public function registrarse()
    {

        include "views/register.php";
    }

    public function crear($email, $password, $rPassword, $dni, $nombre, $apellido, $telefono, $direccion, $idFb = "")
    {
        $daoProfile = DaoProfiles::GetInstance();
 
        $_SESSION['registerValidator']['email'] = ($this->daoCuenta->exist($email))? 'is-invalid' : 'is-valid';
        
        $_SESSION['registerValidator']['dni'] = ($daoProfile->exist($dni)) ? 'is-invalid' : 'is-valid';

        $_SESSION['registerValidator']['password'] = ($password != $rPassword) ? 'is-invalid' : 'is-valid';
    

        if($_SESSION['registerValidator']['email'] == 'is-invalid' || $_SESSION['registerValidator']['dni'] == 'is-invalid' || $_SESSION['registerValidator']['password'] == 'is-invalid'){
            //Muestro el register
            $this->registrarse();

        }else{

            //borro la sesion de register
            unset($_SESSION['registerValidator']);

            //Creo y guardo el objeto cuenta
            $cuenta = new Cuenta(0, $email, $password, 1);

            $cuenta->setIdFb($idFb);

            $cuenta->setProfile(new Profile($dni, $nombre, $apellido, $direccion, $telefono));

            try {
                        
                $this->daoCuenta->add($cuenta);
                //Elimino la session de fb
                if (isset($_SESSION['fb-userData'])) unset($_SESSION['fb-userData']);
                //creo la session de cuenta
                $_SESSION['cuenta'] = $cuenta;

                $statusController = new StatusController();
                $statusController->typeSession();
                      
            } catch (PDOException $p) {
                //Mostrar una vista de error de base de datos
            }
        }            
       
    }

    public function cerrarSesion()
    {

        // Deshacer la sesión
        unset($_SESSION['access_token']);

        // Deshacer la información del usuario
        unset($_SESSION['fb-userData']);

        unset($_SESSION['cuenta']);

        unset($_SESSION['loginValidator']);

        session_destroy();

        unset($_SESSION['loginValidator']); 

        $loginController = new LoginController();
        $loginController->init();
    }

    public function viewPerfil()
    {

        if (isset($_SESSION['cuenta'])) {
            include ROOT . VIEWS_PATH . "nav-bar.php";
            include ROOT . VIEWS_PATH . "view-cuenta.php";
        } else {
            require_once "views/login.php";
        }
    }

}
