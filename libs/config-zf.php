<?php

/*
 * Desarrollado por: Luis Remicio Obregon
 * Twitter: @remicioluis
 * Gmail: remicioluis@gmail.com
 *--------------------------------------
 * Fecha de desarrollo: 23/05/2013
 * Basado en esquema MVC
 * -------------------------------------
 * Carga dinamica de librerias Zend Framework
 */

/*set_include_path(
	'.' . PATH_SEPARATOR . realpath(dirname(__FILE__))
    .PATH_SEPARATOR . get_include_path()
);

require 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();*/

require_once 'Zend/Loader/StandardAutoloader.php';
$autoloader = new Zend\Loader\StandardAutoloader(array(
    'autoregister_zf' => true,
    'fallback_autoloader' => true,
));
$autoloader->register();