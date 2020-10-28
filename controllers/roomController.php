<?php
namespace controllers;
use daos\DaoRooms as DaoRoom;
use daos\DaoCines as DaoCine;
use models\room as Room;

class RoomController{
    private $DaosRoom;

    public function __construct(){
        $this->DaosRoom = new DaoRoom();
        $this->DaoCine = new DaoCines();
    }

    public function getByCine($idCine){
        echo json_encode($this->DaosRoom->getByCine($idCine));
    }

}


?>