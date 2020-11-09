<?php

namespace daos;

use models\compra as Compra;
use models\Cuenta as Cuenta;
use PDOException;

class DaoCompra
{

    private $connection;
    const TABLE_NAME = "compras";
    const TABLE_IDCOMPRA = "idCompra";
    const TABLE_TOTALTICKETS = "totalTickets";
    const TABLE_FECHA = "fecha";
    const TABLE_DESCUENTO= "descuento";
    const TABLE_IDCUENTA = "idCuenta";


    public function __construct()
    {
        
    }


    public function Add($compra)
    {
        $sql= "INSERT INTO compras (totalTickets,fecha,descuento,idCuenta) VALUES (:totalTickets,:fecha,:descuento,:idCuenta);";

        $cuenta=$compra->getCuenta();

        
        $parameters['totalTickets']=$compra->getTotalTickets();
        $parameters['fecha']=$compra->getFecha();
        $parameters['descuento']=$compra->getDescuento();
        $parameters['idCuenta']=$cuenta->getId();


        try
        {
            $this->connection=Connection::GetInstance();
            $this->connection->executeNonQuery($sql,$parameters);
        }
        catch(PDOException $e)
        {
            throw $e;
        }


    }

    public function parseToObject($value)
    {
        $daoCuenta = new DaoCuentas();

        $cuenta= $daoCuenta->getById($value[DaoCompra::TABLE_IDCUENTA]);

        $compra = new Compra($value[DaoCompra::TABLE_FECHA],$value[DaoCompra::TABLE_TOTALTICKETS],$value[DaoCompra::TABLE_DESCUENTO],$cuenta);
        $compra->setIdCompra($value[DaoCompra::TABLE_IDCOMPRA]);

        return $compra;
    }

    public function getAll()
    {
        $sql= "SELECT * FROM compras ;";

        $compraList=array();

        try
        {
            $this->connection=Connection::GetInstance();
            $resultSet=$this->connection->execute($sql);

            foreach($resultSet as $value)
            {
                array_push($compraList,$this->parseToObject($value));
            }

            return $compraList;
        }
        catch(PDOException $e)
        {
            throw $e;
        }
    }

    public function GetById($id)
    {
        $sql="SELECT * FROM compras WHERE id=".$id.";";

        try
        {
            $this->connection=Connection::GetInstance();
            $value=$this->connection->execute($sql);

            
            $compra=$this->parseToObject($value);

            return $compra;
        }
        catch(PDOException $e)
        {
            throw $e;
        }
    }



}



?>