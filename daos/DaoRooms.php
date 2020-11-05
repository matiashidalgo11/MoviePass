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

            $sql = "insert into rooms (nombre, capacidad, precio,idCine) values ( :nombre,:capacidad,:precio,:idCine);";

            $parameters['nombre'] =  $room->getNombre();
            $parameters['capacidad'] =  $room->getCapacidad();
            $parameters['precio'] =  $room->getPrecio();
            $parameters['idCine'] =  $room->getIdCine();
            $this->connection = Connection::GetInstance(); 
            return $this->connection->ExecuteNonQuery($sql,$parameters);


        } catch (PDOException $ex) { 
            throw $ex; 
        } 

    } 

  

       public function getRoomsXcinema($idCine)
       {

        $sql = "SELECT * FROM  rooms WHERE idCine=".$idCine.";"; 
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

                $RoomDAO = new DaoCines();
                $Room = $RoomDAO->getOne($idRoom);

                $movieDAO = new DaoMovies();
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
                    $p[DaoRooms::TABLE_IDCINE]
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
        $sql = "UPDATE " . DaoRooms::TABLE_NAME . "(" . DaoRooms::TABLE_NOMBRE . "," . DaoRooms::TABLE_CAPACIDAD . "," . DaoRooms::TABLE_PRECIO . "," . DaoRooms::TABLE_IDCINE . ")";
        
        
        $parameters[DaoRooms::TABLE_NOMBRE] = $room->getNombre(); 
        $parameters[DaoRooms::TABLE_CAPACIDAD] = $room->getCapacidad(); 
        $parameters[DaoRooms::TABLE_PRECIO] = $room->getPrecio(); 
        $parameters[DaoRooms::TABLE_IDCINE] = $room->getIdCine(); 
        
        try{
        $parameters['nombre'] = $room->getNombre(); 
        $parameters['capacidad'] = $room->getCapacidad(); 
        $parameters['precio'] = $room->getPrecio(); 
        $parameters['idCine'] = $room->getIdCine(); 
            $this->connection = Connection::GetInstance(); 
            return $this->connection->ExecuteNonQuery($sql, $parameters); 
        } catch (PDOException $ex) { 
            throw $ex; 
        }
    }
    
    
    public function getAll(){
        $sql = " SELECT * FROM " . DaoRooms::TABLE_NAME.";";
        
        $roomList = array();
        
        try{
            $this->connection = Connection::GetInstance();
            
            $resultSet = $this->connection->Execute($sql);
            
            /*if(!empty($resultSet) && $object instanceof Room){ 
                
                foreach ($resultSet as $value) {
                    $aux = $this->mapeo($value);
                    array_push($roomList,$aux);
                }    
            }
            else{
                return false;
            }*/
            
            foreach($resultSet as $value)
            {
                foreach ($value as $valueArray)
                array_push($roomList,$this->parseToObject($valueArray));
            }
            return $roomList;
            
        } catch (PDOException $ex) { 
            throw $ex; 
        } 
        return $roomList;
        
    }

    public function getById($id){ 
        
        $room=new room();
        try { 
            $sql = "SELECT * FROM  rooms WHERE " . DaoRooms::TABLE_IDROOM . " =" . $id . ";"; 

            
            
            $this->connection = Connection::GetInstance();
 
            $resultSet = $this->connection->Execute($sql);

            
 
            /*if(!empty($resultSet) && $object instanceof Room){ 
 
                 return $this->mapeo($resultSet);   
            }
            else{
                return false;
            }*/
            foreach($resultSet as $value)
            {

                $room=$this->parseToObject($value);
            }
            return $room;
 
        } catch (PDOException $ex) { 
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
    
    public function getArrayByIdCine($idCine){
        
        $roomList=array();
        
        try{
            $sql="SELECT * from rooms where idCine = :idCine ;";
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
        }catch(PDOException $ex){
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