<?php namespace controllers;


    class Movies {

        private $movies_dao;
        
        function __construct()
        {
            $this->movies_dao = new \daos\Movies();
        }

        public function updateList(){

            //Se instancia el dao de tmdb y luego se actualizan las peliculas del archivo tmdb.json
            $tmdb_dao = new \daos\Tmdb();
            $tmdb_dao->UpdateData();

            //Se crea un lista de peliculas que provienen de tmdb y luego se los agrega al archivo movies.json
            $new_list_movie = $tmdb_dao->GetAll();
            
            

            


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