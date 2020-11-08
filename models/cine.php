<?php namespace models;

    class Cine {

        private $idCine;
        private $nombre;
        private $direccion;
        private $room;
        
        public function __construct( $nombre = "",  $direccion = "",$room=""){
            
            $this->nombre = $nombre;
            $this->direccion = $direccion;
            $this->room=$room;
            
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

        public function getRoom()
        {
                return $this->room;
        }

        public function setRoom($room)
        {
                $this->room = $room;

                return $this;
        }

}