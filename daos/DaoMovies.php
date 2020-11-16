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
    private static $instance = null;

    //Info db
    const TABLE_NAME = "movies";
    const COLUMN_POPULARITY = "popularity";
    const COLUMN_VIDEO = "video";
    const COLUMN_POSTERPATH = "posterPath";
    const COLUMN_IDMOVIE = "idMovie";
    const COLUMN_ORIGINALLANGUAGE = "originalLanguage";
    const COLUMN_TITLE = "title";
    const COLUMN_OVERVIEW = "overview";
    const COLUMN_RELEASEDATA = "releaseData";
    const COLUMN_ENABLED = "enabled";

    private function __construct(){
        
    }

    public static function GetInstance()
    {
        if (self::$instance == null)
            self::$instance = new DaoMovies();

        return self::$instance;
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

            $movie = $this->getById($dato[DaoMovies::COLUMN_IDMOVIE]);
            array_push($movies, $movie);

        }
       
        return $movies;
    }

    public function searchByName($nameMovie)
    {
        $funcionesList=array();
        $sql="SELECT * FROM movies as m WHERE m.title LIKE '%". $nameMovie . "%';";
        echo $sql;
        try
        {
             $this->connection=Connection::GetInstance();
             $resultSet=$this->connection->Execute($sql);
             $movieList = $this->mapeo($resultSet);
             return $movieList;
 
        }catch(PDOException $e)
        {
            throw $e;
        }
    }

    public function update($movie){
       
        if($movie instanceof Movie){
            
            if($this->exist($movie)){

                try{

                $query = "UPDATE " . DaoMovies::TABLE_NAME .
                " SET " . DaoMovies::COLUMN_POPULARITY . " = :" . DaoMovies::COLUMN_POPULARITY . " , ".
                DaoMovies::COLUMN_VIDEO . " = :" . DaoMovies::COLUMN_VIDEO . " , ".
                DaoMovies::COLUMN_POSTERPATH . " = :". DaoMovies::COLUMN_POSTERPATH . " , ".
                DaoMovies::COLUMN_ORIGINALLANGUAGE . " = :" . DaoMovies::COLUMN_ORIGINALLANGUAGE . " , ".
                DaoMovies::COLUMN_TITLE . " = :" . DaoMovies::COLUMN_TITLE . " , ".
                DaoMovies::COLUMN_OVERVIEW . " = :" . DaoMovies::COLUMN_OVERVIEW . " , ".
                DaoMovies::COLUMN_RELEASEDATA . " = :" . DaoMovies::COLUMN_RELEASEDATA . " , ".
                DaoMovies::COLUMN_ENABLED . " = :" . DaoMovies::COLUMN_ENABLED.
                " WHERE " . DaoMovies::COLUMN_IDMOVIE . " = " . $movie->getId() . " ;";

                $parameters = $this->toArray($movie,1);

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                $this->deleteGenresMovie($movie->getId());

                $this->addGenreMovie($movie->getGenres(), $movie->getId());

                }
                catch (Exception $ex) {
                    throw $ex;
                }

            }
        }
    }

    //Elimina de la base de datos los generos asociados al id de la movie
    private function deleteGenresMovie($idMovie){
       
        try{
        $query = "DELETE FROM moviesxgeneros 
        WHERE " . DaoMovies::COLUMN_IDMOVIE ." = " . $idMovie ." ; ";

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query);
        }

        catch (Exception $ex) {
            throw $ex;
        }

    }


    public function getAll()
    {
        try {
            $query = "SELECT * FROM " . DaoMovies::TABLE_NAME . " ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);

            return $array;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getEnabled()
    {
        try {
            $query = "SELECT * FROM " . DaoMovies::TABLE_NAME .  " WHERE " . DaoMovies::COLUMN_ENABLED . " = " . "'" . true . "'" ." ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);

            return $array;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getById($id)
    {

        try {
            $query = "SELECT * FROM " . DaoMovies::TABLE_NAME . " WHERE " . DaoMovies::COLUMN_IDMOVIE . " = " . "'" . $id . "'" . " ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);

            $object = !empty($array) ? $array[0] : [];

            return $object;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function add($movie)
    {
        if ($movie instanceof Movie) {


            try {
                $query = "INSERT INTO " . DaoMovies::TABLE_NAME . "( " . DaoMovies::COLUMN_IDMOVIE . " , " . DaoMovies::COLUMN_POPULARITY . " , " . DaoMovies::COLUMN_VIDEO . " , " . DaoMovies::COLUMN_POSTERPATH . " , "  . DaoMovies::COLUMN_ORIGINALLANGUAGE . " , " . DaoMovies::COLUMN_TITLE . " , " . DaoMovies::COLUMN_OVERVIEW . " , " . DaoMovies::COLUMN_RELEASEDATA . " , " . DaoMovies::COLUMN_ENABLED . " ) " .
                    " VALUES ( " . ":" . DaoMovies::COLUMN_IDMOVIE . " , " . ":" . DaoMovies::COLUMN_POPULARITY . " , " . ":" . DaoMovies::COLUMN_VIDEO . " , " . ":" . DaoMovies::COLUMN_POSTERPATH . " , " . ":" . DaoMovies::COLUMN_ORIGINALLANGUAGE . " , " . ":" . DaoMovies::COLUMN_TITLE . " , " . ":" . DaoMovies::COLUMN_OVERVIEW . " , " . ":" . DaoMovies::COLUMN_RELEASEDATA . " , " . ":" . DaoMovies::COLUMN_ENABLED . " ) ; ";

                $parameters = $this->toArray($movie);

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                $this->addGenreMovie($movie->getGenres(), $movie->getId());

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

            $parameters[DaoMovies::COLUMN_IDMOVIE] = $idMovie;

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

            /*
            *   La api trae por cada movie un arreglo con los id de generos que le pertenecen, 
            *   el arreglo de ids se lleva a la api para convertise en un arreglo de objetos generos 
            *   y luego setearlo al objeto movie
            */
            $genreList = $GenreDao->arrayToGenre($valuesArray["genre_ids"]);

            $movie->setGenres($genreList);

            array_push($new_movie_list, $movie);
        }


        return $new_movie_list;
    }

    //Trae un arreglo de movies desde la api y los agrega a la base de datos, corroborando si se encontraban o no
    public function updateFromApi(){

        $newMovies = $this->moviesFromApi();
        $this->disableMovies();

        foreach($newMovies as $nMovie){

            if($this->exist($nMovie) && !($this->isEnabled($nMovie->getId())) ){
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

    public function exist($movie)
    {   
        if($movie instanceof Movie){
        try {

            $query = "SELECT EXISTS ( SELECT * FROM " . DaoMovies::TABLE_NAME . " WHERE " . DaoMovies::COLUMN_IDMOVIE . " = " . "'" . $movie->getId() . "'" . ");";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            if ($result[0][0] != 1) return false;
            else return true;
            
        } catch (Exception $ex) {
            throw $ex;
        }
        }else return false;
    }

    //Verifica si el idMovie tiene una pelicula habilitada
    private function isEnabled($idMovie)
    {   
        
        try {

            $query = "SELECT EXISTS ( SELECT * FROM " . DaoMovies::TABLE_NAME . " WHERE " . DaoMovies::COLUMN_IDMOVIE . " = " . "'" . $idMovie . "'" . " AND " . DaoMovies::COLUMN_ENABLED . " = true" .");";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            $resp = ($result[0][0] != 1) ? false : true;
            return $resp;
            
        } catch (Exception $ex) {
            throw $ex;
        }
        
    }

    //Convierte un objeto movie a un array
    public function toArray($object, $type = 0){
        
        $parameters = array();

        if($object instanceof Movie){

            if($type == 0){
                $parameters[DaoMovies::COLUMN_IDMOVIE] = $object->getId();
            }

            $parameters[DaoMovies::COLUMN_POPULARITY] = $object->getPopularity();
            $parameters[DaoMovies::COLUMN_VIDEO] = $object->getVideo();
            $parameters[DaoMovies::COLUMN_POSTERPATH] = $object->getPoster_path();
            $parameters[DaoMovies::COLUMN_ORIGINALLANGUAGE] = $object->getOriginal_language();
            $parameters[DaoMovies::COLUMN_TITLE] = $object->getTitle();
            $parameters[DaoMovies::COLUMN_OVERVIEW] = $object->getOverview();
            $parameters[DaoMovies::COLUMN_RELEASEDATA] = $object->getRelease_date();
            $parameters[DaoMovies::COLUMN_ENABLED] = $object->getEnabled();
        }

        return $parameters;
    }

    public function mapeo($value)
    {

        $value = is_array($value) ? $value : [];

        $resp = array_map(
            function ($p) {

                $object =  new Movie(
                    $p[DaoMovies::COLUMN_POPULARITY],
                    $p[DaoMovies::COLUMN_VIDEO],
                    $p[DaoMovies::COLUMN_POSTERPATH],
                    $p[DaoMovies::COLUMN_IDMOVIE],
                    $p[DaoMovies::COLUMN_ORIGINALLANGUAGE],
                    $p[DaoMovies::COLUMN_TITLE],
                    $p[DaoMovies::COLUMN_OVERVIEW],
                    $p[DaoMovies::COLUMN_RELEASEDATA],
                    $p[DaoMovies::COLUMN_ENABLED]
                );

                //Completa el objeto movie con los generos
                $genreDao = DaoGenres::GetInstance();

                $object->setGenres($genreDao->movieGenres($object->getId()));

                return $object;
            },
            $value
        );
        return $resp;
    }

    public function consultTotalPerMovie()
    {
        $sql="SELECT f.idMovie, SUM(p.total) as recaudacion FROM funciones as f INNER JOIN compras as c ON f.idFuncion=c.idFuncion INNER JOIN pagos as p ON p.idCompra=c.idCompra
         GROUP BY f.idMovie";

         try
         {
            $this->connection=Connection::GetInstance();
            $resultSet=$this->connection->Execute($sql);
            $parameters=array();
            foreach($resultSet as $value)
            {
                $valueArray['movie']=$this->getById($value['idMovie']);
                $valueArray['recaudacion']=$value['recaudacion'];
                array_push($parameter,$valueArray);
            }
            return $parameters;
         }catch(PDOException $e)
         {
             throw $e;
         }
    }
}
