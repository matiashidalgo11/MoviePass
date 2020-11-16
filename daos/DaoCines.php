<?php namespace daos;


use models\Cine as cine;
use daos\Connection as Connection;
use PDO;
use PDOException;

class DaoCines {
   
private $connection;

    public function __construct(){

    }

    public function Add($cine)
    {
        $sql = "INSERT into cines (nombre, direccion) values (:nombre,:direccion)";
        $parameters['nombre'] =  $cine->getNombre();
        $parameters['direccion'] =  $cine->getDireccion();
        try { 
        $this->connection = Connection::GetInstance(); 
        return $this->connection->ExecuteNonQuery($sql,$parameters);
    } catch (PDOException $ex) { 
        throw $ex; 
    } 
} 

public function GetById($idCine){ 
    $cine = null;
    try { 
        $sql = "SELECT * from  cines where idCine=:idCine"; 
        $parameters['idCine'] = $idCine;
        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($sql,$parameters);
        if(!empty($resultSet)){ 
             $cine = $this->parseToObject($resultSet[0]);   
        }
    } catch (PDOException $ex) { 
        throw $ex; 
    } 
    return $cine;
} 

public function mapeo($row){
    $cine = new Cine();
    $cine->setId($row["idCine"]);
    $cine->setNombre($row["nombre"]);
    $cine->setDireccion($row["direccion"]);
    if($row['room'] != null ){
        $cine->setRoom($row["room"]);
    }
    else{
        $cine->setRoom(0);
    }
    return $cine;
}

public function Update($cine){
        $sql = "UPDATE  cines (:nombre,:direccion) where idCine=".$cine->getId().";";
        $parameters['nombre'] = $cine->getNombre(); 
        $parameters['direccion'] = $cine->getDireccion(); 
        try{
            $this->connection = Connection::GetInstance(); 
            return $this->connection->ExecuteNonQuery($sql, $parameters); 
        } catch (PDOException $ex) { 
            throw $ex; 
        }
}

public function GetAll(){
    $sql = "SELECT * FROM cines";
    $cineList = array();
    try{
        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($sql);
        
        if(!empty($resultSet)){ 
            foreach ($resultSet as $row) {
                $aux = $this->parseToObject($row);
                array_push($cineList,$aux);
            }  
        }
        } catch (PDOException $ex) { 
            throw $ex; 
        } 
    return $cineList;
}

public function remove($idCine){
    $value =0;
    try
    {
        $parameters['idCine'] = $idCine;
        $sql = "DELETE from cines where idCine=:idCine";  
         $this->connection=Connection::getInstance();
         $value = $this->connection->ExecuteNonQuery($sql,$parameters);
    }
        catch(PDOException $ex){
        throw $ex;
    }
    return $value;
}

    public function parseToObject($value)
    {
        $cine=new Cine($value['nombre'],$value['direccion']);
        $cine->setId($value['idCine']);
        return $cine;
    }

    public function consultSales()
    {
        $sql = "SELECT c.idCine, c.nombre, SUM(f.soldTickets) as ventas,SUM(r.capacidad) as capacidadTotal FROM
                    funciones as f INNER JOIN rooms as r ON r.idRoom=f.idRoom INNER JOIN cines as c ON c.idCine=r.idCine GROUP BY c.nombre;";
        
        try
        {
            $this->connection=Connection::GetInstance();
            $resultSet=$this->connection->Execute($sql);
            return $resultSet;
        }
        catch(PDOException $e)
        {
            throw $e;
        }
    }

    public function consultTotal()
    {
        $sql= "SELECT r.idCine,  IFNULL(SUM(p.total),0) as recaudacion FROM rooms as r INNER JOIN funciones as f ON r.idRoom=f.idRoom INNER JOIN compras as c ON f.idFuncion=c.idFuncion INNER JOIN pagos as p ON p.idCompra=c.idCompra
                    GROUP BY f.idRoom;";

        try
        {
            $this->connection=Connection::GetInstance();
            $resultSet=$this->connection->Execute($sql);
        }catch(PDOException $e)
        {
            throw $e;
        }
    }


}
?>