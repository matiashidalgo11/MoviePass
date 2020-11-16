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
    const COLUMN_ENABLED = "enabled";
    const TABLE_NAME = "room";
    const TABLE_IDROOM = "idRoom";
    const TABLE_NOMBRE = "nombre";
    const TABLE_CAPACIDAD ="capacidad";
    const TABLE_PRECIO = "precio";
    const TABLE_IDCINE = "idCine";
    

    public function __construct(){
              
    }
    public function Add($room)
    {
        try { 
        $sql = "INSERT into rooms (nombre, capacidad, precio,idCine,enabled) values ( :nombre,:capacidad,:precio,:cine,:enabled)";
        $parameters['nombre'] =  $room->getNombre();
        $parameters['capacidad'] =  $room->getCapacidad();
        $parameters['precio'] =  $room->getPrecio();
        $parameters['cine'] =  $room->getCine()->getId();
        $parameters['enabled']=1;
        $this->connection = Connection::GetInstance(); 
        return $this->connection->ExecuteNonQuery($sql,$parameters);
        } catch (PDOException $ex) { 
            throw $ex; 
        } 
    }

    //le pasas un cine objeto
       public function getRoomsXcinema($idCine)
       {

        $sql = "SELECT * FROM  rooms WHERE idCine = " . $idCine ." ;"; 
        echo $sql;
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
            $sql = "SELECT * FROM rooms  where idRoom = $idRoom ;"; 
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($sql);
            if(!empty($resultSet)){ 
                 $room = $this->parseToObject($resultSet[0]);   
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
    
    //faltaria testear
    public function Update($room){
        $sql = "UPDATE rooms set nombre= :nombre, capacidad= :capacidad, precio= :precio where idRoom= " . $room->getId() . ";";
        echo $sql;
        try{
        $parameters['nombre'] = $room->getNombre(); 
        $parameters['capacidad'] = $room->getCapacidad(); 
        $parameters['precio'] = $room->getPrecio(); 
            $this->connection = Connection::GetInstance(); 
            return $this->connection->ExecuteNonQuery($sql, $parameters); 
        } catch (Exception $ex) { 
            throw $ex; 
        }
    }
    
    public function GetAll(){
        $sql = "SELECT *  from rooms r ; ";
        $roomList = array();
        try{
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($sql);
            

            if(!empty($resultSet)){ 
 
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

    
    public function GetEnabled(){
        $sql = "SELECT * FROM rooms where" . DaoRooms::COLUMN_ENABLED . "=1";
        $roomList = array();
        try{
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($sql);
            if(!empty($resultSet)){ 
                foreach ($resultSet as $row) {
                    $aux = $this->parseToObject($row);
                    array_push($roomList,$aux);
                }  
            }
            } catch (PDOException $ex) { 
                throw $ex; 
            } 
        return $roomList;
    }

    public function remove($idRoom)
	{
      
        try
        {

            $sql = "UPDATE rooms set " . DaoRooms::COLUMN_ENABLED . " = 0 where idRoom = $idRoom";  
             
            $this->connection=Connection::getInstance();

            $value = $this->connection->ExecuteNonQuery($sql);

        }
            catch(Exception $ex){
            throw $ex;
        }
       
    }

    public function parseToObject($value)
    {   

        $cinemaDao= new DaoCines();
        $room= new room();
        
        
           $room->setId($value['idRoom']);
           $room->setCapacidad($value['capacidad']);
           $room->setPrecio($value['precio']);
           $room->setNombre($value['nombre']);
           $room->setCine($cinemaDao->getById($value['idCine']));
   
       

        return $room;
    }
    
    public function getArrayByCine($idCine){
        $roomList=array();
        try{
            $sql="SELECT * from rooms where idCine = $idCine ;";
            $this->connection=Connection::getInstance();
            $resultSet=$this->connection->execute($sql);
            foreach ($resultSet[0] as $room) {
                $roomList[]=new Room($room["idRoom"],
                    $room["nombre"],
                    $room["capacidad"],
                    $room["precio"],
                    $room["cine"]);
            }
        }catch(Exception $ex){
            throw $ex;
        }
    }
       


}
?>