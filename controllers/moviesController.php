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
    private $genderMovieDAO;

        public function __construct()
        {
            $this->movieDAO=new DaoMovies();
            $this->genderDAO = new DaoGenres();
            $this->genderMovieDAO= new DaogenderMovie();

        }
   
        //Funcion que actualiza la cartelera de Movies(atributo enabled false para las peliculas que ya no esten) y los generos
        public function updateFromApi(){
            
            $this->daoMovies->updateFromApi();
            $moviesList = $this->daoMovies->getEnabled();

            
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

           

           /* $daoGenres = DaoGenres::GetInstance();
            $listGenres = $daoGenres->getAll();*/

            $daoFunciones= new DaoFunciones();
            $funcionesList= $daoFunciones->GetAll();

    


            include(VIEWS_PATH . "nav-bar.php");
            include(VIEWS_PATH."list_movies.php");
        }

        public function listMovieByGenre($idGenre = 0){

            
            $genre = $this->genderDAO->getById($idGenre);
            $listGenres = $this->genderDAO->getAll();

            
            $moviesList = $this->daoMovies->genreMovies($genre);
            
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