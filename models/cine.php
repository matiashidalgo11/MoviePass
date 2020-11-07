<?php namespace models;

    class Cine {

        private $idCine;
        private $nombre;
        private $direccion;
        

        public function __construct( $nombre = "",  $direccion = "",$idCine=""){
            
            $this->nombre = $nombre;
            $this->direccion = $direccion;
            $this->idCine=$idCine;
            
        }

        public function getId()
        {
                return $this->idCine;
        }

        public function setId($idCine)
        {
                $this->idCine = $idCine;

                return $this;
        }

        public function getNombre()
        {
                return $this->nombre;
        }

        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        public function getDireccion()
        {
                return $this->direccion;
        }

        public function setDireccion($direccion)
        {
                $this->direccion = $direccion;

                return $this;
        }


}