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

   /* public function GetById($id) {
        $funcion = null;
        try
        {
            $parameters['id'] = $id;
            $sql = "SELECT * from funciones where idFuncion = $id";
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->Execute($sql, $parameters);
            if(!empty($resultSet)) {
                $funcion = $this->mapeo($resultSet[0]);
                $idRoom = $resultSet[0]["idRoom"];
                $idMovie = $resultSet[0]["idMovie"];
                $DaoRoom = new roomDao();
                $room = $DaoRoom->GetById($idRoom);
                $DaoMovie = new movieDao();
                $movie = $DaoMovie->GetById($idMovie);
                $funcion->setRoom($room);
                $funcion->setMovie($movie);
            }
            return $funcion_list;
        }
        catch(Exception $ex){
            throw $ex;
        }
    } */


 



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
    

    public function cheackSeats ($id,$totalTickets){
        $value = false;
        // crear una capacidad actual que empiece con 0 y se vaya sumando cada ves que haya una compra, ir comparando constantemente con la capcidad total
        //, al llegar al limite retornar falso
        try{
          /*  if(capacidadTotal >= capacidadActual + TotalTickets){
                $value = true;
            }*/
        }
        catch (PDOException $e)
        {
            throw $e;
        }
        return $value;
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

    //Falta remove
    public function removeByIdRoom($idRoom)
	{
        try
        {
            $sql = "DELETE from funciones where idRoom = $idRoom";  
            $this->connection=Connection::getInstance();
            $value = $this->connection->ExecuteNonQuery($sql);

        }
            catch(PDOException $ex){
            throw $ex;
        }
       
    }


}