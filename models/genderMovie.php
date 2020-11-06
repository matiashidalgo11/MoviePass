<?php

namespace Models;

class genderMovie
{
    private $idGender;
    private $idMovie;


    public function __construct($idGender="",$idMovie="")
    {
        $this->idGender=$idGender;
        $this->idMovie=$idMovie; 
    }


    public function getIdGender()
    {
        return $this->idGender;
    }

    public function setIdGender($id)
    {
        $this->idGender=$id;
    }

    public function getIdMovie()
    {
        return $this->idMovie;
    }

    public function setIdMovie($id)
    {
        $this->idMovie=$id;
    }
}


?>