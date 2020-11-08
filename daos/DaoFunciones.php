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
        $movieDao = new daoMovie();
    }

    public function Add($funcion)
    {
        try
        {
            $sql = "INSERT into funciones (idMovie,idRoom,dateF,timeF) values (:idMovie,:idRoom,:date,:time);";
                $parameters["idMovie"] =$funcion->getRoom()->getId();
                $parameters["idRoom"] =$funcion->getMovie()>getId();
                $parameters["date"]=$funcion->getDate();
                $parameters["time"]=$funcion->getHour();
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($sql, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

   public function GetById($id) {
        $funcion = null;
        try
        {
            $parameters['id'] = $id;
            $sql = "SELECT * from funciones where id=:id";
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
        }
        catch (PDOException $e)
        {
            throw $e;
        }
        return $funcion;
    }

    public function remove ($id)
    {
        $value =0;
        try
        {
            $parameters['id'] = $id;
            $sql = "DELETE from funciones where id=:id";  
             $this->connection=Connection::getInstance();
             $value = $this->connection->ExecuteNonQuery($sql,$parameters);
        }
            catch(Exception $ex){
            throw $ex;
        }
        return $value;
    }

    public function getAllMovies(){
        $moviesList=array();
        try{
            $query="SELECT m.* from projections p
                    inner join movies m on p.id_movie=m.id_movie
                    where concat(p.proj_date,' ',p.proj_time) > now()
                    group by m.id_movie";
            $this->connection=Connection::getInstance();
            $results=$this->connection->execute($query);
            foreach ($results as $row) {
                $movie=new Movie($row["title"],
                    $row["id_movie"],
                    $row["synopsis"],
                    $row["poster_url"],
                    $row["video_url"],
                    $row["length"],
                    [],
                    $row["release_date"]);
                $movie->setGenres($this->genrexM->getByMovieId($row["id_movie"]));
                $moviesList[]=$movie;
            }
            return $moviesList;          
        }catch(PDOException $ex){
            throw $ex;
        }
    }

    public function GetAll() {
        $funcionesList=array();
        try
        {
            $sql = "SELECT * from funciones f where datediff(f.dateF,(curdate()-1)) > 0 order by dateF";
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
            $sql = "SELECT * from funciones order by dateF";
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->Execute($sql, $parameters);
            if(!empty($resultSet)) {
                foreach ($resultSet as $row) {
                    return $this->parseToObject($row);
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
        $movieDao= new daoMovie();
        $roomDao= new daoRoom();
        
        $funcion->SetId($value['idFuncion']);
        $funcion->setDate($value['dayFuncion']);
        $funcion->setHour($value['hour']);
        $funcion->setRoom($roomDao->getById($value['idRoom']));
        $funcion->setMovie($movieDao->getById($value['idMovie']));

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
        return funcion_list;
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


}