<?php

namespace controllers;

use daos\DaoCompra as DaoCompra;

use models\compra as Compra;
use PDOException;

class compraController
{

    private $compraDao;

    public function __construct()
    {
        $this->compraDao= new DaoCompra();
    }


    public function add($fecha,$totalTickets,$descuento,$cuenta)
    {
        $compra= new Compra($fecha,$totalTickets,$descuento,$cuenta);

        try{

            $this->compraDao->Add($compra);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
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




}





?>