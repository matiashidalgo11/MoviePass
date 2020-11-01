<?php
namespace daos;

use models\Room as room;
use daos\Connection as Connection;
// Arreglar el Modify

class DaoRooms {

    private $connection;
    const TABLE_NAME = "room";
    const TABLE_IDROOM = "idRoom";
    const TABLE_NOMBRE = "nombre";
    const TABLE_CAPACIDAD ="capacidad";
    const TABLE_PRECIO = "precio";
    const TABLE_IDCINE = "idCine";

    public function __construct(){
              
    }

    public function Add($room, $idCine)
        {

            $sql = "insert into rooms (nombre, capacidad, precio,idCine) values ( :nombre,:capacidad,:precio,:idCine)";

            $parameters['nombre'] =  $room->getNombre();
            $parameters['capacidad'] =  $room->getCapacidad();
            $parameters['precio'] =  $room->getPrecio();
            $parameters['idCine'] =  $idCine;

            try { 
            $this->connection = Connection::GetInstance(); 
    
            return $this->connection->ExecuteNonQuery($sql,$parameters);


        } catch (Exception $ex) { 
            throw $ex; 
        } 
    } 

    public function getById(int $id){ 
        
        try { 
            $sql = "SELECT * FROM  rooms WHERE " . DaoRooms::TABLE_IDROOM . " = '" . $id . "';"; 

            $parameters['id'] = $id;
 
            $this->connection = Connection::GetInstance();
 
            $resultSet = $this->connection->Execute($sql, $parameters);
 
            if(!empty($resultSet) && $object instanceof Room){ 
 
                 return $this->mapeo($resultSet);   
            }
            else{
                return false;
            }
 
 
        } catch (Exception $ex) { 
            throw $ex; 
        } 
       } 

          public function retrieveOne($id) {
        $showtime = null;

        try
        {
            $parameters['id'] = $id;

            $query = "SELECT * FROM showtimes WHERE id=:id";

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->execute($query, $parameters);

            if(!empty($resultSet)) {
                $showtime = $this->read($resultSet[0]);

                $idRoom = $resultSet[0]["id_Room"];
                $idMovie = $resultSet[0]["id_movie"];

                $RoomDAO = new D_Rooms();
                $Room = $RoomDAO->getOne($idRoom);

                $movieDAO = new D_Movies();
                //$movie = $movieDAO->retrieveOneNoCheckMovieDate($idMovie);

                $showtime->setRoom($Room);
                //$showtime->setMovie($movie);
            }
        }
        catch (PDOException $e)
        {
            throw $e;
        }
        return $showtime;
    }


       public function mapeo($value) 
       { 
    
           $value = is_array($value) ? $value : []; 
    
           $resp = array_map( 
               function ($p) { 
    
                   $objet =  new Room( 
                       $p[DaoRooms::TABLE_IDROOM], 
                       $p[DaoRooms::TABLE_NOMBRE], 
                       $p[DaoRooms::TABLE_CAPACIDAD], 
                       $p[DaoRooms::TABLE_PRECIO], 
                       $p[DaoRooms::TABLE_IDCINE], 
                   ); 
    
                   return $objet; 
               }, 
               $value 
           ); 
           return count($resp) > 1 ? $resp : $resp['0']; 
       }
       /* 
       public function modify($room){
        foreach($this->room as $i => $c){
            if($r->getId()== $room->getId()){
                $this->room_list[$i] = $room;
                $this->SaveData();
                return true;
            }
        }
        return false;
    }*/

    public function Update($room){
        $sql = "UPDATE " . DaoRooms::TABLE_NAME . "(" . TABLE_NOMBRE . "," . TABLE_CAPACIDAD . "," . TABLE_PRECIO . "," . TABLE_IDCINE . ")";
        
        
        $parameters[DaoRooms::TABLE_NOMBRE] = $room->getNombre(); 
        $parameters[DaoRooms::TABLE_CAPACIDAD] = $room->getCapacidad(); 
        $parameters[DaoRooms::TABLE_PRECIO] = $room->getPrecio(); 
        $parameters[DaoRooms::TABLE_IDCINE] = $room->getIdCine(); 
    
        try{
            $this->connection = Connection::GetInstance(); 
            return $this->connection->ExecuteNonQuery($sql, $parameters); 
        } catch (Exception $ex) { 
            throw $ex; 
        }
    }

    
    public function getAll(){
        $sql = "select from " . DaoRooms::TABLE_NAME;

        $roomList = array();

        try{
            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($sql);
 
            if(!empty($resultSet) && $object instanceof Room){ 
 
                foreach ($resultSet as $value) {
                    $aux = $this->mapeo($value);
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

    public function getArrayByIdCine($idCine){

        $roomList=array();

        try{
            $sql="SELECT * from rooms where" .  DaoRooms::TABLE_IDCINE . " = '" . $idCine . "';";
            $this->connection=Connection::getInstance();
            $resultSet=$this->connection->execute($sql);
            foreach ($resultSet as $room) {
                $roomList[]=new Room($room["id"],
                    $room["nombre"],
                    $room["capacidad"],
                    $room["precio"],
                    $room["idCine"]);
            }
            return $roomList;
        }catch(Exception $ex){
            throw $ex;
        }
    }
       


}
?>