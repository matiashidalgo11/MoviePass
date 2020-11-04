<?php
namespace models;


class Room{

    private $idRoom;
    private $nombre;
    private $precio;
    private $capacidad;
    private $idCine;

    public function __construct($nombre = '', $precio= '', $capacidad= '', $idCine = ''){
		$this->idRoom = $idRoom;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->capacity = $capacity;
        $this->idCinema = $idCinema;
    }

    public function getId(){
		return $this->idRoom;
	}

	public function setId($idRoom){
		$this->idRoom = $idRoom;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getPrecio(){
		return $this->precio;
	}

	public function setPrecio($precio){
		$this->precio = $precio;
	}

	public function getCapacidad(){
		return $this->capacidad;
	}

	public function setCapacidad($capacidad){
		$this->capacidad = $capacidad;
	}

	public function getIdCine(){
		return $this->idCine;
	}

	public function setIdCine($idCine){
		$this->idCine = $idCine;
	}

}