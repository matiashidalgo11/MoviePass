<?php namespace controllers;

    use daos\Cine as cineDao;
    use models\Cine as Cine;

    class CuentasController
    {
        private $cineDao;

        function __construct(){
            $this->cineDao = new cineDao();
        }
        /*private $id;
        private $nombre_cine;
        private $capacidad_total;
        private $direccion;
        private $valor_entrada;
        private $peliculas = [];*/

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