<?php

/**
 * Geekode php (http://geekode.net/)
 * @link	https://github.com/remicioluis/geekcode_php
 * @author	Luis Remicio @remicioluis (https://twitter.com/remicioluis)
 * @version	2.0
 */

/*
 * Configuracion para carga dinamica de librerias de Zend Framework
 */
require_once 'config-zf.php';

/*
 * Funciones comunes del sistemas (funciones globales)
 */
require_once 'common.php';

/*
 * Definicion de Path global del framework
 */
define('PATH', getPath());

/*
 * Obteniendo datos del archivo de configuracion
 */
// $_CONF = new Zend_Config_Ini(PATH . 'config/config.ini', 'server_config');

$reader = new Zend\Config\Reader\Ini();
$_CONF = $reader->fromFile(PATH . 'config/config.ini')['server_config'];
/*
 * Obteniendo url
 */
$paramUrl = get_url();

/*
 * Incluyendo clase manejadora de base de datos
 */
require_once PATH . 'libs/adodb/Adodb.php';

/*
 * Path de los modulos del sistema
 */
define('APPPATH', PATH . 'apps/modules/');

/*
 * Obteniendo nombre del modulo-paquete
 */
$module = trim($paramUrl[0]) != '' ? $paramUrl[0] : $_CONF['web']['controller'];
define('APPNAME_MODULE', $module);

/*
 * Definiendo nombre del archivo controlador
 */
$controller = trim($paramUrl[1]) != '' ? $paramUrl[1] : $_CONF['web']['action'];
define('APPNAME_CONTROLLER', $controller);

/*
 * Definiendo path de carpetas del sistema
 */
define('APPPATH_MODULE', APPPATH . APPNAME_MODULE . '/controllers/');
define('APPPATH_MODEL', APPPATH . APPNAME_MODULE . '/models/');
define('APPPATH_VIEW', APPPATH . APPNAME_MODULE . '/views/');

/*
 * Definiendo acciones
 */
$actionClass = APPNAME_CONTROLLER . 'Controller';
$modelsClass = APPNAME_CONTROLLER . 'Models';

/*
 * Definiendo files del sistema
 */
define('APPFILE_MODULE', APPPATH_MODULE . $actionClass . '.php');
define('APPFILE_MODEL', APPPATH_MODEL . $modelsClass . '.php');

/*
 * Manejador de vistas
 */
require_once PATH.'libs/AppController.php';

$controllerMethod = $paramUrl[2];
if (trim($controllerMethod) == '')
	$controllerMethod = 'index';
if (!file_exists(APPFILE_MODULE)) {
	define(MSGNOTFOUNT, 'No existe archivo ' . $actionClass);
	// require_once PATH . 'apps/modules/login/views/page_notfount.php';
}else {
	if (file_exists(APPFILE_MODEL))
		require_once APPFILE_MODEL;
	require_once APPFILE_MODULE;
	if (!class_exists($actionClass)) {
		define(MSGNOTFOUNT, 'No existe clase para el modulo ' . APPNAME_MODULE . '.');
		require_once PATH . 'apps/modules/login/views/page_notfount.php';
	} else {
		$classModule = new $actionClass();
		if (!method_exists($classModule, $controllerMethod)) {
			define(MSGNOTFOUNT, 'No existe metodo ' . $controllerMethod);
			require_once PATH . 'apps/modules/login/views/page_notfount.php';
		} else {
			echo $classModule -> $controllerMethod($paramUrl);
		}
	}
}
