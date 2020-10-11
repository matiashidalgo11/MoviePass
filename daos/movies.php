<?php namespace daos;


    class Movies {
       
       private $movies_list = array();
       private $file_name; 
       
        public function __construct()
        {
            $this->file_name = dirname(__DIR__)."/data/movies.json";
        }

        public function Add(\models\Movie $movie)
        {
            $this->RetrieveData();
            
            array_push($this->movies_list, $movie);
            
            return $this->SaveData();
  
        }

        public function UpdateList(){
           
            unset($this->movies_list);

            $this->movies_list = $this->ListFromApi();

            $this->SaveData();

        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->movies_list;
        }

        private function SaveData()
        {
            $arrayToEncode = array();
            echo 'estoy en save data';
            foreach($this->movies_list as $movie)
            {
                
                $valuesArray["popularity"] = $movie->getPopularity();
                $valuesArray["vote_count"] = $movie->getVote_count();
                $valuesArray["video"] = $movie->getVideo();
                $valuesArray["poster_path"] = $movie->getPoster_path();
                $valuesArray["id"] = $movie->getId();
                $valuesArray["adult"] = $movie->getAdult();
                $valuesArray["backdrop_path"] = $movie->getBackdrop_path();
                $valuesArray["original_language"] = $movie->getOriginal_language();
                $valuesArray["original_title"] = $movie->getOriginal_title();
                $valuesArray["genre_ids"] = $movie->getGenre_ids();
                $valuesArray["title"] = $movie->getTitle();
                $valuesArray["vote_average"] = $movie->getVote_average();
                $valuesArray["overview"] = $movie->getOverview();
                $valuesArray["release_date"] = $movie->getRelease_date();
                $valuesArray["enabled"] = $movie->getEnabled();
                

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            return file_put_contents($this->file_name, $jsonContent);
        }

        private function RetrieveData()
        {
            $this->movies_list = array();

            if(file_exists($this->file_name))
            {
                $jsonContent = file_get_contents($this->file_name);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $movie = new \models\Movie();
                    $movie->setPopularity($valuesArray["popularity"]);
                    $movie->setVote_count($valuesArray["vote_count"]);
                    $movie->setVideo($valuesArray["video"]);
                    $movie->setPoster_path($valuesArray["poster_path"]);
                    $movie->setId($valuesArray["id"]);
                    $movie->setAdult($valuesArray["adult"]);
                    $movie->setBackdrop_path($valuesArray["backdrop_path"]);
                    $movie->setOriginal_language($valuesArray["original_language"]);
                    $movie->setOriginal_title($valuesArray["original_title"]);
                    $movie->setGenre_ids($valuesArray["genre_ids"]);
                    $movie->setTitle($valuesArray["title"]);
                    $movie->setVote_average($valuesArray["vote_average"]);
                    $movie->setOverview($valuesArray["overview"]);
                    $movie->setRelease_date($valuesArray["release_date"]);
                    $movie->setEnabled($valuesArray["enabled"]);
                    

                    array_push($this->movies_list, $movie);
                }
            }
        }

        
        private function ListFromApi(){

            $api_url = "https://api.themoviedb.org/3/movie/now_playing?page=1&language=en-US&api_key=" . KEY_TMDB;
            $api_json = file_get_contents($api_url);
            $api_array = ($api_json) ? json_decode($api_json, true) : array();

            
            $new_movie_list = array();

            foreach($api_array['results'] as $valuesArray)
                {
                    $movie = new \models\Movie();

                    $movie->setPopularity($valuesArray["popularity"]);
                    $movie->setVote_count($valuesArray["vote_count"]);
                    $movie->setVideo($valuesArray["video"]);
                    $movie->setPoster_path($valuesArray["poster_path"]);
                    $movie->setId($valuesArray["id"]);
                    $movie->setAdult($valuesArray["adult"]);
                    $movie->setBackdrop_path($valuesArray["backdrop_path"]);
                    $movie->setOriginal_language($valuesArray["original_language"]);
                    $movie->setOriginal_title($valuesArray["original_title"]);
                 
                    $movie->setTitle($valuesArray["title"]);
                    $movie->setVote_average($valuesArray["vote_average"]);
                    $movie->setOverview($valuesArray["overview"]);
                    $movie->setRelease_date($valuesArray["release_date"]);
                    $movie->setEnabled(true);
                    
                    $movie->setGenre_ids($this->genreConverter($valuesArray["genre_ids"]));
                    
                    array_push($new_movie_list, $movie);
                }


            return $new_movie_list;
        }

        private function genreConverter($array_genre_ids){
            
            $genre_list = $this->GenreFromApi();
            $generos = array();

            foreach($array_genre_ids as $id){

                if(array_key_exists($id,$genre_list)){

                    array_push($generos,$genre_list[$id]->getName());
                }
            }
        
            return $generos;
        }

        private function GenreFromApi(){
            $api_url = "https://api.themoviedb.org/3/genre/movie/list?api_key=" . KEY_TMDB . "&language=en-US" ;
            $api_json = file_get_contents($api_url);
            $api_array = ($api_json) ? json_decode($api_json, true) : array();

            $genre_list = array();

            foreach($api_array["genres"] as $valuesArray)
                {
                    $genre = new \models\Genre();
                    
                    $genre->setId($valuesArray["id"]);
                    $genre->setName($valuesArray["name"]);
                    
                    $genre_list[$genre->getId()] = $genre; 
                }


            return $genre_list;
        }

    }


?>