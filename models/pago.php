<?php

namespace models;


class pago
{
    private $idPago;
    private $total;
    private $idCompra;


    public function __construct($idPago="",$total="",$idCompra="")
    {
        $this->idPago=$idPago;
        $this->total=$total;
        $this->idCompra=$idCompra;
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
    public function getIdCompra()
    {
        return $this->idCompra;
    }

    public function setIdCompra($idCompra)
    {
        $this->idCompra=$idCompra;
    }



}


?>