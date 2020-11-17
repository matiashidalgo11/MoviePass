<?php namespace controllers;

    use daos\DaoCines as cineDao;
    use models\Cine as Cine;

    class CineController
    {
        private $cineDao;

        function __construct(){
            $this->cineDao = new cineDao();
        }

        public function add( $nombre, $direccion){

            $cine = new Cine($nombre,  $direccion);

            $this->cineDao->add($cine);

            $this->showList();

        }

        public function GetAll(){
            return  $this->cineDao->GetAll();
            
        }

        public function GetById($idCine){
            return $this->cineDao->GetById($idCine);
            
        }

        public function Update($idCine, $nombre, $direccion){
            $cine = new Cine($nombre, $direccion);
            $cine->setId($idCine);
            $this->cineDao->Update($cine);
        }

        public function showUpdate($idCine){
            $cine = $this->cineDao->getById($idCine);
            require_once(VIEWS_PATH."updateCine.php");
        }

        public function Delete($id){
            $this->cineDao->remove($id);
            
            $this->showList();
        }

        public function showList(){

            $arrayCine = $this->cineDao->getAll();

            require_once(VIEWS_PATH."list_cines.php");
        }

        public function showAdd(){
            require_once(VIEWS_PATH."addCine.php");
        }

    }