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
    private $homeController;


        public function __construct()
        {
            $this->movieDAO=DaoMovies::GetInstance();
            $this->genderDAO =DaoGenres::GetInstance();
            $this->homeController = new HomeController();

        }
   
        //Funcion que actualiza la cartelera de Movies(atributo enabled false para las peliculas que ya no esten) y los generos
        public function updateFromApi(){

            $this->movieDAO->updateFromApi();
            $moviesList = $this->movieDAO->getEnabled();
            $this->genderDAO->updateFromApi();
            $this->homeController->navBar();
            include(ROOT . 'views/list_movies.php');
        }
        
        //Lista las peliculas Actuales
        public function listMovies()
        {
            $moviesList=array();
            $funcionesList=array();
            $moviesList = $this->movieDAO->getAll();


            $daoFunciones= new DaoFunciones();
            $funcionesList= $daoFunciones->GetAll();

            $this->homeController->navBar();
            include(VIEWS_PATH."list_movies.php");
        }

        public function listMovieByGenre($idGenre = 0){

            $genre = $this->genderDAO->getById($idGenre);

            $moviesList = $this->movieDAO->genreMovies($genre);

            $this->homeController->navBar();
            include(ROOT . 'views/list_movies.php');
        }

        public function searchMovie($string){
            $moviesList = $this->movieDAO->searchByName($string);
            $this->homeController->navBar();
            include(ROOT . 'views/list_movies.php');
        }

        public function viewMovie($idMovie){
            
            $movie = $this->movieDAO->getById($idMovie);
            $daoFunciones = new DaoFunciones();
            $funcionesList = $daoFunciones->searchByName($movie->getTitle());
            $this->homeController->navBar();
            include(ROOT . 'views/view-movie.php');
        }
       


        
    }

     

?>