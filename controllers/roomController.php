<?php
namespace controllers;

use daos\DaoCines as DaoCines;
use daos\DaoFunciones;
use daos\DaoRooms as DaoRoom;
use models\room as Room;

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
        $this->DaoCine->remove($idRoom);
        $this->GetAll();
    } 

    public function Update($nombre, $precio, $capacidad){
        $cine = $DaoRoom->getCine();
        $room = new Room($nombre, $precio, $capacidad, $cine);
        $this->DaoRoom->Update($room);
    }

    public function showUpdate(){
        require_once(VIEWS_PATH."updateRoom.php");

    }

    public function showList($idCine)
    {
        echo "<br>" . $idCine . "<br>" ;
       
        $roomList=array();

        $roomList=$this->DaoRoom->getRoomsXcinema($idCine);

        require_once(VIEWS_PATH."list_rooms.php");
    
    }

    public function ShowAdd($idCine){

        
        require_once(VIEWS_PATH."addRoom.php");

    }


}
?>