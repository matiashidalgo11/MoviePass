<?php
namespace models;

use models\Cuenta as Cuenta;

class Cliente extends Cuenta{

	private $nombre;
	private $apellido;
	private $domicilio;
    private $telefono;
    private $entradas[];

    function __construct ($id = "", $email = "", $password = "", $privilegios = "",$nombre = "",
                            $apellido = "",$domicilio = "",$telefono = "", $entradas = []) {

        super($id,$email,$password,$privilegios);
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->domicilio = $domicilio;
        $this->telefono = $telefono;
        $this->entradas = $entradas;

    }
	/**
	 * Get the value of id
	 */ 
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get the value of nombre
	 */ 
	public function getNombre()
	{
		return $this->nombre;
	}

	/**
	 * Set the value of nombre
	 *
	 * @return  self
	 */ 
	public function setNombre($nombre)
	{
		$this->nombre = $nombre;

		return $this;
	}

	/**
	 * Get the value of apellido
	 */ 
	public function getApellido()
	{
		return $this->apellido;
	}

	/**
	 * Set the value of apellido
	 *
	 * @return  self
	 */ 
	public function setApellido($apellido)
	{
		$this->apellido = $apellido;

		return $this;
	}

	/**
	 * Get the value of domicilio
	 */ 
	public function getDomicilio()
	{
		return $this->domicilio;
	}

	/**
	 * Set the value of domicilio
	 *
	 * @return  self
	 */ 
	public function setDomicilio($domicilio)
	{
		$this->domicilio = $domicilio;

		return $this;
	}

	/**
	 * Get the value of telefono
	 */ 
	public function getTelefono()
	{
		return $this->telefono;
	}

	/**
	 * Set the value of telefono
	 *
	 * @return  self
	 */ 
	public function setTelefono($telefono)
	{
		$this->telefono = $telefono;

		return $this;
	}

	
}