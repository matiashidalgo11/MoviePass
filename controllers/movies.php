<?php namespace controllers;

    use daos\Movies as moviesDao;

    class Movies {

        private $movies_dao;
        private $list_movies;

        
        function __construct()
        {
            $this->movies_dao = new MoviesDao();
            $this->list_movies = array();
        }

        public function updateList(){

            $this->movies_dao->UpdateList();

            include(ROOT . '/views/list_movies.php');


        }

        public function listMovies(){
            
            $this->list_movies = $this->movies_dao->GetAll();
            
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