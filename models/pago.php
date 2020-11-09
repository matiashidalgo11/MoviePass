<?php

namespace models;


class pago
{
    private $idPago;
    private $total;
    private $codigoPago;


    public function __construct($idPago="",$total="",$codigoPago="")
    {
        $this->idPago=$idPago;
        $this->total=$total;
        $this->idCompra=$codigoPago;
    }


    public function getIdpago()
    {
        return $this->idPago;
    }

    public function setIdpago($idPago)
    {
        $this->idPago=$idPago;
    }
    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total=$total;
    }
    public function getcodigoPago()
    {
        return $this->idCompra;
    }

    public function setcodigoPago($codigoPago)
    {
        $this->codigoPago=$codigoPago;
    }



}


?>