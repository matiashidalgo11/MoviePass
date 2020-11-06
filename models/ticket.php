<?php

namespace models;


class ticket
{

        private $id;
        private $compra;
        private $funcion;


        public function __construct($compra="",$funcion="")
        {
            
            $this->compra=$compra;
            $this->funcion=$funcion;
        }

        /**
         */
        public function getId()
        {
            return $this->id;
        }
        /**
         */
        public function setId($id)
        {
            $this->id=$id;
        }

        /**
         */
        public function getCompra()
        {
            return $this->compra;
        }
        /**
         */
        public function setCompra($compra)
        {
            $this->compra=$compra;
        }

         /**
         */
        public function getFuncion()
        {
            return $this->funcion;
        }
        /**
         */
        public function setFuncion($funcion)
        {
            $this->funcion=$funcion;
        }

}








?>