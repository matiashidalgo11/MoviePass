<?php namespace daos;

    class Tmdb {

       private $movies_list = array();
       private $file_name; 
       
        public function __construct()
        {
            $this->file_name = dirname(__DIR__)."/data/tmdb.json";
        }

    

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->movies_list;
        }

        public function UpdateData(){
            
            $this->SaveDataFromApi();
        }

       
        private function RetrieveData()
        {
            $this->movies_list = array();

            if(file_exists($this->file_name))
            {
                $jsonContent = file_get_contents($this->file_name);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode['results'] as $valuesArray)
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
                    

                    array_push($this->movies_list, $movie);
                }
               
            } 
        }

        private function SaveDataFromApi(){

            $api_url = "https://api.themoviedb.org/3/movie/now_playing?page=1&language=en-US&api_key=" . KEY_TMDB;
            $api_json = file_get_contents($api_url);
            //$api_array = json_decode($api_json);

            return file_put_contents($this->file_name, $api_json);


        }

    }
?>