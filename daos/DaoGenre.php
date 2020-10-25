<?php

namespace daos;

use \Exception as Exception;
use daos\Connection as Connection;
use models\Genre as Genre;

class DaoGenre
{

    private $connection;
    private $tableName = null;
    private static $instance = null;

    public static $idGenreDB = "idGenero";
    public static $nombreDB = "nombre";

    private function __construct()
    {     
        $this->tableName = "generos";
    }

    public static function GetInstance()
    {
        if(self::$instance == null)
            self::$instance = new DaoGenre();

        return self::$instance;
    }

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

            $query = "SELECT EXISTS ( SELECT * FROM " . $this->tableName . " WHERE " . DaoGenre::$nombreDB . " = " . "'" . $nombre . "'" . ");";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            if ($result[0][0] != 1) return false;
            else return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getById(int $id)
    {

        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE " . DaoGenre::$idGenreDB . " = " . "'" . $id . "'" . " ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);

            $array = !empty($array) ? $array[0] : [];

            return $array;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function arrayToGenre(array $genreIds){
        
        $arregloGeneros = array();

        foreach($genreIds as $id){
            if($id instanceof int){

                $object = $this->getById($id);

                if(!empty($object)){
                    array_push($arregloGeneros, $object);
                }
            }
        }

        return $arregloGeneros;
    }

    public function Add(Genre $genre)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " ( idGenero , nombre ) VALUES ( :idGenero , :nombre ) ;";

            $parameters[DaoGenre::$idGenreDB] = $genre->getId();
            $parameters[DaoGenre::$nombreDB] = $genre->getName();


            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }


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


    public static function mapeo($value)
    {

        $value = is_array($value) ? $value : [];

        $resp = array_map(
            function ($p) {
                return new Genre($p[DaoGenre::$idGenreDB], $p[DaoGenre::$nombreDB]);
            },
            $value
        );


        return $resp;
    }
}
