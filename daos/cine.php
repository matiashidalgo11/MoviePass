<?php namespace daos;

    use models\Cine as cine;


    class cines {
       
       private $cines_list = array();
       
        public function __construct()
        {
           $this->RetrieveData();
        }

        public function Add($cine)
        {
            array_push($this->cines_list, $cine);
            $this->SaveData();
  
        }

        public function GetById($id){
            foreach($cines_list as $cine){
                if($id==$cine->getId()){
                    return $cine;
                }
            }
            return null;
        }

        public function modify($cine){
            foreach($this->cine as $i => $c){
                if($c->getId()== $cine->getId()){
                    $this->cines_list[$i] = $cine;
                    $this->SaveData();
                    return true;
                }
            }
            return false;
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
            
            foreach($this->cines_list as $i => $cine){
                if($id==$cine->getId()){
                    unset($this->cine[$i]);
                    $this->SaveData();
                    return true;
                }
            }
            return false;
        }

        public function GetAll()
        {
            return $this->cines_list;
        }
        
       private function SaveData()
        {
            $arrayToEncode = array();
            foreach($this->cines_list as $cine)
            {
                $valuesArray['id'] = $cine->getId();
                $valuesArray['nombre_cine'] = $cine->getNombre_Cine();
                $valuesArray['capacidad_total'] = $cine->getCapacidad_Total();
                $valuesArray['direccion'] = $cine->getDireccion();
                $valuesArray['valor_entrada'] = $cine->getValor_Entrada();
                
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents(self::FILE_NAME, $jsonContent);
        }

        private function RetrieveData()
        {

            if(file_exists($this->file_name))
            {
                $jsonContent = file_get_contents(self::FILE_NAME);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cine->setId($valuesArray["id"]);
                    $cine->setNombre_Cine($valuesArray['nombre_cine']);
                    $cine->setCapacidad_Total($valuesArray['capacidad_total']);
                    $cine->setDireccion($valuesArray['direccion']);
                    $cine->setValor_Entrada($valuesArray['valor_entrada']);
                    
                    array_push($this->cines_list, $cine);
                }
            }
        }

        
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