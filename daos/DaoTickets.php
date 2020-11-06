<?php

namespace daos;

use models\ticket as Ticket;
use models\Funcion as Funcion;
use models\compra as Compra;

use daos\Connection as Connection;
use daos\DaoCompra as DaoCompra;
use daos\ProjectionDAO as DaoFuncion;

use PDOException;

class DaoTickets
{
    private $connection;
    const TABLE_NAME = "tickets";
    const TABLE_IDTICKET = "idTicket";
    const TABLE_IDCOMPRA = "idCompra";
    const TABLE_IDFUNCION = "idFuncion";
   

    public function __construct() {
        
    }


    public function Add($ticket)
    {
            $sql= "INSERT INTO tickets (idCompra,idFuncion) VALUES (idCompra,idFuncion);" ;


            try
            {
                $funcion= $ticket->getFuncion();
                $compra=$ticket->getCompra();
                
                $parameters['idCompra']=$compra->getIdCompra();
                $parameters['idFunciom']=$funcion->getId();
                
                $this->connection=Connection::GetInstance();
                $this->connection->executeNonQuery($sql,$parameters);
            }
            catch(PDOException $e)
            {
                throw $e;
            }
    }

    public function getAll()
    {
                $sql = "select from " . DaoTickets::TABLE_NAME;

                $ticketList = array();

                try{
                    $this->connection = Connection::GetInstance();

                    $resultSet = $this->connection->Execute($sql);
        
                    foreach ($resultSet as $value)
                    {
                        
                        array_push($ticketList,$this->parseToObject($value));
                    }

                
                    return $ticketList;
        
                } catch (PDOException $ex) { 
                    throw $ex; 
                } 
                return $ticketList;
    
        }
    

    public function parseToObject($value)
    {
        $daoCompra=new DaoCompra();
        $daoFuncion=new DaoFuncion();

        $compra=$daoCompra->GetById($value[DaoTickets::TABLE_IDCOMPRA]); /////hacer esta funcion
        $funcion=$daoFuncion->GetById($value[DaoTickets::TABLE_IDFUNCION]);

        $ticket = new Ticket($compra,$funcion);
        $ticket->setId($value[DaoTickets::TABLE_IDTICKET]);

        return $ticket;
    }

    public function mapeo($value) 
    { 
 
        $value = is_array($value) ? $value : []; 
 
        $resp = array_map( 
            function ($p) { 
 
                $objet =  new Ticket( 
                    $p[DaoTickets::TABLE_IDTICKET], 
                    $p[DaoTickets::TABLE_IDCOMPRA], 
                    $p[DaoTickets::TABLE_IDFUNCION], 
                 
                ); 
 
                return $objet; 
            }, 
            $value 
        ); 
        return count($resp) > 1 ? $resp : $resp['0']; 
    }





}




?>