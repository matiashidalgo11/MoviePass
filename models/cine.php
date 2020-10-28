<?php namespace models;

    class Cine {

        private $id;
        private $nombre_cine;
        private $direccion;

        public function __construct( $nombre_cine = "",  $direccion = ""){
            $this->id = $id;
            $this->nombre_cine = $nombre_cine;
            $this->direccion = $direccion;
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of nombre_cine
         */ 
        public function getNombre_cine()
        {
                return $this->nombre_cine;
        }

        /**
         * Set the value of nombre_cine
         *
         * @return  self
         */ 
        public function setNombre_cine($nombre_cine)
        {
                $this->nombre_cine = $nombre_cine;

                return $this;
        }

        /**
         * Get the value of direccion
         */ 
        public function getDireccion()
        {
                return $this->direccion;
        }

        /**
         * Set the value of direccion
         *
         * @return  self
         */ 
        public function setDireccion($direccion)
        {
                $this->direccion = $direccion;

                return $this;
        }

}