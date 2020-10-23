<?php namespace models;

    class Cine {

        private $id;
        private $nombre_cine;
        private $capacidad_total;
        private $direccion;
        private $valor_entrada;
        private $peliculas;

        public function __construct( $id = "", $nombre_cine = "", $capacidad_total = "", $direccion = "", $valor_entrada = "", $peliculas = array()){
            $this->id = $id;
            $this->nombre_cine = $nombre_cine;
            $this->capacidad_total = $capacidad_total;
            $this->direccion = $direccion;
            $this->valor_entrada = $valor_entrada;
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
         * Get the value of capacidad_total
         */ 
        public function getCapacidad_total()
        {
                return $this->capacidad_total;
        }

        /**
         * Set the value of capacidad_total
         *
         * @return  self
         */ 
        public function setCapacidad_total($capacidad_total)
        {
                $this->capacidad_total = $capacidad_total;

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

        /**
         * Get the value of valor_entrada
         */ 
        public function getValor_entrada()
        {
                return $this->valor_entrada;
        }

        /**
         * Set the value of valor_entrada
         *
         * @return  self
         */ 
        public function setValor_entrada($valor_entrada)
        {
                $this->valor_entrada = $valor_entrada;

                return $this;
        }

}