<?php

/**
 * Geekode php (http://geekode.net/)
 * @link	https://github.com/remicioluis/geekcode_php
 * @author	Luis Remicio @remicioluis (https://twitter.com/remicioluis)
 * @version	2.0
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
