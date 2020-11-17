<?php namespace controllers;

    use daos\DaoFunciones as funcionDao;
    use daos\DaoMovies as movieDao;
    use daos\DaoRooms as roomDao;
    use models\Funcion as funcion;
    use daos\DaoGenres as DaoGenders;
    use controllers\MoviesController as MoviesController;
use PDOException;

class funcionController
    {
        private $funcionDao;
        private $movieDao;
        private $roomDao;
        private $genderDao;

        function __construct(){
            $this->funcionDao = new funcionDao();
            $this->movieDao = movieDao::GetInstance();
            $this->roomDao = new roomDao();
            $this-> genderDao = DaoGenders::GetInstance();
        }

        public function Add( $idMovie, $idRoom, $date, $hour){

            if(!($this->funcionDao->funcionExistence($idMovie,$date)))
            {
                $funcion = new Funcion();
                $movie = $this->movieDao->GetById($idMovie);
                $funcion->setMovie($movie);
                $room = $this->roomDao->GetById($idRoom);
                $funcion->setRoom($room);
                $funcion->setDate($date);
                $funcion->setHour($hour);
                $this->funcionDao->add($funcion);
            }

            $this->listFunciones();
        }

    

        public function GetAll(){
            return  $this->funcionDao->GetAll();
            
        }

        public function GetById($id){
            return $this->funcionDao->GetById($id);
            
        }

        public function Delete($id){
            $this->funcionDao->remove($id);
        }

        public function showAdd($idRoom){
            $moviesArray = $this->movieDao->getAll();

            require_once(VIEWS_PATH."addFuncion.php");
        }
        public function showAddMovie($idMovie)
        {
            $movie=$this->movieDao->getById($idMovie);
            $roomList=$this->roomDao->GetAll();
            require_once(VIEWS_PATH."addFuncionMovie.php");
            
        }

        public function listFunciones(){

            if($_SESSION['cuenta']->getPrivilegios()==1)
            {
                $funcionesList = $this->funcionDao->getAll();
                $listGenres= $this->genderDao->getAll();
                require_once(VIEWS_PATH."cine.php");
            }else
            {
                $movieController= new MoviesController();
                $movieController->listMovies();
               
            }
            

        }

        public function SearchByName($nameMovie)
        {
            echo $nameMovie;
            $funcionesList=array();
            $listGenres= $this->genderDao->getAll();
            try
            {
             $funcionesList=$this->funcionDao->searchByName($nameMovie);    
            }catch(PDOException $e)
            { $e->getMessage();}
            require_once(VIEWS_PATH."cine.php");
        }

        public function SearchByDate($date)
        {
            $funcionesList=array();
            $listGenres= $this->genderDao->getAll();
            try
            {
             $funcionesList=$this->funcionDao->searchByDate($date);    
            }catch(PDOException $e)
            { $e->getMessage();}
            require_once(VIEWS_PATH."cine.php");
        }

        public function SearchByGenre($idGenre)
        {
            $funcionesList=array();
            $listGenres= $this->genderDao->getAll();
            try
            {
             $funcionesList=$this->funcionDao->searchByGenre($idGenre);    
            }catch(PDOException $e)
            { $e->getMessage();}
            require_once(VIEWS_PATH."cine.php");
        }

    }