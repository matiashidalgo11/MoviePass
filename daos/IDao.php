<?php namespace daos;

    interface IDao {
       
        public function GetAll();
        public function Add($object);
        public function Delete($object);
        public function mapeo($value);

    }

?>