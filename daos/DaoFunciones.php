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
            $sql = "INSERT INTO funciones (idMovie,idRoom,dayFuncion,hour,soldTickets) VALUES (:idMovie,:idRoom,:dayFuncion,:hour,:soldTickets);";
            $room=$funcion->getRoom();
            $movie=$funcion->getMovie();
            $parameters["idMovie"] =$movie->getId();
            $parameters["idRoom"] =$room->getId();
            $parameters["dayFuncion"]=$funcion->getDate();
            $parameters["hour"]=$funcion->getHour();
            $parameters['soldTickets']=0;
            $this->connection = Connection::getInstance();
            $this->connection->executeNonQuery($sql, $parameters);
        }
        catch(PDOException $ex)
        {
            throw $ex;
        }
    }

 /* Debo ingresar todos los atributos de Movie en el select y la creacion del objeto. Debo crear un atributo genero en el constructor que viene de base DaoGenre.
    public function getArrayByIdRoom($idRoom){
        $funcion_list=array();
        try{
            $sql="SELECT f.idFuncion,f.idRoom,f.time,f.date,m.idMovie,m.title
                    from funciones f
                    inner join movies m on m.idMovie = f.idMovie
                    where f.idRoom = $idRoom and concat(f.date,' ',f.time) > now()";
            $this->connection=Connection::getInstance();
            $resultSet=$this->connection->execute($sql);
            foreach ($resultSet as $row) {
                $movie=new Movie($row["title"],$row["idMovie"]); 
                $movie->setGenres($this->genero->getByIdMovie($row["idMovie"]));
                $funcion_list[]=new Funcion($row["idFuncion"],$movie,$idRoom,$row["date"],$row["time"]);
            }
            return $funcion_list;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }*/

    public function GetById($id) {
        
      
        try
        {
        

            $sql = "SELECT * FROM funciones WHERE idFuncion=".$id.";";

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->Execute($sql);

            /*if(!empty($resultSet)) {
                return $this->mapeo($resultSet);
            }*/
            foreach ($resultSet as $value)
            {

                $funcion = $this->parseToObject($value);
            }

          return $funcion;

        }
        catch (PDOException $e)
        {
            throw $e;
        }
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
        try
        {
            $sql = "DELETE FROM funciones WHERE id=:id";  
             $this->connection=Connection::getInstance();
             return $this->connection->ExecuteNonQuery($sql);
        }
        catch(PDOException $ex){
        throw $ex;
    }
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
            
            $sql = "SELECT * FROM funciones;";

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->Execute($sql);

           

            /*if(!empty($resultSet)) {
                foreach ($resultSet as $row) {
                    return $this->mapeo($resultSet);
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
        $funcion->setSoldTickets($value['soldTickets']);

        return $funcion;
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


}