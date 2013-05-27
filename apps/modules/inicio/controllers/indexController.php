<?php

/*
 * Desarrollado por: Luis Remicio Obregon
 * Twitter: @remicioluis
 * Gmail: remicioluis@gmail.com
 *--------------------------------------
 * Fecha de desarrollo: 23/05/2013
 * Basado en esquema MVC
 * -------------------------------------
 * Capa de control
 */

class indexController extends AppController {

	private $objDatos;
	private $arrayMenu;

	public function __construct(){
		/*
		 * Solo incluir en caso se manejen sessiones
		 */
		// $this->valida();

		$this->objDatos = new indexModels();
	}

	public function index($p){
		/*
		 * Cargando datos de archivo de configuracion
		 */
        $_CONF = new Zend_Config_Ini(PATH . 'config/config.ini', 'server_config');
        
        $this->view('index.php', array('vhtmlMenu' => $vhtmlMenu, 'title'=>$_CONF->app->title));
	}    

}