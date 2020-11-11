<?php
namespace controllers;

use daos\DaoCompra as DaoCompra;
use daos\DaoFunciones as DaoFunciones;
use daos\DaoCuentas as DaoCuentas;
use models\compra as Compra;
use models\pago as Pago;
use PDOException;

class compraController
{

    private $compraDao;
    private $DaoFuncion;
    private $DaoCuenta;

    public function __construct()
    {
        $this->compraDao= new DaoCompra();
        $this->DaoFuncion= new DaoFunciones();
        $this->DaoCuenta= DaoCuentas::GetInstance();
    }


    public function add($idFuncion,$totalTickets,$descuento)
    {
        $funcion=$this->DaoFuncion->GetById($idFuncion);
        $cuenta=$this->DaoCuenta->getById($_SESSION['cuenta']->getId());

        $compra= new Compra($funcion->getDate(),$totalTickets,$descuento,$cuenta);

        if($this->DaoFuncion->checkSeats($idFuncion,$totalTickets))
        {
                 try{
                         $this->compraDao->Add($compra);
                         $this->DaoFuncion->upDateSale($idFuncion,$totalTickets);
                         $this->DaoPagos->Add(($funcion->getRoom()->getPrecio()*$totalTickets),$codigoPago);
                         //hacer una funcion que retorne el idCompra por codigoPago
                         //$this->ticketController->add($compra,$funcion);
                         
                         //Enviar un mail y luego mostrar
                         //$this->email->sendTickets("santiago.mdp@gmail.com",$ticketList[0]);
     

                         require_once(VIEWS_PATH."cine.php");

                    }
                     catch(PDOException $e)
                    {
                      echo $e->getMessage();
                     }
        }
        else
        {
            $this->buyMovie($idFuncion);
        }

    }

    public function getAll()
    {
        $compraList=array();
        try
        {

            $compraList= $this->compraDao->getAll();
            
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function buyMovie($idFuncion)
    {
        $funcion=$this->DaoFuncion->GetById($idFuncion);

        require_once(VIEWS_PATH."buyMovie.php");
    }
}
