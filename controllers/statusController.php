<?php namespace controllers;

    use config\ConfigFb as ConfigFb;
use daos\DaoCuentas;
use models\Cuenta;

class StatusController {

        function verificar(){  
            
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