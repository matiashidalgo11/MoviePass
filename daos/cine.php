<?php namespace daos;

    use models\Cine as cine;


    class cines {
       
       private $cines_list = array();
       
        public function __construct()
        {
           
        }

        public function Add($cine)
        {
          //  $this->RetrieveData();
            
            $cine->setId(count($cines_list) + 1);
            array_push($this->cines_list, $cine);

            return $cine->getId();
  
        }

        public function GetById($id){
            $cineResult = new cine();
            foreach($cines_list as $cine){
                if($id==$cine->getId()){
                    $cineResult=$cine;
                }
            }
            return $cineResult;
        }

        public function Update($cineInput){
            foreach($cines_list as $cine){
                if($cineInput->getId()==$cine->getId()){
                    $cine=$cineInput;
                }
            }
        }

        public function Delete($id){
            $arrayCine = array();
            
            foreach($cines_list as $cine){
                if($id!=$cine->getId()){
                    array_push($arrayCine, $cine);
                }
            }

            $this->cines_list=$arrayCine;

        }

        public function GetAll()
        {
           // $this->RetrieveData();
            return $this->cines_list;
        }


     /*   public function Delete(\models\cine $m){
           
            $this->RetrieveData();
            
            //Probar
            if (($clave = array_search($m, $this->cines_list)) != false) {
            
                unset($this->cines_list[$clave]);
                
            }
    
            return $this->SaveData();
        }*/

    /*    public function Read(int $id){
           
            $this->RetrieveData();

            foreach($this->cines_list as $cine){
                if($cine->getId() == $id){
                    return $cine;
                }
            }

            return false;
        }*/

       /* public function UpdateList(){
           
            unset($this->cines_list);

            $this->cines_list = $this->ListFromApi();

            $this->SaveData();

        }*/
       /* private function SaveData()
        {
            $arrayToEncode = array();
            echo 'estoy en save data';
            foreach($this->cines_list as $cine)
            {
                private $id;
        private $nombre_cine;
        private $capacidad_total;
        private $direccion;
        private $valor_entrada;
        private $peliculas = [];
                
                $valuesArray["popularity"] = $cine->getPopularity();
                $valuesArray["vote_count"] = $cine->getVote_count();
                $valuesArray["video"] = $cine->getVideo();
                $valuesArray["poster_path"] = $cine->getPoster_path();
                $valuesArray["id"] = $cine->getId();
                $valuesArray["adult"] = $cine->getAdult();
                $valuesArray["backdrop_path"] = $cine->getBackdrop_path();
                $valuesArray["original_language"] = $cine->getOriginal_language();
                $valuesArray["original_title"] = $cine->getOriginal_title();
                $valuesArray["genre_ids"] = $cine->getGenre_ids();
                $valuesArray["title"] = $cine->getTitle();
                $valuesArray["vote_average"] = $cine->getVote_average();
                $valuesArray["overview"] = $cine->getOverview();
                $valuesArray["release_date"] = $cine->getRelease_date();
                $valuesArray["enabled"] = $cine->getEnabled();
                

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            return file_put_contents($this->file_name, $jsonContent);
        }*/

      /*  private function RetrieveData()
        {
            $this->cines_list = array();

            if(file_exists($this->file_name))
            {
                $jsonContent = file_get_contents($this->file_name);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cine = new \models\cine();
                    $cine->setPopularity($valuesArray["popularity"]);
                    $cine->setVote_count($valuesArray["vote_count"]);
                    $cine->setVideo($valuesArray["video"]);
                    $cine->setPoster_path($valuesArray["poster_path"]);
                    $cine->setId($valuesArray["id"]);
                    $cine->setAdult($valuesArray["adult"]);
                    $cine->setBackdrop_path($valuesArray["backdrop_path"]);
                    $cine->setOriginal_language($valuesArray["original_language"]);
                    $cine->setOriginal_title($valuesArray["original_title"]);
                    $cine->setGenre_ids($valuesArray["genre_ids"]);
                    $cine->setTitle($valuesArray["title"]);
                    $cine->setVote_average($valuesArray["vote_average"]);
                    $cine->setOverview($valuesArray["overview"]);
                    $cine->setRelease_date($valuesArray["release_date"]);
                    $cine->setEnabled($valuesArray["enabled"]);
                    

                    array_push($this->cines_list, $cine);
                }
            }
        }*/

        
     /*   private function ListFromApi(){

            $api_url = "https://api.thecinedb.org/3/cine/now_playing?page=1&language=en-US&api_key=" . KEY_TMDB;
            $api_json = file_get_contents($api_url);
            $api_array = ($api_json) ? json_decode($api_json, true) : array();

            
            $new_cine_list = array();

            foreach($api_array['results'] as $valuesArray)
                {
                    $cine = new \models\cine();

                    $cine->setPopularity($valuesArray["popularity"]);
                    $cine->setVote_count($valuesArray["vote_count"]);
                    $cine->setVideo($valuesArray["video"]);
                    $cine->setPoster_path($valuesArray["poster_path"]);
                    $cine->setId($valuesArray["id"]);
                    $cine->setAdult($valuesArray["adult"]);
                    $cine->setBackdrop_path($valuesArray["backdrop_path"]);
                    $cine->setOriginal_language($valuesArray["original_language"]);
                    $cine->setOriginal_title($valuesArray["original_title"]);
                 
                    $cine->setTitle($valuesArray["title"]);
                    $cine->setVote_average($valuesArray["vote_average"]);
                    $cine->setOverview($valuesArray["overview"]);
                    $cine->setRelease_date($valuesArray["release_date"]);
                    $cine->setEnabled(true);
                    
                    $cine->setGenre_ids($this->genreConverter($valuesArray["genre_ids"]));
                    
                    array_push($new_cine_list, $cine);
                }


            return $new_cine_list;
        }*/

      /*  private function genreConverter($array_genre_ids){
            
            $genre_list = $this->GenreFromApi();
            $generos = array();

            foreach($array_genre_ids as $id){

                if(array_key_exists($id,$genre_list)){

                    array_push($generos,$genre_list[$id]->getName());
                }
            }
        
            return $generos;
        }*/

      /*  private function GenreFromApi(){
            $api_url = "https://api.thecinedb.org/3/genre/cine/list?api_key=" . KEY_TMDB . "&language=en-US" ;
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
        }*/

    }


?>