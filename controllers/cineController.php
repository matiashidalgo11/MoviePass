<?php namespace controllers;

    use daos\Cine as cineDao;
    use models\Cine as Cine;

    class CineController
    {
        private $cineDao;

        function __construct(){
            $this->cineDao = new cineDao();
        }

        public function add( $nombre_cine, $capacidad_total, $direccion, $valor_entrada){

            $cine = new Cine($nombre_cine, $capacidad_total, $direccion, $valor_entrada);

            $this->cineDao->add($cine);

            var_dump($cine);
        }

        public function GetAll(){
            $cine_list = $this->cineDao->GetAll();
            include(ROOT . '/views/list_cines.php');
            
        }

        public function GetById($id){
            $cine = $this->cineDao->GetById($id);
            include(ROOT . '/views/cine.php');
            
        }

        public function Update($id,$nombre_cine, $capacidad_total, $direccion, $valor_entrada){
            
            $cine = new Cine($id,$nombre_cine, $capacidad_total, $direccion, $valor_entrada);

            $this->cineDao->Update($cine);

            $this->GetById($cine->id);
        }

        public function Delete($id){
            $this->cineDao->Delete($id);
            $this->GetAll();

        }


    }