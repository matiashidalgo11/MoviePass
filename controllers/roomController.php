<?php
namespace controllers;
use daos\DaoRooms as roomDao;
use daos\DaoCine as cineDao;

class RoomController{
    private $roomDao;
    private $cineDao;

    public function __construct(){
        $this->roomDao = new DaoRooms();
        $this->cineDao = new DaoCines();
    }

    public function Add($cine="",$nombre="",$capacidad="",$precio=""){
        $room = new Room($cine,$nombre,$capacidad,$precio);
        $this->roomDao->Add($room);
    }

    public function getById($idRoom){
        return $this->roomDao->getById($idRoom);
    }

    public function getArrayByCinemaId($idCine){
        return $this->roomDao->getArrayByCinemaId($idCine);
    }

    public function remove($idRoom){
        $this->roomDao->remove($idRoom);
    } 

    public function GetAll(){
        return $this->roomDao->GetAll();
    }
/*
    public function showList(){
        $arrayRoom = $this->roomDao->GetAll();
        require_once(VIEWS_PATH."list_room.php");
    }*/

    public function showAdd(){
        $arrayCine = $this->cineDao->GetAll();
        require_once(VIEWS_PATH."addRoom.php");
    }

    public function showList($idCine)
    {
        
       
        $roomList=array();

        $roomList=$this->DaoRoom->getRoomsXcinema($idCine);

        require_once(VIEWS_PATH."list_rooms.php");
    
    }
}
?>