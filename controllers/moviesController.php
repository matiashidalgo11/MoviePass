<?php namespace controllers;


use daos\DaoGenres as DaoGenres;
use daos\DaoMovies as DaoMovies;
use daos\DaoGenderMovies as DaogenderMovie;
use models\Genre as Genre;
use models\Movie as Movie;

use daos\DaoFunciones as DaoFunciones;

class MoviesController {

    private $movieDAO;
    private $genderDAO;


        public function __construct()
        {
            $this->movieDAO=DaoMovies::GetInstance();
            $this->genderDAO =DaoGenres::GetInstance();

        }
   
        //Funcion que actualiza la cartelera de Movies(atributo enabled false para las peliculas que ya no esten) y los generos
        public function updateFromApi(){
            
            $this->movieDAO->updateFromApi();
            $moviesList = $this->movieDAO->getEnabled();

            
            $this->genderDAO->updateFromApi();
            $listGenres = $this->genderDAO->getAll();

            include(ROOT . VIEWS_PATH . "nav-bar.php");
            include(ROOT . 'views/list_movies.php');
        }
        
        //Lista las peliculas Actuales
        public function listMovies()
        {
            $moviesList=array();
            $funcionesList=array();
            $moviesList = $this->movieDAO->getAll();

           
            $daoGenres = DaoGenres::GetInstance(); 
            $listGenres = $daoGenres->getAll(); 

            $daoFunciones= new DaoFunciones();
            $funcionesList= $daoFunciones->GetAll();

    


            include(VIEWS_PATH . "nav-bar.php");
            include(VIEWS_PATH."list_movies.php");
        }

        public function listMovieByGenre($idGenre = 0){

            
            $genre = $this->genderDAO->getById($idGenre);
            $listGenres = $this->genderDAO->getAll();

            
            $moviesList = $this->movieDAO->genreMovies($genre); 
            
            include(ROOT . VIEWS_PATH . "nav-bar.php");
            include(ROOT . 'views/list_movies.php');
        }

        public function viewMovie($idMovie){
            
           

            $movie = $this->movieDAO->getById($idMovie);

            include(VIEWS_PATH . "nav-bar.php");
            include(ROOT . 'views/view-movie.php');
        }

        


        
    }

     

?>