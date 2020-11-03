<?php namespace controllers;

    use daos\DaoCines as cineDao;
    use models\Cine as Cine;

    class CineController
    {
        private $cineDao;

        function __construct(){
            $this->cineDao = new cineDao();
        }

        public function add( $nombre,  $direccion, $room){

            $cine = new Cine($nombre,  $direccion, $room);

            $this->cineDao->add($cine);

        }

        public function GetAll(){
            return  $this->cineDao->GetAll();
            
        }

        public function GetById($idCine){
            return $this->cineDao->GetById($idCine);
            
        }

        public function Update($idCine,$nombre, $capacidad_total, $direccion, $valor_entrada){
            
            $cine = new Cine($idCine,$nombre, $capacidad_total, $direccion, $valor_entrada);

            $this->cineDao->Update($cine);

            $this->GetById($cine->idCine);
        }

        public function Delete($id){
            $this->cineDao->Delete($id);
            $this->GetAll();

        }

        public function showList(){
            
            $arrayCine = $this->cineDao->getAll();
            require_once(VIEWS_PATH."list_cine.php");
        }

        public function showAdd(){
            require_once(VIEWS_PATH."addCine.php");
        }

    }