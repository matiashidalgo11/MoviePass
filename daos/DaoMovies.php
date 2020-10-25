<?php namespace daos;

    use \Exception as Exception;
    use daos\Connection as Connection;
    use daos\DaoGenre as DaoGenre;
    use models\Movie as Movie;
    use models\Genre as Genre;
    use PDO;

class DaoMovies {
       
       private $connection;
       private $tableName = "movies"; 

       
       //variables con los nombres de los atributos de las tablas
       private $popularityDB = "popularity";
       private $videoDB = "video";
       private $posterPathDB = "posterPath";
       private $idMovieDB = "idMovie";
       private $originalLanguageDB = "originalLanguage";
       private $titleDB = "title";
       private $overviewDB = "overview";
       private $releaseDataDB = "releaseData";
       private $enabledDB = "enabled";



       public function getAll(){
        try {
            $query = "SELECT * FROM " . $this->tableName . " ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);


            if(!empty($array)){
               
                foreach($array as $movie){
                    $movie->setGenre_ids($this->genresToIdMovie($movie->getId()));
                }     
            }

            return $array;

        } catch (Exception $ex) {
            throw $ex;
        }
       }

       public function getById(int $id){
       
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE " . $this->idMovieDB . " = " . "'" . $id . "'" . " ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);

            $object = !empty($array) ? $array[0] : [];

            if(!empty($object) && $object instanceof Movie){

                    $object->setGenre_ids($this->genresToIdMovie($object->getId()));   
            }

            return $object;

        } catch (Exception $ex) {
            throw $ex;
        }
       }

       public function Add(Movie $movie)
       {
           try {
               $query = "INSERT INTO " . $this->tableName . "( " . $this->idMovieDB . " , " . $this->popularityDB . " , " . $this->videoDB . " , " . $this->posterPathDB . " , "  . $this->originalLanguageDB . " , " . $this->titleDB . " , " . $this->overviewDB . " , " . $this->releaseDataDB . " , " . $this->enabledDB . " ) " .
                " VALUES ( ".":". $this->idMovieDB . " , " .":". $this->popularityDB . " , " .":". $this->videoDB . " , " .":". $this->posterPathDB . " , " .":". $this->originalLanguageDB . " , " .":". $this->titleDB . " , " .":". $this->overviewDB . " , " .":". $this->releaseDataDB . " , " .":". $this->enabledDB . " ) ; ";
               
                $parameters[$this->idMovieDB] = $movie->getId();
                $parameters[$this->popularityDB] = $movie->getPopularity();
                $parameters[$this->videoDB] = $movie->getVideo();
                $parameters[$this->posterPathDB] = $movie->getPoster_path();
                $parameters[$this->originalLanguageDB] = $movie->getOriginal_language();
                $parameters[$this->titleDB] = $movie->getTitle();
                $parameters[$this->overviewDB] = $movie->getOverview();
                $parameters[$this->releaseDataDB] = $movie->getRelease_date();
                $parameters[$this->enabledDB] = $movie->getEnabled();
                
   
               $this->connection = Connection::GetInstance();
   
               $this->connection->ExecuteNonQuery($query, $parameters);

               $this->addGenreMovie($movie->getGenre_ids() , $movie->getId());


           } catch (Exception $ex) {
               throw $ex;
           }
       }

       private function addGenreMovie(array $genres, $idMovie){

           try{

            $query = "INSERT INTO" . " moviesxgeneros " . "( idMovie , idGenero ) " . "VALUE" . " ( :idMovie , :idGenero ) ;";

            $parameters[$this->idMovieDB] = $idMovie;

            $this->connection = Connection::GetInstance();

            
            foreach($genres as $genre){

                if($genre instanceof Genre){
                    
                    $parameters['idGenero'] = $genre->getId();

                    $this->connection->ExecuteNonQuery($query, $parameters);
                }
                
            }

           }catch(Exception $ex){
               throw $ex;
           }

       }

       public function genresToIdMovie(int $idMovie){
        
            $query = " SELECT g.idGenero , g.nombre
            FROM moviesxgeneros AS x 
            INNER JOIN generos  AS g ON x.idGenero = g.idGenero
            WHERE x.idMovie = " . $idMovie ." ;";

            $parameters['idMovie'] = $idMovie;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $genreList = DaoGenre::mapeo($resultSet);

            $genreList = !empty($genreList) ? $genreList : [];

            return $genreList;    

       }


        
        public function ListFromApi(){

            $api_url = "https://api.themoviedb.org/3/movie/now_playing?page=1&language=en-US&api_key=" . KEY_TMDB;
            $api_json = file_get_contents($api_url);
            $api_array = ($api_json) ? json_decode($api_json, true) : array();

            
            $new_movie_list = array();

            foreach($api_array['results'] as $valuesArray)
                {
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

                    $GenreDao = DaoGenre::GetInstance();

                    $genreList = $GenreDao->arrayToGenre($valuesArray["genre_ids"]);

                    $movie->setGenre_ids($genreList);
                    

                    
                    array_push($new_movie_list, $movie);
                }


            return $new_movie_list;
        }

      

        private function mapeo($value){

            $value = is_array($value) ? $value : [];
    
            $resp = array_map(
                function($p){

                    $objet =  new Movie(
                    $p[$this->popularityDB],
                    $p[$this->videoDB],
                    $p[$this->posterPathDB],
                    $p[$this->idMovieDB],
                    $p[$this->originalLanguageDB],
                    $p[$this->titleDB],
                    $p[$this->overviewDB],
                    $p[$this->releaseDataDB],
                    $p[$this->enabledDB] );

                   return $objet;}
                , $value);
    
    
            return $resp;
    
        }

    }
?>