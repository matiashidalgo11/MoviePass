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
            $this->movieDao = new movieDao();
            $this->roomDao = new roomDao();
        }

        public function Add( $idMovie, $idRoom, $date, $hour){

            $funcion = new Funcion();
            $movie = $this->movieDao->GetById($idMovie);// No tiene get el DaoMovies
            $funcion->setMovie($movie);
            $room = $this->roomDao->GetById($idRoom);
            $funcion->setRoom($room);
            $funcion->setDate($date);
            $funcion->setDate($hour);

            $this->funcionDao->add($funcion);
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

        public function showAdd(){
            
            $arrayMovie = $this->movieDao->getAll();
            $arrayRoom = $this->roomDao->GetAll();
            require_once(VIEWS_PATH."addFuncion.php");
        }

    }