<?php

namespace daos;

use models\Movie as  Movie;
use daos\DaoMovies as movieDAO;

use Models\Genre as Gendre;
use PDOException;
use daos\Connection as Connection;
use daos\QueryType as QueryType;
use \PDO as PDO;

use Models\GenderMovie as GenderMovie;


class DaoGenderMovies
{
    private $connection;


    public function __construct()
    {
        
    }


    public function getAll()
    {
        $gendermovieList=array();

        try
        {
            $sql="SELECT * FROM moviesxgeneros;";

            $this->connection=Connection::GetInstance();
            $value = $this->connection->Execute($sql);

            

            foreach ($value as $fila)
            {
                $gendermovie = new GenderMovie();

                $gendermovie->setIdGender($fila['idGenero']);
                $gendermovie->setIdMovie($fila['idMovie']);
                

                array_push($gendermovieList,$gendermovie);

            }
            return $gendermovieList;
            
        }
        catch(PDOException $e)
        {
            throw $e;
        }
    }


    public function downloadData()
    {
        $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=".KEY_TMDB."&language=en-US&page=1",true);


        $arrayToDecode=($jsonContent) ? json_decode($jsonContent,true):array();


        foreach ($arrayToDecode['results'] as $valueArray)
        {

            
            $movieTitle = $valueArray['title'];
            $genderArray=$valueArray['genre_ids'];

            $movieDAO= new movieDAO();

            $idMovie =$movieDAO->searchIdMovie($movieTitle);
            
          


            foreach($genderArray as $gender)
            {
                $this->Add($idMovie,$gender);
            }

            

        }

    }

    public function Add($idMovie,$idGender)
    {
        $sql="INSERT INTO moviesxgeneros(idMovie,idGenero) values (:idMovie ,:idGenero);";
                  
            $parameters['idMovie']=$idMovie;
            $parameters['idGenero']=$idGender;
                    try
                    {
                        $this->connection = Connection::GetInstance();

                       $this->connection->ExecuteNonQuery($sql,$parameters);
                        
                    }
                    catch(PDOException $e)
                    {
                        throw $e; 
                    }    
    }


    public function getNameGendersxMovie()
    {
        $sql="SELECT mxg.idMovie,g.nombre FROM `moviesxgeneros` as mxg INNER JOIN `generos` as g ON mxg.idGenero=g.idGenero ORDER BY mxg.idMovie ASC;";
       

        try
        {

            $this->connection=Connection::GetInstance();
            return $this->connection->Execute($sql);
    
        }
        catch(PDOException $e)
        {
            throw $e;
        }


    }


}


?>