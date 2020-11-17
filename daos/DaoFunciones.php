<?php

namespace daos;

use Models\Funcion;
use Models\Movie as Movie;
use Models\Room as Room;
use daos\DaoGenres;
use daos\Connection;
use daos\DaoMovies as daoMovie;
use daos\DaoRooms as daoRoom;
use PDOException;

class DaoFunciones {
    private $connection;
    const COLUMN_ENABLED = "enabled";

    private $movieDao;

    public function __construct() 
    {
        $movieDao = DaoMovies::GetInstance();
    }

    public function Add($funcion)
    {
        try
        {
            $sql = "INSERT into funciones (idMovie,idRoom, dayFuncion,hour, soldTickets) values (:idMovie , :idRoom , :dayFuncion , :hour , :soldTickets);";
               
                $parameters["idMovie"] =$funcion->getMovie()->getId();
                $parameters["idRoom"] =$funcion->getRoom()->getId();
                $parameters["dayFuncion"]=$funcion->getDate();
                $parameters["hour"]=$funcion->getHour();
                $parameters["soldTickets"] = "0";

                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(PDOException $ex)
        {
            throw $ex;
        }
    }

    public function GetAll() {
       
        $funcionesList=array();

        $dia = getdate();
        $aux = $dia['year']. "-" . $dia['mon'] . "-" . $dia['mday'];

        try
        {
            $sql="SELECT * FROM funciones WHERE dayFuncion>=".'"'.$aux.'";';
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->Execute($sql);
            foreach($resultSet as $value)
            {   
                array_push($funcionesList,$this->parseToObject($value));
            }
        }
        catch (PDOException $e)
        {
            throw $e;
        }
        return $funcionesList;
    }

    public function GetAllList(){
        $funcion_list =array();
        try
        {
            $sql = "SELECT * from funciones order by dayFuncion;";
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->Execute($sql);
            if(!empty($resultSet)) {
                foreach ($resultSet as $row) {
                   $funcion= $this->parseToObject($row);
                    $idRoom = $row["idRoom"];
                    $idMovie = $row["idMovie"];
                    $DaoRoom = new daoRoom();
                    $room = $DaoRoom->GetById($idRoom);
                    $DaoMovie = DaoMovies::GetInstance();
                    $movie = $DaoMovie->GetById($idMovie);
                    $funcion->setRoom($room);
                    $funcion->setMovie($movie);
                    array_push($funcion_list,$funcion);
                }
            }
        }
        catch (PDOException $e)
        {
            throw $e;
        }
        return $funcion_list;
    }

    public function mapeo($row){
        $funcion = new Funcion();
        $funcion->setId($row["id"]);
        $funcion->setDate($row["date"]);
        $funcion->setHour($row["hour"]);
        return $funcion;
    }

    public function parseToObject($value)
    {
        
        $funcion = new Funcion();
        $movieDao= DaoMovie::GetInstance();
        $roomDao= new daoRoom();
        
        $funcion->SetId($value['idFuncion']);
        $funcion->setDate($value['dayFuncion']);
        $funcion->setHour($value['hour']);
        $funcion->setRoom($roomDao->getById($value['idRoom']));
        $funcion->setMovie($movieDao->getById($value['idMovie']));
        $funcion->setSoldTickets($value['soldTickets']);

        return $funcion;
    }
    
    public function GetRowsByDate($date) {
        try
        {
            $parameters['date'] = $date;
            $sql = "SELECT count(*) from funciones where date>=:date";
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql, $parameters);
            return $resultSet[0]["COUNT(*)"];
        }
        catch (PDOException $e)
        {
            throw $e;
        }
    }

    public function getDate()
	{
		$dateList = array();
        try
        {
            $sql = "SELECT dateF as 'Fecha',COUNT(dateF) from funciones f where DATEDIFF(f.date,(CURDATE()-1)) > 0 group by dateF";
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql);
            if(!empty($resultSet)) {
                foreach ($resultSet as $row) {
					$date = $row['Fecha'];
                    array_push($dateList, $date);
                }
            }
        }
        catch (PDOException $e)
        {
            throw $e;
        }
        return $dateList;
    }

    public function GetAllByDate($date) {
        $funcion_list =array();
        try
        {
            $parameters['date'] = $date;
            $sql = "SELECT * from funciones where dateF=:date ORDER BY dateF";
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->Execute($sql, $parameters);
            if(!empty($resultSet)) {
                foreach ($resultSet as $row) {
                    $funcion =$this->parseToObject($row);
                    $idRoom = $row["idRoom"];
                    $idMovie = $row["idMovie"];
                    $DaoRoom = new DaoRooms();
                    $room = $DaoRoom->GetById($idRoom);
                    $DaoMovie = DaoMovies::GetInstance();
                    $movie = $DaoMovie->GetById($idMovie);
                    $funcion->setRoom($room);
                    $funcion->setMovie($movie);
                    array_push($funcion_list,$funcion);
                }
            }
        }
        catch (PDOException $e)
        {
            throw $e;
        }
    }

    public function checkSeats($idFuncion,$totalTicket)
    {
        $funcion=$this->GetById($idFuncion);

        if($funcion->getSoldTickets()+$totalTicket <= $funcion->getRoom()->getCapacidad())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function GetById($id) {  
        try {  
             $sql = "SELECT * FROM funciones WHERE idFuncion = ".$id.";"; 
             $this->connection = Connection::getInstance(); 
             $resultSet = $this->connection->Execute($sql);
            
                foreach ($resultSet as $value){    
                     $funcion = $this->parseToObject($value);  } 
                     
                      return $funcion;  
                    
            } catch (PDOException $e)  { 
                throw $e;  }
            }

    public function upDateSale($idFuncion,$totalTicket)
    {
        $funcion=$this->GetById($idFuncion);

        $ventas=$funcion->getSoldTickets()+$totalTicket;
        $parameters['idFuncion']=$idFuncion;
        $parameters['soldTickets']=$ventas;
        $sql="UPDATE funciones SET soldTickets=:soldTickets WHERE idFuncion=:idFuncion;";
        try
        {
            $this->connection=Connection::GetInstance();
            $this->connection->ExecuteNonQuery($sql,$parameters);
        }catch(PDOException $e)
        {
            throw $e;
        }
    }


    public function GetEnabled(){
        $sql = "SELECT * FROM funciones where " . DaoFunciones::COLUMN_ENABLED . "=1";
        $funcionList = array();
        try{
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($sql);
            if(!empty($resultSet)){ 
                foreach ($resultSet as $row) {
                    $aux = $this->parseToObject($row);
                    array_push($funcionList,$aux);
                }  
            }
            } catch (PDOException $ex) { 
                throw $ex; 
            } 
        return $funcionList;
    }

    public function remove($idFuncion)
	{
      
        try
        {

            $sql = "UPDATE funcion set " . DaoRooms::COLUMN_ENABLED . " = 0 where idFuncion = :idFuncion";  
             
            $this->connection=Connection::getInstance();

            $value = $this->connection->ExecuteNonQuery($sql);

        }
            catch(Exception $ex){
            throw $ex;
        }
       
    }

    public function removeByIdRoom($idRoom)
	{
        try
        {
            $sql = "DELETE from funciones where idRoom = :idRoom";  
            $this->connection=Connection::getInstance();
            $value = $this->connection->ExecuteNonQuery($sql);

        }
            catch(PDOException $ex){
            throw $ex;
        }
       
    }

    public function funcionExistence($idMovie,$day)
    {
        $sql="SELECT COUNT(idMovie) as MovieScreen FROM funciones WHERE dayFuncion=".'"'.$day.'"'. "and idMovie=".$idMovie.  ";";
        try
        {
            $this->connection=Connection::GetInstance();
            $value=$this->connection->Execute($sql);
    

            foreach($value as $valueArray)
            {
                if($valueArray['MovieScreen']>0)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        catch(PDOException $e)
        {
            throw $e;
        }  
    }

    public function getAllByDateRoom($date,$idRoom){
        $sql="SELECT f.id, f.date ,f.time, r.id, r.capacidad, r.precio, m.popularity, m.video, m.id, m.original_language, m.genre_ids, m.title, m.overview, m.release_date, m.enabled from funciones f inner join movies m on f.idMovie = m.id inner join rooms r on r.idRoom = f.idRoom where f.date = :date and r.idRoom = :idRoom";
        try {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->Execute($sql);
            if(!empty($resultSet)) {
                foreach ($resultSet as $row) {
                    $funcion =$this->parseToObject($row);
                    $idRoom = $row["idRoom"];
                    $idMovie = $row["idMovie"];
                    $DaoRoom = new roomDao();
                    $room = $DaoRoom->GetById($idRoom);
                    $DaoMovie = new movieDao();
                    $movie = $DaoMovie->GetById($idMovie);
                    $funcion->setRoom($room);
                    $funcion->setMovie($movie);
                    array_push($funcion_list,$funcion);
                }
            }
        }
        catch (PDOException $e)
        {
            throw $e;
        }
        return $funcion_list;
    }

   public function consultSales()
   {
       $sql="SELECT f.idFuncion,f.soldTickets,(r.capacidad-f.soldTickets) as remanentes from funciones as f INNER JOIN rooms as r ON f.idRoom=r.idRoom
                GROUP by f.idFuncion;";

        try
        {
            $this->connection=Connection::GetInstance();
            $resultSet=$this->connection->Execute($sql);
            return $resultSet;
        }catch(PDOException $e)
        {
            throw $e;
        }
   }

   public function searchByName($nameMovie)
   {
       $funcionesList=array();
       $sql="SELECT * FROM funciones as f INNER JOIN movies as m ON f.idMovie=m.idMovie WHERE m.title LIKE '%". $nameMovie . "%';";
       echo $sql;
       try
       {
            $this->connection=Connection::GetInstance();
            $resultSet=$this->connection->Execute($sql);
            foreach($resultSet as $value)
            {
                array_push($funcionesList,$this->parseToObject($value));
            }
            return $funcionesList;

       }catch(PDOException $e)
       {
           throw $e;
       }
   }

   public function searchByDate($date)
   {
       $funcionesList=array();
       $sql="SELECT * FROM funciones WHERE dayFuncion=".'"'.$date.'"'.";";
       try
       {
            $this->connection=Connection::GetInstance();
            $resultSet=$this->connection->Execute($sql);
            foreach($resultSet as $value)
            {
                array_push($funcionesList,$this->parseToObject($value));
            }
            return $funcionesList;

       }catch(PDOException $e)
       {
           throw $e;
       }
   }

   public function searchByGenre($idGender)
   {
       $funcionesList=array();
      $sql="SELECT * FROM funciones as f INNER JOIN moviesxgeneros as mxg ON f.idMovie=mxg.idMovie WHERE mxg.idGenero=".$idGender.";";
      try
      {
        $this->connection=Connection::GetInstance();
        $resultSet=$this->connection->Execute($sql);
        foreach($resultSet as $value)
        {
            array_push($funcionesList,$this->parseToObject($value));
        }
        return $funcionesList;
      }catch(PDOException $e)
      {
          throw $e;
      }

        
   }



}