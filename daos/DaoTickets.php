<?php

namespace daos;

use models\ticket as Ticket;
use models\Funcion as Funcion;
use models\compra as Compra;

use daos\Connection as Connection;
use daos\DaoCompra as DaoCompra;
use daos\DaoFunciones as DaoFuncion;

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
            $sql= "INSERT INTO tickets (idCompra,idFuncion) VALUES (:idCompra,:idFuncion);" ;
            
            try
            {
                $funcion= $ticket->getFuncion();
                $compra=$ticket->getCompra();
                
                $parameters['idCompra']=$compra->getIdCompra();
                $parameters['idFuncion']=$funcion->getId();

                
                
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

        $compra=$daoCompra->GetById($value['idCompra']); 
        $funcion=$daoFuncion->GetById($value['idFuncion']);

        $ticket = new Ticket($compra,$funcion);
        $ticket->setId($value['codigoPago']);

        return $ticket;
    }


    public function ticketByUser($idCuenta)
    {
        $date=getdate();
        $day=$date['year']."-".$date['mon']."-".$date['mday'];
        $ticketList=array();
        $sql="SELECT idFuncion,idCompra,codigoPago FROM compras WHERE idCuenta = ". $idCuenta . " AND fecha>=".'"'.$day.'"'.";";
        try
        {
            $this->connection=Connection::GetInstance();
            $resultSet=$this->connection->Execute($sql);
 
            foreach($resultSet as $value)
            {

                array_push($ticketList,$this->parseToObject($value));
            }

            return $ticketList;
        }catch(PDOException $e)
        {
            throw $e;
        }
    }

    public function ticketHistoryByUser($cuentaId)
    {
        $sql="SELECT idFuncion,idCompra,codigoPago FROM compras WHERE idCuenta = ". $cuentaId .";";
        $ticketList=array();
        try
        {
            $this->connection=Connection::GetInstance();
            $resultSet=$this->connection->Execute($sql);
            foreach($resultSet as $value)
            {
                array_push($ticketList,$this->parseToObject($value));
            }

            return $ticketList;
        }catch(PDOException $e)
        {
            throw $e;
        }
    }





}




?>