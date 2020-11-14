<?php namespace controllers;

    use daos\DaoFunciones as funcionDao;
    use daos\DaoMovies as movieDao;
    use daos\DaoRooms as roomDao;
    use models\Funcion as funcion;
    

    class funcionController
    {
        private $funcionDao;
        private $movieDao;
        private $roomDao;

        function __construct(){
            $this->funcionDao = new funcionDao();
            $this->movieDao = movieDao::GetInstance();
            $this->roomDao = new roomDao();
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

        public function listFunciones(){

            $funcionesList = $this->funcionDao->getAll();


            require_once(VIEWS_PATH."cine.php");

        }

    }