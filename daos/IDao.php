<?php namespace daos;

    interface IDao {
       
        public function getAll();
        public function add($object);
        public function delete($object);
        public function mapeo($value);

    }

?>