<?php

namespace daos;

use \Exception as Exception;
use daos\Connection as Connection;
use daos\DaoGenre as DaoGenre;
use models\Movie as Movie;
use models\Genre as Genre;
use PDOException;

class DaoMovies implements IDao
{

    private $connection;
    

    //Info db
    const TABLENAME = "movies";
    const TABLE_POPULARITY = "popularity";
    const TABLE_VIDEO = "video";
    const TABLE_POSTERPATH = "posterPath";
    const TABLE_IDMOVIE = "idMovie";
    const TABLE_ORIGINALLANGUAGE = "originalLanguage";
    const TABLE_TITLE = "title";
    const TABLE_OVERVIEW = "overview";
    const TABLE_RELEASEDATA = "releaseData";
    const TABLE_ENABLED = "enabled";

    public function __construct(){
        
    }


    //*Modificar para que solo funcione con peliculas habilitadas
    //Funcion que retorna todas las peliculas por el idGenero 
    public function genreMovies(Genre $genre){
        
        $query = " SELECT x.idMovie
            FROM moviesxgeneros AS x 
            WHERE x.idGenero = " . $genre->getId() . " ;";

        $this->connection = Connection::GetInstance();

        $resultSet = $this->connection->Execute($query);

        $movies = array();

        foreach($resultSet as $dato){

            $movie = $this->getById($dato[DaoMovies::TABLE_IDMOVIE]);
            array_push($movies, $movie);

        }
       
        return $movies;
    }

    public function update($movie){
       
        if($movie instanceof Movie){
            
            if($this->exist($movie)){

                try{

                $query = "UPDATE " . DaoMovies::TABLENAME .
                " SET " . DaoMovies::TABLE_POPULARITY . " = :" . DaoMovies::TABLE_POPULARITY . " , ".
                DaoMovies::TABLE_VIDEO . " = :" . DaoMovies::TABLE_VIDEO . " , ".
                DaoMovies::TABLE_POSTERPATH . " = :". DaoMovies::TABLE_POSTERPATH . " , ".
                DaoMovies::TABLE_ORIGINALLANGUAGE . " = :" . DaoMovies::TABLE_ORIGINALLANGUAGE . " , ".
                DaoMovies::TABLE_TITLE . " = :" . DaoMovies::TABLE_TITLE . " , ".
                DaoMovies::TABLE_OVERVIEW . " = :" . DaoMovies::TABLE_OVERVIEW . " , ".
                DaoMovies::TABLE_RELEASEDATA . " = :" . DaoMovies::TABLE_RELEASEDATA . " , ".
                DaoMovies::TABLE_ENABLED . " = :" . DaoMovies::TABLE_ENABLED.
                " WHERE " . DaoMovies::TABLE_IDMOVIE . " = " . $movie->getId() . " ;";

                $parameters = $this->toArray($movie,1);

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                $this->deleteGenresMovie($movie->getId());

                $this->addGenreMovie($movie->getGenre_ids(), $movie->getId());

                }
                catch (Exception $ex) {
                    throw $ex;
                }

            }
        }
    }

    private function deleteGenresMovie($idMovie){
       
        try{
        $query = "DELETE FROM moviesxgeneros 
        WHERE " . DaoMovies::TABLE_IDMOVIE ." = " . $idMovie ." ; ";

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query);
        }

        catch (Exception $ex) {
            throw $ex;
        }

    }

    //Falta testear
    public function delete($object)
    {
        if($object instanceof Movie){

            if($this->exist($object)){
                try{

                $this->deleteGenresMovie($object->getId());

                $query = "DELETE FROM ". DaoMovies::TABLENAME . 
                " WHERE " . DaoMovies::TABLE_IDMOVIE ." = " . $object->getId() . " AND " . DaoMovies::TABLE_TITLE . " = " . $object->getTitle() ." ; ";

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query);

                

            }
            catch (Exception $ex) {
                throw $ex;
            }
            }
        }
        //desarrollar
    }

    public function getAll()
    {
        $movieList=array();
        
        $query = "SELECT * FROM " . DaoMovies::TABLENAME . " ;";

        
        try {

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

           /* $array = $this->mapeo($resultSet);


            if (!empty($array)) {

                foreach ($array as $movie) {
                    $movie->setGenre_ids($this->movieGenres($movie->getId()));
                }
            }
            return $array;*/
            
            
            foreach($resultSet as $value)
            {
                array_push($movieList,$this->parseToObject($value));
            }

            
            return $movieList;


        } catch (Exception $ex) {
            throw $ex;
        }
    }


  

    public function getEnabled()
    {
        try {
            $query = "SELECT * FROM " . DaoMovies::TABLENAME .  " WHERE " . DaoMovies::TABLE_ENABLED . " = " . "'" . true . "'" ." ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);


            if (!empty($array)) {

                foreach ($array as $movie) {
                    $movie->setGenre_ids($this->movieGenres($movie->getId()));
                }
            }

            return $array;
        } catch (PDOException $ex) {
            throw $ex;
        }
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . DaoMovies::TABLENAME . " WHERE " . DaoMovies::TABLE_IDMOVIE . " = "  . $id . " ;";

        

        try {

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            /*$array = $this->mapeo($resultSet);

            $object = !empty($array) ? $array[0] : [];

            if (!empty($object) && $object instanceof Movie) {

                $object->setGenre_ids($this->movieGenres($object->getId()));
            }

            return $object;*/
            foreach($resultSet as $value)
            {

                $movie=$this->parseToObject($value);
            }

            return $movie;

        } catch (PDOException $ex) {
            throw $ex;
        }
    }

    public function add($movie)
    {
        if ($movie instanceof Movie) {


            try {
                $query = "INSERT INTO " . DaoMovies::TABLENAME . "( " . DaoMovies::TABLE_IDMOVIE . " , " . DaoMovies::TABLE_POPULARITY . " , " . DaoMovies::TABLE_VIDEO . " , " . DaoMovies::TABLE_POSTERPATH . " , "  . DaoMovies::TABLE_ORIGINALLANGUAGE . " , " . DaoMovies::TABLE_TITLE . " , " . DaoMovies::TABLE_OVERVIEW . " , " . DaoMovies::TABLE_RELEASEDATA . " , " . DaoMovies::TABLE_ENABLED . " ) " .
                    " VALUES ( " . ":" . DaoMovies::TABLE_IDMOVIE . " , " . ":" . DaoMovies::TABLE_POPULARITY . " , " . ":" . DaoMovies::TABLE_VIDEO . " , " . ":" . DaoMovies::TABLE_POSTERPATH . " , " . ":" . DaoMovies::TABLE_ORIGINALLANGUAGE . " , " . ":" . DaoMovies::TABLE_TITLE . " , " . ":" . DaoMovies::TABLE_OVERVIEW . " , " . ":" . DaoMovies::TABLE_RELEASEDATA . " , " . ":" . DaoMovies::TABLE_ENABLED . " ) ; ";

                $parameters = $this->toArray($movie);

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                $this->addGenreMovie($movie->getGenre_ids(), $movie->getId());

            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

    //Agregar los generos de la movie a la tabla de moviesxgeneros
    private function addGenreMovie(array $genres, $idMovie)
    {
        try {

            $query = "INSERT INTO" . " moviesxgeneros " . "( idMovie , idGenero ) " . "VALUE" . " ( :idMovie , :idGenero ) ;";

            $parameters[DaoMovies::TABLE_IDMOVIE] = $idMovie;

            $this->connection = Connection::GetInstance();


            foreach ($genres as $genre) {

                if ($genre instanceof Genre) {

                    $parameters['idGenero'] = $genre->getId();

                    $this->connection->ExecuteNonQuery($query, $parameters);
                }
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    //Devuelve un arreglo con los generos que se relacionan con el idMovie
    public function movieGenres(int $idMovie)
    {

        $query = " SELECT g.idGenero , g.nombre
            FROM moviesxgeneros AS x 
            INNER JOIN generos  AS g ON x.idGenero = g.idGenero
            WHERE x.idMovie = " . $idMovie . " ;";

        $this->connection = Connection::GetInstance();

        $resultSet = $this->connection->Execute($query);

        

        $genreList = $this->genderDAO->mapeo($resultSet);

        $genreList = !empty($genreList) ? $genreList : [];

        return $genreList;
    }


    //Devuelve un arreglo de Movies que vienen de la API
    public function moviesFromApi()
    {

        $api_url = "https://api.themoviedb.org/3/movie/now_playing?page=1&language=en-US&api_key=" . KEY_TMDB;
        $api_json = file_get_contents($api_url);
        $api_array = ($api_json) ? json_decode($api_json, true) : array();


        $new_movie_list = array();

        foreach ($api_array['results'] as $valuesArray) {
            $movie = new Movie();

            $movie->setPopularity($valuesArray["popularity"]);
            $movie->setVideo($valuesArray["video"]);
            $movie->setPoster_path($valuesArray["poster_path"]);
            $movie->setId($valuesArray["id"]);
            $movie->setOriginal_language($valuesArray["original_language"]);
            $movie->setTitle($valuesArray["title"]);
            $movie->setOverview($valuesArray["overview"]);
            $movie->setRelease_date($valuesArray["release_date"]);
            $movie->setEnabled(true);

            $GenreDao = DaoGenres::GetInstance();

            $genreList = $GenreDao->arrayToGenre($valuesArray["genre_ids"]);

            $movie->setGenre_ids($genreList);


            array_push($new_movie_list, $movie);
        }


        return $new_movie_list;
    }

    public function updateFromApi(){

        $newMovies = $this->moviesFromApi();
        $this->disableMovies();

        foreach($newMovies as $nMovie){

            if($this->exist($nMovie) && !($this->enabled($nMovie->getId())) ){
                $this->update($nMovie);
            }else if (!($this->exist($nMovie))){
                $this->add($nMovie);
            }
        }
    }

    //Deshabilita las peliculas que se encuentran en cartelera
    private function disableMovies(){

        $movies = $this->getEnabled();
        
        foreach($movies as $movie){
            $movie->setEnabled(false);
            $this->update($movie);
        }
        
    }

    //agregarle a la query tambien por el titulo
    public function exist($movie)
    {   
        if($movie instanceof Movie){
        try {

            $query = "SELECT EXISTS ( SELECT * FROM " . DaoMovies::TABLENAME . " WHERE " . DaoMovies::TABLE_IDMOVIE . " = " . "'" . $movie->getId() . "'" . ");";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            if ($result[0][0] != 1) return false;
            else return true;
            
        } catch (Exception $ex) {
            throw $ex;
        }
        }else return false;
    }

    private function enabled($idMovie)
    {   
        
        try {

            $query = "SELECT EXISTS ( SELECT * FROM " . DaoMovies::TABLENAME . " WHERE " . DaoMovies::TABLE_IDMOVIE . " = " . "'" . $idMovie . "'" . " AND " . DaoMovies::TABLE_ENABLED . " = true" .");";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            /* if ($result[0][0] != 1) return false;
            else return true; */

            $resp = ($result[0][0] != 1) ? false : true;
            return $resp;
            
        } catch (Exception $ex) {
            throw $ex;
        }
        
    }

    public function toArray($object, $type = 0){
        
        $parameters = array();

        if($object instanceof Movie){

            if($type == 0){
                $parameters[DaoMovies::TABLE_IDMOVIE] = $object->getId();
            }

            $parameters[DaoMovies::TABLE_POPULARITY] = $object->getPopularity();
            $parameters[DaoMovies::TABLE_VIDEO] = $object->getVideo();
            $parameters[DaoMovies::TABLE_POSTERPATH] = $object->getPoster_path();
            $parameters[DaoMovies::TABLE_ORIGINALLANGUAGE] = $object->getOriginal_language();
            $parameters[DaoMovies::TABLE_TITLE] = $object->getTitle();
            $parameters[DaoMovies::TABLE_OVERVIEW] = $object->getOverview();
            $parameters[DaoMovies::TABLE_RELEASEDATA] = $object->getRelease_date();
            $parameters[DaoMovies::TABLE_ENABLED] = $object->getEnabled();
        }

        return $parameters;
    }

    public function mapeo($value)
    {

        $value = is_array($value) ? $value : [];

        $resp = array_map(
            function ($p) {

                $objet =  new Movie(
                    $p[DaoMovies::TABLE_POPULARITY],
                    $p[DaoMovies::TABLE_VIDEO],
                    $p[DaoMovies::TABLE_POSTERPATH],
                    $p[DaoMovies::TABLE_IDMOVIE],
                    $p[DaoMovies::TABLE_ORIGINALLANGUAGE],
                    $p[DaoMovies::TABLE_TITLE],
                    $p[DaoMovies::TABLE_OVERVIEW],
                    $p[DaoMovies::TABLE_RELEASEDATA],
                    $p[DaoMovies::TABLE_ENABLED]
                );

                return $objet;
            },
            $value
        );
        return $resp;
    }


    public function searchIdMovie($title)
    {
        
        $sql= "SELECT idMovie FROM movies  WHERE title=".'"'.$title.'";';

        try
        {
           
            $this->connection=Connection::GetInstance(); 
            
            
            $value= $this->connection->Execute($sql);
            
           
            foreach ($value as $key =>$valueArray)
            {
                $id=$valueArray['idMovie'];
            }

            return $id;

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
            $sql= "INSERT INTO movies (idMovie,title,posterPath,overview,originalLanguage,releaseData,video,popularity,".DaoMovies::TABLE_ENABLED.") 
                               values(:idMovie,:title,:posterPath,:overview,:originalLanguage,:releaseData,:video,:popularity,:".DaoMovies::TABLE_ENABLED.");";
              
                

                $parameters['idMovie']=$valueArray['id'];
                $parameters['title']=$valueArray['title'];
                $parameters['posterPath']=$valueArray['poster_path'];
                $parameters['overview']=$valueArray['overview'];
                $parameters['video']= $valueArray['video'];
                $parameters['originalLanguage']=$valueArray['original_language'];
                $parameters[DaoMovies::TABLE_ENABLED]=true;
                $parameters['releaseData']=$valueArray['release_date'];
                $parameters['popularity']=$valueArray['popularity'];

                

              
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

       
    }

    public function parseToObject($value)
    {
        
            $movie= new Movie($value['popularity'],$value['video'],$value['posterPath'],$value['idMovie'],
                $value['originalLanguage'],$value['title'],$value['overview'],$value['releaseData'],$value['enabled']);
    
        return $movie;


    }


    
}
