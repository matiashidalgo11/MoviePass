<?php

namespace daos;

use PDOException;
use models\pago as Pago;

class DaoPagos
{
    private $connection;



    public function __construct()
    {
        
    }


    public function Add($total,$compra)
    {
        $sql="INSERT INTO pagos (idCompra,total) VALUES (:idCompra,:total);";

        $parameters['idCompra']=$compra->getIdCompra();
        $parameters['total']=$total;

        try
        {
            $this->connection=Connection::GetInstance();
            $this->connection->ExecuteNonQuery($sql,$parameters);
            return true;
        }
        catch(PDOException $e)
        {
            throw $e;
        }
    }

    public function getAll()
    {
        $sql="SELECT * FROM pagos;";
        $pagoList=array();

        try{
            $this->connection=Connection::GetInstance();
            $resultSet=$this->connection->Execute($sql);
            foreach($resultSet as $value)
            {
                array_push($pagoList,$this->parseToObject($value));
            }

            return $pagoList;
        }catch(PDOException $e)
        {
            throw $e;
        }
    }

    public function parseToObject($value)
    {
        $pago= new Pago($value['idPago'],$value['total'],$value['idCompra']);
        return $pago;
    }

    




}


?>