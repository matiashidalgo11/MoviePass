<?php namespace controllers;

use daos\DaoGenre;
use daos\DaoMovies as daoMovies;
use models\Genre as Genre;
use models\Movie as Movie;

class MoviesController {

        private $movies_dao;
        private $list_movies;

        
        function __construct()
        {
            $this->movies_dao = new DaoMovies();
            $this->list_movies = array();
        }

        /* public function updateList(){

            $this->movies_dao->UpdateList();

            include(ROOT . '/views/list_movies.php');


        } */

   /*      public function listMovies(){
    
            $this->list_movies = $this->movies_dao->GetAll();
            
            include(ROOT . '/views/list_movies.php');
        }
 */
        public function addMovie(){
            //$movie = new Movie(175.275,false,"\/k68nPLbIST6NP96JmTxmZijEvCA.jpg",577922,false,"en",array(28,878,53),"Tenet","Armed with only one word - Tenet - and fighting for the survival of the entire world, the Protagonist journeys through a twilight world of international espionage on a mission that will unfold in something beyond real time.","2020-08-22",true);
           
            /* $DaoMovies = new DaoMovies();
            $movies = $DaoMovies->ListFromApi();

            foreach($movies as $movie){
                $DaoMovies->Add($movie);
            } */



            
        }

        /* "genre_ids": [
            "Action",
            "Science Fiction",
            "Thriller"
        ], */
        //Falta tratar excepciones cuando se quieren insertar repetidos
        public function testGenre(){

            $daoGenre = new DaoGenre();

            
            var_dump($daoGenre->getById(228));
        }

        public function generosDeMovie(){
            
            $DaoMovies = new DaoMovies();
            $DaoMovies->genresToIdMovie(337401);
        }

        public function getMovie(){

            $DaoMovies = new DaoMovies();
            var_dump($DaoMovies->getById(337401));

        }

        public function getAll(){
            $DaoMovies = new DaoMovies();
            var_dump($DaoMovies->getAll());
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