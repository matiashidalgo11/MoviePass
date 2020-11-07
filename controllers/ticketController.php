<?php

namespace controllers;

use daos\DaoTickets as DaoTickets;
use models\ticket as Ticket;
use PDOException;

class ticketController
{
    private $ticketDao;


    public function __construct()
    {   
        $this->ticketDao = new DaoTickets();
    }

    public function add($compra,$funcion)
    {
        $ticket=new Ticket($compra,$funcion);

        try
        {

            $this->ticketDao->Add($ticket);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function getAll()
    {
        $ticketList=array();
        try
        {

            $ticketList=$this->ticketDao->getAll();
            
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }



}




?>