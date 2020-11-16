<?php namespace controllers;

use config\ConfigFb as ConfigFb;
use daos\DaoCuentas;
use models\Cuenta;
use daos\DaoGenres as DaoGenres;

class StatusController {

        //Verifica que tipo se sesion se encuentra activa (Admin, usuario) y devulve la vista inicial
        function typeSession(){  
            
            //Filtro para el callback de la api de facebook
            if(isset($_SESSION['fb-userData'])){

                $cuentasController = new CuentasController();
                $cuentasController->verificarByFb();
                //ir a cuentas controller para verificar 
    
            }else {

                $homeController = new HomeController();
                $homeController->navBar();

                    if(isset($_SESSION['cuenta'])){

                        if ($_SESSION['cuenta']->getPrivilegios()==0)
                        {
                            echo "Estoy logeado como admin";
                            
                        }else if ($_SESSION['cuenta']->getPrivilegios()==1)
                        {
                            echo "Estoy logeado como usuario";
                            $funcionDao = new funcionController();
                            $funcionDao->listFunciones();
                        }

                    }else{

                     echo "No estoy logeado";
                

                    }
                

                
            }

            

        }

        
    }

?>