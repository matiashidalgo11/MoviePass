<?php
namespace models;

class Cuenta
{

	private $id;
	private $email;
	private $password;
	private $privilegios;

	function __construct ($id="",$email="", $pass="", $privilegios="") {

		$this->id = $id;
		$this->email = $email;
		$this->password = $pass;
		$this->privilegios = $privilegios;
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
	 * Get the value of email
	 */ 
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Set the value of email
	 *
	 * @return  self
	 */ 
	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * Get the value of password
	 */ 
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Set the value of password
	 *
	 * @return  self
	 */ 
	public function setPassword($password)
	{
		$this->password = $password;

		return $this;
	}

	/**
	 * Get the value of privilegios
	 */ 
	public function getPrivilegios()
	{
		return $this->privilegios;
	}

	/**
	 * Set the value of privilegios
	 *
	 * @return  self
	 */ 
	public function setPrivilegios($privilegios)
	{
		$this->privilegios = $privilegios;

		return $this;
    }
    
}