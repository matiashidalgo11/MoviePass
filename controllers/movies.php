<?php namespace controllers;


    class Movies {

        private $movies_dao;
        
        function __construct()
        {
            $this->movies_dao = new \daos\Movies();
        }

        public function updateList(){

            $this->movies_dao->UpdateList();

            include(ROOT . '/views/list_movies.php');


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