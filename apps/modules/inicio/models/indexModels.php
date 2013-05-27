<?php

/*
 * Desarrollado por: Luis Remicio Obregon
 * Twitter: @remicioluis
 * Gmail: remicioluis@gmail.com
 *--------------------------------------
 * Fecha de desarrollo: 23/05/2013
 * Basado en esquema MVC
 * -------------------------------------
 * Capa de datos
 */

class indexModels extends Adodb {

	private $dsn;

	public function __construct(){
		$this->dsn = Util::read_ini(PATH.'config/config.ini', 'server_mysql');
	}

	// public function pa_demo($p){
	// 	parent::ReiniciarSQL();
	// 	parent::ConnectionOpen($this->dsn, 'pa_demo');
	// 	parent::SetParameterSP(USER_ID, 'int');
	// 	parent::SetParameterSP(SIS_ID, 'int');
	// 	//echo parent::getSql().'<br>'; exit();
	// 	$array = parent::ExecuteSPArray();
	// 	return $array;
	// }

}
