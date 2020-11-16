<?php

	/**
	 * Mostrar errores de PHP
	 */
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	/**
	 * Archivos necesarios de inicio
	 */
	require "config/autoload.php";
	require "config/config.php";
	require 'Facebook/autoload.php';

	/**
	 * Alias
	 */
	use config\autoload 	as Autoload;
	use config\router 	as Router;
	use config\request 	as Request;

	/**
	 * Flujo de ejecución
	 */
	Autoload::Start();

	session_start();

	//Colocar en las views
	require_once(VIEWS_PATH . "header.php");

	Router::Route(new Request());

	require_once(VIEWS_PATH . "footer.php");

	