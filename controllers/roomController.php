<?php
namespace controllers;
use daos\DaoRooms as DaoRoom;
use models\room as Room;

class RoomController{
    private $DaoRoom;

    public function __construct(){
        $this->DaoRoom = new DaoRoom();
    }

    public function Add($cine="",$nombre="",$capacidad="",$precio=""){
        $room = new Room($cine,$nombre,$capacidad,$precio);
        $this->DaoRoom->Add($room);
    }

    public function getById($id){
        return $this->DaoRoom->getById($id);
    }

    public function getArrayByCinemaId($cinemaId){
        return $this->roomDao->getArrayByCinemaId($cinemaId);
    }

}
?>