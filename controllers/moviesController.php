<?php namespace controllers;

use daos\DaoGenre;
use daos\DaoGenres;
use daos\DaoMovies as DaoMovies;
use models\Genre as Genre;
use models\Movie as Movie;

class MoviesController {
   
        //Funcion que actualiza la cartelera de Movies(atributo enabled false para las peliculas que ya no esten) y los generos
        public function updateList(){
            //Desarrollar
        }
        
        //Lista las peliculas Actuales
        public function listMovies(){
    
            $daoMovies = DaoMovies::GetInstance();
            $moviesList = $daoMovies->getAll();
            
            include(ROOT . '/views/list_movies.php');
        }

        public function addMovie(){
            //$movie = new Movie(175.275,false,"\/k68nPLbIST6NP96JmTxmZijEvCA.jpg",577922,false,"en",array(28,878,53),"Tenet","Armed with only one word - Tenet - and fighting for the survival of the entire world, the Protagonist journeys through a twilight world of international espionage on a mission that will unfold in something beyond real time.","2020-08-22",true);
           
            $DaoGenres = DaoGenres::GetInstance();
            $genres = $DaoGenres->genresFromApi();

            foreach($genres as $genre){
                $DaoGenres->Add($genre);
            }

            $DaoMovies = DaoMovies::GetInstance();
            $movies = $DaoMovies->moviesFromApi();

            foreach($movies as $movie){
                $DaoMovies->Add($movie);
            }

            
        }

        /* "genre_ids": [
            "Action",
            "Science Fiction",
            "Thriller"
        ], */
        //Falta tratar excepciones cuando se quieren insertar repetidos
        public function testGenre(){

            $daoGenre = DaoGenres::GetInstance();

            
            var_dump($daoGenre->getById(28));
        }


        public function generosDeMovie(){
            
            $DaoMovies = DaoMovies::GetInstance();
            

            var_dump($DaoMovies->movieGenres(337401));
        }

        public function getMovie(){

            $DaoMovies = DaoMovies::GetInstance();
            var_dump($DaoMovies->getById(337401));

        }

        public function getAll(){
            $DaoMovies = DaoMovies::GetInstance();
            var_dump($DaoMovies->getAll());
        }


        
    }

     

?>