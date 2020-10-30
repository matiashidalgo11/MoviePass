<?php
namespace controllers;
use daos\DaoRooms as DaoRoom;
use models\room as Room;

class RoomController{
    private $DaoRoom;

    public function __construct(){
        $this->DaoRoom = new DaoRoom();
    }

    public function add($room,$idCine){
        $this->DaoRoom->add($room,$idCine);
    }

    public function getById($id){
        return $this->DaoRoom->getById($id);
    }

    public function getArrayByCinemaId($cinemaId){
        return $this->roomDao->getArrayByCinemaId($cinemaId);
    }

}
?>