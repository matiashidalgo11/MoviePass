<?php namespace daos;

    use models\Cuenta as Cuenta;

    class Cuentas {
       
       private $cuentas_list = array();
       private $file_name; 
       
        public function __construct()
        {
            $this->file_name = dirname(__DIR__)."/data/cuentas.json";
        }

        //No sabria si el filtro de que si existe va en el daos o en el controllers
        public function Add(Cuenta $cuenta)
        {
            $this->RetrieveData();
            
            if(!$this->exist($cuenta)){
               
                array_push($this->cuentas_list, $cuenta);
                return $this->SaveData();
            }
            
            return false;

            
        }

        //Guardar las peliculas en el arreglo por el id ?)
        public function AddArray($cuentaArray){
           
            $this->RetrieveData();

            foreach($cuentaArray as $cuenta){

                if(!$this->exist($cuenta)){
                    array_push($this->cuentas_list, $cuenta);
                }
                
            }

            return $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->cuentas_list;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cuentas_list as $cuenta)
            {
                $valuesArray["id"] = $cuenta->getId();
                $valuesArray["email"] = $cuenta->getEmail();
                $valuesArray["password"] = $cuenta->getPassword();
                $valuesArray["privilegios"] = $cuenta->getPrivilegios();                

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            return file_put_contents($this->file_name, $jsonContent);
        }

        private function RetrieveData()
        {
            $this->cuentas_list = array();

            if(file_exists($this->file_name))
            {
                $jsonContent = file_get_contents($this->file_name);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cuenta = new Cuenta();
                    $cuenta->setPopularity($valuesArray["popularity"]);
                    $cuenta->setVote_count($valuesArray["vote_count"]);
                    $cuenta->setVideo($valuesArray["video"]);
                    $cuenta->setPoster_path($valuesArray["poster_path"]);
                    $cuenta->setId($valuesArray["id"]);
                    $cuenta->setAdult($valuesArray["adult"]);
                    $cuenta->setBackdrop_path($valuesArray["backdrop_path"]);
                    $cuenta->setOriginal_language($valuesArray["original_language"]);
                    $cuenta->setOriginal_title($valuesArray["original_title"]);
                    $cuenta->setGenre_ids($valuesArray["genre_ids"]);
                    $cuenta->setTitle($valuesArray["title"]);
                    $cuenta->setVote_average($valuesArray["vote_average"]);
                    $cuenta->setOverview($valuesArray["overview"]);
                    $cuenta->setRelease_date($valuesArray["release_date"]);
                    

                    array_push($this->cuentas_list, $cuenta);
                }
            }
        }

        //Esta la funcion in_array tambien.
        private function exist(\models\cuenta $cuenta){
            
            foreach($this->cuentas_list as $aux){
               
                if($aux->getId() == $cuenta->getId() && $aux->getTitle() == $cuenta->getTitle()){
                   
                    return true;
                }
            }

            return false;
        }


    }


?>