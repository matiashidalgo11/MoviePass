<?php

namespace controllers;

use daos\DaoTickets as DaoTickets;
use models\ticket as Ticket;
use PDOException;
use phpmailer\email as email;
use phpmailer\gmail as gmail;

class ticketController
{
    private $ticketDao;
    private $email;
    private $gmail;


    public function __construct()
    {   
        $this->ticketDao = new DaoTickets();
        $this->email= new email();
        
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
        
        if($this->email->sendTickets("santiago.mdp@gmail.com",$ticketList[0]))
        {
            echo "se mando mail";
        }
        else
        {
            echo "no se mando";
        }
        

        require_once(VIEWS_PATH."ticketView.php");
    }



}




?>