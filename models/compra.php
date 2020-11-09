<?php

namespace models;


class compra
{
    private $idCompra;
    private $fecha;
    private $funcion;
    private $totalTickets;
    private $descuento;
    private $cuenta;
    private $codigoPago;
    
    private $tickets=array();

    public function __construct($fecha="",$funcion="",$totalTickets="",$descuento="",$cuenta="",$codigoPago="")
    {
        
        $this->fecha=$fecha;
        $this->funcion=$funcion;
        $this->totalTickets=$totalTickets;
        $this->descuento=$descuento;
        $this->cuenta=$cuenta;
        $this->codigoPago=$codigoPago;
        
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
    public function getFuncion()
    {
        return $this->funcion;
    }
    /**
     */
    public function setFuncion($funcion)
    {
        $this->funcion=$funcion;
    }

    /**
     */
    public function getCodigoPago()
    {
        return $this->codigoPago;
    }
    /**
     */
    public function setCodigoPago($codigoPago)
    {
        $this->codigoPago=$codigoPago;
    }



}






?>