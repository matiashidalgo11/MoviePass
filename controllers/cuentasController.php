<?php

namespace controllers;

use daos\DaoCuentas as DaoCuentas;
use models\Cuenta as Cuenta;
use models\Profile as Profile;
use PDOException;

class CuentasController
{

    public function verificar($email = "", $password = "")
    {

        $DaoCuentas = DaoCuentas::GetInstance();

        $validator = $DaoCuentas->verificar($email, $password);


        if (!isset($validator) && isset($_SESSION['cuenta'])) {
           
            $statusController = new StatusController();
            $statusController->verificar();

        } else {
            //Devuelve el login cuando no lo es
            if ($validator == 1) $emailValidator = "is-invalid";
            else if ($validator == 2) $passValidator = "is-invalid";
            $emailIngresado = $email;

            $loginController = new LoginController();
            $loginController->init();

        }
    }

    public function verificarByFb()
    {

        if (isset($_SESSION['fb-userData'])) {


            $email = $_SESSION['fb-userData']['email'];
            $idFb = $_SESSION['fb-userData']['id'];

            

            echo "Estoy logeado como facebook user";

            $daoCuentas = DaoCuentas::GetInstance();

            if ($daoCuentas->exist($email)) {
                //borro los datos traidos de la api
                unset($_SESSION['fb-userData']);

                $cuenta = $daoCuentas->getByEmail($email);
                
                if (!($daoCuentas->existIdFb($idFb))) {

                    echo "PASO POR DONDE NO EXISTE EL IDFB";
                    $cuenta->setIdFb($idFb);
                    $daoCuentas->setIdFb($cuenta);
                    //llamo statuscontroller para mostrar una vista a un usuario que le faltan datos que rellenar
                    //existe el mail pero no existe una entrada desde fb

                }
                $_SESSION['cuenta'] = $cuenta;
                $statusController = new StatusController();
                $statusController->verificar();
                //llamo statuscontroller para mostrar la vista de usuario normal

                

            } else {

                $this->registrarse();

            }
        }
    }

    public function registrarse()
    {

        include "views/register.php";
    }

    public function crear($email, $password, $rPassword, $dni, $nombre, $apellido, $telefono, $direccion, $idFb)
    {

        if ($password == $rPassword) {

            $profile = new Profile($dni, $nombre, $apellido, $direccion, $telefono);

            $cuenta = new Cuenta(0, $email, $password, 1);

            $cuenta->setIdFb($idFb);

            $cuenta->setProfile($profile);

            try {
                $DaoCuentas = DaoCuentas::GetInstance();

                $DaoCuentas->add($cuenta);

                $DaoCuentas->setIdFb($cuenta);

            } catch (PDOException $p) {
                if (strpos($p, "SQLSTATE[23000]")) {
                    echo "Accion para la exception";
                }
            }
            //Registro por fb
            if (isset($_SESSION['fb-userData'])){

                unset($_SESSION['fb-userData']);

                $_SESSION['cuenta'] = $cuenta;
                $statusController = new StatusController();
                $statusController->verificar();

            }else{
                //Registro normal
                $loginController = new LoginController();
                $loginController->init();

            }
            
        } else {

            $passValidator = "is-invalid";

            $this->registrarse();
        }
    }

    public function cerrarSesion()
    {

        // Deshacer la sesión
        unset($_SESSION['access_token']);

        // Deshacer la información del usuario
        unset($_SESSION['fb-userData']);

        unset($_SESSION['cuenta']);

        session_destroy();

        echo "paso por cerrar sesion";

        var_dump($_SESSION);

        $loginController = new LoginController();
        $loginController->init();
    }

    public function viewPerfil()
    {

        if (isset($_SESSION['cuenta'])) {
            include ROOT . VIEWS_PATH . "nav-bar.php";
            include ROOT . VIEWS_PATH . "view-profile.php";
        } else {
            require_once "views/login.php";
        }
    }
}
