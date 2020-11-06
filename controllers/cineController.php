<?php namespace controllers;

    use daos\DaoCines as cineDao;
    use models\Cine as cine;

    class CineController
    {
        private $cineDao;

        function __construct(){
            $this->cineDao = new cineDao();
        }

        public function Add($nombre="",$direccion="",$room=""){
            $cine = new Cine($nombre,$direccion,$room);
            $this->cineDao->Add($cine);
        }

        public function GetAll(){
            return  $this->cineDao->GetAll();
        }

        public function GetById($idCine){
            return $this->cineDao->GetById($idCine);
        }

        public function Update($idCine){
            $cine = $this->cineDao->GetById($idCine);
            require_once(VIEWS_PATH."updateCine.php");
        }

        public function remove($idCine){
            $this->cineDao->remove($idCine);
        }

        public function showList(){
            $arrayCine = $this->cineDao->getAll();
            require_once(VIEWS_PATH."list_cine.php");
        }

        public function showAdd(){
            require_once(VIEWS_PATH."addCine.php");
        }

    }