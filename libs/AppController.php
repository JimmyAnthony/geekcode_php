<?php

/*
 * Desarrollado por: Luis Remicio Obregon
 * Twitter: @remicioluis
 * Gmail: remicioluis@gmail.com
 *--------------------------------------
 * Fecha de desarrollo: 23/05/2013
 * Basado en esquema MVC
 * -------------------------------------
 * Manejador de vistas
 */

 require_once PATH . 'libs/auth.php';

class AppController{

	function __construct(){
		
	}

	function valida(){
		$objAuth = new ingresoController();
		$objAuth->valida();
	}

	function view($path = '', $params = array()){
		$p = new Zend_Registry($params);
		require APPPATH_VIEW . $path;
	}

}
