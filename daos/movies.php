<?php namespace daos;


    class Movies {
       
       private $movies_list = array();
       private $file_name; 
       
        public function __construct()
        {
            $this->file_name = dirname(__DIR__)."/data/movies.json";
        }

        //No sabria si el filtro de que si existe va en el daos o en el controllers
        public function Add(\models\Movie $movie)
        {
            $this->RetrieveData();
            
            if(!$this->exist($movie)){
               
                array_push($this->movies_list, $movie);
                return $this->SaveData();
            }
            
            return false;

            
        }

        //Guardar las peliculas en el arreglo por el id ?)
        public function AddArray($movieArray){
           
            $this->RetrieveData();

            foreach($movieArray as $movie){

                if(!$this->exist($movie)){
                    array_push($this->movies_list, $movie);
                }
                
            }

            return $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->movies_list;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

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
                    

                    array_push($this->movies_list, $movie);
                }
            }
        }

        //Esta la funcion in_array tambien.
        private function exist(\models\Movie $movie){
            
            foreach($this->movies_list as $aux){
               
                if($aux->getId() == $movie->getId() && $aux->getTitle() == $movie->getTitle()){
                   
                    return true;
                }
            }

            return false;
        }


    }


?>