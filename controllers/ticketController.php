<?php

namespace controllers;

use daos\DaoTickets as DaoTickets;
use models\ticket as Ticket;
use PDOException;
use PHPMailer\email as email;

class TicketController
{
    private $ticketDao;
    private $email;

    public function __construct()
    {   
        $this->ticketDao = new DaoTickets();
        $this->email = new email();
    }

    public function add($compra,$funcion)
    {
        $ticket=new Ticket($compra,$funcion);
        try
        {
            $this->ticketDao->Add($ticket);
            $this->email->sendTickets("santiago.mdp@gmail.com",$ticket);
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
    
    public function ticketViewByUser()
    {
        
        $cuentaId=$_SESSION['cuenta']->getId();
        $ticketList=array();
        try
        {
            $ticketList=$this->ticketDao->ticketByUser($cuentaId);
        }
        catch(PDOException $e)
        {

            echo $e->getMessage();
        }
        require_once(VIEWS_PATH."ticketView.php");
    }
    public function ticketHistoryByUser()
    {
        $cuentaId=$_SESSION['cuenta']->getId();
        $ticketList=array();
        try
        {
            $ticketList=$this->ticketDao->ticketHistoryByUser($cuentaId);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        require_once(VIEWS_PATH."ticketView.php");
    }


}




?>