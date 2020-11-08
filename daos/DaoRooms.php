<?php
namespace daos;

use models\Room as room;
use daos\Connection as Connection;
use PDOException;

use daos\DaoCines as DaoCines;

use models\Cine;

// Arreglar el Modify



class DaoRooms {

    private $connection;

    public function __construct(){
              
    }
    public function Add($room)
    {
        try { 
        $sql = "INSERT into rooms (nombre, capacidad, precio,cine) values ( :nombre,:capacidad,:precio,:cine)";
        $parameters['nombre'] =  $room->getNombre();
        $parameters['capacidad'] =  $room->getCapacidad();
        $parameters['precio'] =  $room->getPrecio();
        $parameters['cine'] =  $room->getCine();
        $this->connection = Connection::GetInstance(); 
        return $this->connection->ExecuteNonQuery($sql,$parameters);
        } catch (Exception $ex) { 
            throw $ex; 
        } 
    }

       public function getRoomsXcinema($cine)
       {

        $sql = "SELECT * FROM  rooms WHERE cine=".$cine.";"; 
        $roomList=array();

        try 
        { 
          
            $this->connection = Connection::GetInstance();
 
            $resultSet = $this->connection->Execute($sql);
            
            

            foreach($resultSet as $value)
            {
                array_push($roomList,$this->parseToObject($value));
            }
            return $roomList;
 
 
        } 
        catch (PDOException $ex)
         { 
            throw $ex; 
        } 

       }

       public function getById($idRoom){ 
        $room = null;
        try { 
            $sql = "SELECT r.idRoom,r.nombre,r.precio,r.capacidad,c.cine from rooms r innner join cines c on c.cine=r.cine where idRoom = :idRoom;"; 
            $parameters['idRoom'] = $idRoom;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($sql, $parameters);
            if(!empty($resultSet)){ 
                 $room = $this->parseToObject($resultSet);   
            }
        } catch (Exception $ex) { 
            throw $ex; 
        } 
        return $room;
    }
    
    public function mapeo($row){
        $room = new Room();
        $room->setId($row["idRoom"]);
        $room->setNombre($row["nombre"]);
        $room->setPrecio($row["precio"]);
        $room->setCapacidad($row["capacidad"]);
        $room->setCine($row["cine"]);
        return $room;
    }
    
    public function Update($idRoom){
        $sql = "UPDATE rooms (:nombre,:capacidad,:precio,:cine) where idRoom=:idRoom";
        try{
        $parameters['nombre'] = $room->getNombre(); 
        $parameters['capacidad'] = $room->getCapacidad(); 
        $parameters['precio'] = $room->getPrecio(); 
        $parameters['cine'] = $room->getCine(); 
            $this->connection = Connection::GetInstance(); 
            return $this->connection->ExecuteNonQuery($sql, $parameters); 
        } catch (Exception $ex) { 
            throw $ex; 
        }
    }
    
    public function GetAll(){
        $sql = "SELECT from r.idRooms, r.nombre, r.precio, r.capacidad, c.cine from rooms r inner join cines c on c.cine=r.cine ";
        $roomList = array();
        try{
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($sql);
            if(!empty($resultSet) && $object instanceof Room){ 
 
                foreach ($resultSet as $row) {
                    $aux = $this->parseToObject($row);
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

    public function parseToObject($value)
    {   
       
        $cinemaDao= new DaoCines();
        $room= new room();
        
        
           $room->setId($value['idRoom']);
           $room->setCapacidad($value['capacidad']);
           $room->setPrecio($value['precio']);
           $room->setNombre($value['nombre']);
           $room->setCine($cinemaDao->getById($value['cine']));
   
       

        return $room;
    }
    
    public function getArrayByCine($cine){
        $roomList=array();
        try{
            $sql="SELECT * from rooms where cine = :cine ;";
            $this->connection=Connection::getInstance();
            $resultSet=$this->connection->execute($sql);
            foreach ($resultSet as $room) {
                $roomList[]=new Room($room["idRoom"],
                    $room["nombre"],
                    $room["capacidad"],
                    $room["precio"],
                    $room["cine"]);
            }
        }catch(Exception $ex){
            throw $ex;
        }
        return $roomList;
    }
       


}
?>