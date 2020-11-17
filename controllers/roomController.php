<?php
namespace controllers;

use daos\DaoCines as DaoCines;
use daos\DaoFunciones;
use daos\DaoRooms as DaoRoom;
use models\room as Room;
use models\cine as Cine;

class RoomController{

    private $DaoRoom;
    private $DaoCine;

    public function __construct(){
        $this->DaoRoom = new DaoRoom();
        $this->DaoCine = new DaoCines();
    }

    public function Add($nombre,$precio,$capacidad, $idCine){

        $cine = $this->DaoCine->getById($idCine);
        $room = new Room($nombre,$precio,$capacidad,$cine);
        $this->DaoRoom->Add($room);
        
        $this->showList($idCine);
    }

    public function getById($id){
        return $this->DaoRoom->getById($id);
    }

    public function getArrayByCinemaId($cinemaId){
        return $this->DaoRoom->getArrayByCine($cinemaId);
    }

    public function remove($idRoom){
        $this->DaoRoom->remove($idRoom);
        $this->DaoRoom->getEnabled();
    } 

    public function Update($idRoom, $nombre, $precio, $capacidad, $idCine){
        $cine = $this->DaoCine->getById($idCine);
        $room = new Room($nombre, $precio, $capacidad, $cine);
        $room->setId($idRoom);
        $this->DaoRoom->Update($room);
    }

    public function showUpdate($idRoom){
        $room = $this->DaoRoom->getById($idRoom);
        require_once(VIEWS_PATH."updateRoom.php");

    }

    public function showList($idCine)
    {
       
        $roomList=array();

        $roomList = $this->DaoRoom->getRoomsXcinema($idCine);

 
        require_once(VIEWS_PATH."list_rooms.php");
    
    }

    public function ShowAdd($idCine){

        
        require_once(VIEWS_PATH."addRoom.php");

    }


}
?>