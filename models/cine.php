<?php namespace models;

    class Cine {

        private $id;
        private $nombre;
        private $direccion;
        private $room;

        public function __construct( $nombre = "",  $direccion = "", $room = ""){
            $this->id = $id;
            $this->nombre_cine = $nombre_cine;
            $this->direccion = $direccion;
        }

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

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

        public function getRoom(){

                return $this->room;

        }

        public function setRoom($room){

                $this->room=$room;

                return $this;
                
        }

}