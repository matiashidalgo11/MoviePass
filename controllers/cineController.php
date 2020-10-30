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

            $cinema = new Cine($nombre,  $direccion, $room);

            $this->cineDao->add($cinema);

        }

        public function GetAll(){
            return  $this->cineDao->GetAll();
            
        }

        public function GetById($id){
            return $this->cineDao->GetById($id);
            
        }

        public function Update($id,$nombre, $capacidad_total, $direccion, $valor_entrada){
            
            $cine = new Cine($id,$nombre, $capacidad_total, $direccion, $valor_entrada);

            $this->cineDao->Update($cine);

            $this->GetById($cine->id);
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