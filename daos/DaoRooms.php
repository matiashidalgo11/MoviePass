<?php
namespace daos;

use models\Room as room;
use daos\Connection as Connection;

class DaoRooms {
    private $connection;

    public function __construct(){
              
    }

    public function Add($room)
        {
            try { 
            $sql = "INSERT into rooms (nombre, capacidad, precio,idCine) values ( :nombre,:capacidad,:precio,:idCine)";
            $parameters['nombre'] =  $room->getNombre();
            $parameters['capacidad'] =  $room->getCapacidad();
            $parameters['precio'] =  $room->getPrecio();
            $parameters['idCine'] =  $room->getIdCine();
            $this->connection = Connection::GetInstance(); 
            return $this->connection->ExecuteNonQuery($sql,$parameters);
        } catch (Exception $ex) { 
            throw $ex; 
        } 

    } 

    public function getById($idRoom){ 
        $room = null;
        try { 
            $sql = "SELECT r.idRoom,r.nombre,r.precio,r.capacidad,c.idCine from rooms r innner join cines c on c.idCine=r.idCine where idRoom = :idRoom;"; 
            $parameters['idRoom'] = $idRoom;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($sql, $parameters);
            if(!empty($resultSet)){ 
                 $room = $this->mapeo($resultSet);   
            }
        } catch (Exception $ex) { 
            throw $ex; 
        } 
        return $room;
    }

    public function Update($idRoom){
        $sql = "UPDATE rooms (:nombre,:capacidad,:precio,:idCine) where idRoom=:idRoom";
        try{
        $parameters['nombre'] = $room->getNombre(); 
        $parameters['capacidad'] = $room->getCapacidad(); 
        $parameters['precio'] = $room->getPrecio(); 
        $parameters['idCine'] = $room->getIdCine(); 
            $this->connection = Connection::GetInstance(); 
            return $this->connection->ExecuteNonQuery($sql, $parameters); 
        } catch (Exception $ex) { 
            throw $ex; 
        }
    }

    public function GetAll(){
        $sql = "SELECT from r.idRooms, r.nombre, r.precio, r.capacidad, c.idCine from rooms r inner join cines c on c.idCine=r.idCine ";
        $roomList = array();
        try{
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($sql);
            if(!empty($resultSet) && $object instanceof Room){ 
 
                foreach ($resultSet as $row) {
                    $aux = $this->mapeo($row);
                    array_push($roomList,$aux);
                }    
            }
            else{
                return false;
            }
        } catch (Exception $ex) { 
            throw $ex; 
        } 
        return $roomList;
    }

    public function mapeo($row){
        $room = new Room();
        $room->setId($row["idRoom"]);
        $room->setNombre($row["nombre"]);
        $room->setPrecio($row["precio"]);
        $room->setCapacidad($row["capacidad"]);
        $room->setIdCine($row["idCine"]);
        return $room;
    }

    public function getArrayByIdCine($idCine){
        $roomList=array();
        try{
            $sql="SELECT * from rooms where idCine = :idCine ;";
            $this->connection=Connection::getInstance();
            $resultSet=$this->connection->execute($sql);
            foreach ($resultSet as $room) {
                $roomList[]=new Room($room["idRoom"],
                    $room["nombre"],
                    $room["capacidad"],
                    $room["precio"],
                    $room["idCine"]);
            }
        }catch(Exception $ex){
            throw $ex;
        }
        return $roomList;
    }
       
	public function remove($idRoom)
	{
        $value =0;
        try
        {
            $parameters['id'] = $id;
            $sql = "DELETE from rooms where idRoom=:idRoom";  
             $this->connection=Connection::getInstance();
             $value = $this->connection->ExecuteNonQuery($sql,$parameters);
        }
            catch(Exception $ex){
            throw $ex;
        }
        return $value;
    }

}
?>