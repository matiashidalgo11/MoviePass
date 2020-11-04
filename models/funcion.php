<?php
namespace models;


class Funcion 
{
    private $id;
    private $movie;
    private $room;
    private $date;
    private $hour;
/*
    public function __construct($id, $movie, $room, $date, $hour) {
        $this->id = $id;
        $this->movie = $movie;
        $this->room = $room;
        $this->date = $date;
        $this->hour = $hour;
    }*/

    public function __construct() {
    }

    public function getId(){
        return $this->id;
    }

    public function SetId($id){
        $this->id = $id;
    }

    public function getMovie(){
        return $this->movie;
    }

    public function setMovie($movie){
        $this->movie = $movie;
    }

    public function getRoom(){
        return $this->room;
    }

    public function setRoom($room){
        $this->room = $room;
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function getHour(){
        return $this->hour;
    }

    public function setHour($hour){
        $this->hour = $hour;
    }

    

}