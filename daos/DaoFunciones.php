<?php

namespace daos;

use Models\Funcion as funcion;
use Models\Movie as movie;
use Models\Room as room;
use daos\DaoRooms as roomDao;
use daos\Connection;
use daos\DaoMovies as movieDao;

class ProjectionDAO {
    private $connection;

    public function __construct() {
        
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
                    $funcion =$this->mapeo($row);

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

    public function GetAll(){
        $funcion_list =array();
        try
        {
            $sql = "SELECT * from funciones f where datediff(f.dateF,(curdate()-1)) > 0 order by dateF";

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->Execute($sql, $parameters);

            if(!empty($resultSet)) {
                foreach ($resultSet as $row) {
                    $funcion =$this->mapeo($row);
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

    public function GetAllList(){
        $funcion_list =array();
        try
        {
            $sql = "SELECT * from funciones order by dateF";
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->Execute($sql, $parameters);
            if(!empty($resultSet)) {
                foreach ($resultSet as $row) {
                    return $this->mapeo($row);
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

    public function mapeo($row){
        $funcion = new Funcion();

        $funcion->setId($row["id"]);
        $funcion->setDate($row["date"]);
        $funcion->setHour($row["hour"]);

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

}