<?php

namespace models;


class compra
{
    private $idCompra;
    private $fecha;
    private $totalTickets;
    private $descuento;
    private $cuenta;
    
    private $tickets=array();

    public function __construct($fecha="",$totalTickets="",$descuento="",$cuenta="")
    {
        
        $this->fecha=$fecha;
        $this->totalTickets=$totalTickets;
        $this->descuento=$descuento;
        $this->user=$cuenta;
        
    }

    /**
     */
    public function getIdCompra()
    {
        return $this->idCompra;
    }
    /**
     */
    public function setIdCompra($idCompra)
    {
        $this->idCompra=$idCompra;
    }
    /**
     */
    public function getFecha()
    {
        return $this->fecha;
    }
    /**
     */
    public function setFecha($fecha)
    {
        $this->fecha=$fecha;
    }
    /**
     */
    public function getTotalTickets()
    {
        return $this->totalTickets;
    }
    /**
     */
    public function setTotalTickets($totalTickets)
    {
        $this->totalTickets=$totalTickets;
    }
    /**
     */
    public function getDescuento()
    {
        return $this->descuento;
    }
    /**
     */
    public function setDescuento($descuento)
    {
        $this->descuento=$descuento;
    }

    /**
     */
    public function getCuenta()
    {
        return $this->cuenta;
    }
    /**
     */
    public function setCuenta($cuenta)
    {
        $this->cuenta=$cuenta;
    }

    /**
     */
    public function getTickets()
    {
        return $this->tickets;
    }
    /**
     */
    public function setTickets($tickets)
    {
        $this->tickets=$tickets;
    }



}






?>