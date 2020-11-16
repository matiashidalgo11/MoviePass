<?php

namespace controllers;

use daos\DaoCompra as DaoCompra;
use daos\DaoFunciones as DaoFunciones;
use daos\DaoPagos as DaoPagos;
use daos\DaoCuentas as DaoCuentas;
use models\compra as Compra;
use models\pago as Pago;
use PDOException;

use controllers\TicketController as TicketController;
use controllers\funcionController as FuncionesController;

class compraController
{

    private $compraDao;
    private $DaoFuncion;
    private $DaoCuenta;
    private $DaoPagos;
    private $ControllerTicket;
    private $ControllerFunciones;

    public function __construct()
    {
        $this->compraDao= new DaoCompra();
        $this->DaoFuncion= new DaoFunciones();
        $this->DaoCuenta= DaoCuentas::GetInstance();
        $this->DaoPagos=new DaoPagos();
        $this->ControllerTicket = new TicketController();
        $this->ControllerFunciones = new FuncionesController();
    }


    public function add($idFuncion,$totalTickets,$descuento)
    {
       
        $funcion=$this->DaoFuncion->GetById($idFuncion);
        $cuenta=$this->DaoCuenta->getById($_SESSION['cuenta']->getId());
        $codigoPago= $_SESSION['cuenta']->getId()."/".$idFuncion."/".$funcion->getDate()."/".$totalTickets;
        $compra= new Compra($funcion->getDate(),$funcion,$totalTickets,$descuento,$cuenta,$codigoPago);

        if($this->DaoFuncion->checkSeats($idFuncion,$totalTickets))
        {
                 try{
                         $this->compraDao->Add($compra);
                         $this->DaoFuncion->upDateSale($idFuncion,$totalTickets);
                         $compra->setIdCompra($this->compraDao->getidBypayCode($codigoPago));
                         
                         $this->DaoPagos->Add(($funcion->getRoom()->getPrecio()*$totalTickets),$codigoPago);
                         $this->ControllerTicket->add($compra,$funcion);
                         $this->ControllerFunciones->listFunciones();

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
