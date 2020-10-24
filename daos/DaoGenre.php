<?php

namespace daos;

use \Exception as Exception;
use daos\Connection as Connection;
use models\Genre as Genre;

class DaoGenre
{

    private $connection;
    private $tableName = "generos";

    public $idGenreDB = "idGenero";
    public $nombreDB = "nombre";


    public function GetAll()
    {
        try {
            $genreList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $genreList = $this->mapeo($resultSet);

            return $genreList;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

 

    public function exist($nombre)
    {
        try {

            $query = "SELECT EXISTS ( SELECT * FROM " . $this->tableName . " WHERE " . $this->nombreDB . " = " . "'" . $nombre . "'" . ");";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            if ($result[0][0] != 1) return false;
            else return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    //falta adaptar la funcion para agregar un arreglo de generos
    public function Add(Genre $genre)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " ( idGenero , nombre ) VALUES ( :idGenero , :nombre ) ;";

            $parameters[$this->idGenreDB] = $genre->getId();
            $parameters[$this->nombreDB] = $genre->getName();


            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /* public function AddFromArray($array)
    {

        if (is_array($array) && $array[0] instanceof Genre) {


            try{
                    
                $query = "INSERT INTO " . $this->tableName . "( idGenero , nombre ) VALUES ( ? , ?)";

                for ($i = 1; $i < count($array); $i++) {

                    $query .= " , ( ? , ? ) ";
                }
                $query .= " ; ";

                echo $query;

                $parameters = array();

                foreach($array as $genre){

                    array_push($parameters, $genre->getId());
                    array_push($parameters, $genre->getName());
                }

                echo "<br>";

                var_dump($parameters);

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters); 

            } catch (Exception $ex) {
                throw $ex;
            }

        }

    } */


    public function genresFromApi()
    {
        $api_url = "https://api.themoviedb.org/3/genre/movie/list?api_key=" . KEY_TMDB . "&language=en-US";
        $api_json = file_get_contents($api_url);
        $api_array = ($api_json) ? json_decode($api_json, true) : array();

        $genre_list = array();

        foreach ($api_array["genres"] as $valuesArray) {
            $genre = new Genre();

            $genre->setId($valuesArray["id"]);
            $genre->setName($valuesArray["name"]);

            array_push($genre_list, $genre);
        }

        return $genre_list;
    }

    
    private function mapeo($value){

        $value = is_array($value) ? $value : [];

        $resp = array_map(
            function($p){
                 return new Genre($p[$this->idGenreDB], $p[$this->nombreDB]);
            }
            , $value);


        return $resp;

    }
 

  

    
}
