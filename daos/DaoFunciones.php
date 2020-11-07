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
    const TABLE_IDFUNCION = "idFuncion";
    const TABLE_IDMOVIE = "idMovie";
    const TABLE_IDROOM = "idRoom";
    const TABLE_DATE = "dayFuncion";
    const TABLE_HOUR = "time";

    private $movieDao;

    public function __construct() 
    {
        $movieDao = new daoMovie();
    }

    public function Add($funcion)
    {
        try
        {
            $sql = "INSERT INTO funciones (idMovie,idRoom,dayFuncion,hour) VALUES (:idMovie,:idRoom,:dayFuncion,:hour);";
            $room=$funcion->getRoom();
            $movie=$funcion->getMovie();
            $parameters["idMovie"] =$movie->getId();
            $parameters["idRoom"] =$room->getId();
            $parameters["dayFuncion"]=$funcion->getDate();
            $parameters["hour"]=$funcion->getHour();
            $this->connection = Connection::getInstance();
            return $this->connection->executeNonQuery($sql, $parameters);
        }
        catch(PDOException $ex)
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

    public function GetById($id) {
        
      
        try
        {
        

            $sql = "SELECT * FROM funciones WHERE id=".$id.";";

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->Execute($sql);

            /*if(!empty($resultSet)) {
                return $this->mapeo($resultSet);
            }*/

          $funcion = $this->parseToObject($resultSet);

          return $funcion;

        }
        catch (PDOException $e)
        {
            throw $e;
        }
        return $funcion;
    }

   /* private function mapeo(){
       
        $value = is_array($value) ? $value : []; 
    
        $resp = array_map( 
            function ($p) { 
 
                $objet =  new Room( 
                    $p[DaoFuncion::TABLE_ID], 
                    $p[DaoFuncion::TABLE_IDMOVIE], 
                    $p[DaoFuncion::TABLE_IDROOM], 
                    $p[DaoFuncion::TABLE_DATE], 
                    $p[DaoFuncion::TABLE_HOUR], 
                ); 
 
                return $objet; 
            }, 
            $value 
        ); 
        return count($resp) > 1 ? $resp : $resp['0']; 
    }*/

    public function remove ($id)
    {
        $value =0;
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
        catch(PDOException $ex){
        throw $ex;
    }

    public function mapeo($row){
        $funcion = new Funcion();

        $funcion->setId($row["id"]);
        $funcion->setDate($row["date"]);
        $funcion->setHour($row["hour"]);

        return $funcion;
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
        catch (PDOException $e)
        {
            throw $e;
        }
    }

    public function GetAll() {

        $funcionesList=array();
        try
        {
            
            $sql = "SELECT * FROM funciones;";

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->Execute($sql);

           

            /*if(!empty($resultSet)) {
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
            }*/

            foreach($resultSet as $value)
            {
                
                array_push($funcionesList,$this->parseToObject($value));
            }

            return $funcionesList;



        }
        catch (PDOException $e)
        {
            throw $e;
        }
        return funcion_list;
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


}