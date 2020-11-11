<?php namespace daos;


use models\Cine as cine;
use daos\Connection as Connection; 

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
    } catch (Exception $ex) { 
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
    } catch (Exception $ex) { 
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

public function Update($idCine){
        $sql = "UPDATE  cines (:nombre,:direccion) where idCine=:idCine";
        $parameters['nombre'] = $cine->getNombre(); 
        $parameters['direccion'] = $cine->getDireccion(); 
        try{
            $this->connection = Connection::GetInstance(); 
            return $this->connection->ExecuteNonQuery($sql, $parameters); 
        } catch (Exception $ex) { 
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
        } catch (Exception $ex) { 
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
        catch(Exception $ex){
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
}
?>