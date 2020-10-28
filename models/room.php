<?php
namespace models;


class Room{

    private $id;
    private $nombre;
    private $precio;
    private $capacidad;
    private $idCine;

    public function __construct($nombre = '', $precio= '', $capacidad= '', $idCine = ''){
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->capacity = $capacity;
        $this->idCinema = $idCinema;
    }

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
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