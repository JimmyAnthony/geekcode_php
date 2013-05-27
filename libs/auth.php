<?php

/*
 * Desarrollado por: Luis Remicio Obregon
 * Twitter: @remicioluis
 * Gmail: remicioluis@gmail.com
 *--------------------------------------
 * Fecha de desarrollo: 23/05/2013
 * Basado en esquema MVC
 * -------------------------------------
 * Controla accesos al sistema
 */

class ingresoController {
    
	private $objSess;

    public function __construct() {
        Zend_Session::start();
        $this->objSess = new Zend_Session_Namespace('geekcode');
        define(SIS_ID, $this->objSess->sis_id);
        define(USER_ID, $this->objSess->user_id);
        define(PER_ID, $this->objSess->per_id);
        define(NOMBRE, $this->objSess->nombre);
        define(USER_LOGIN, $this->objSess->user_login);

        /* --- Verifica Tiempos de Session --- */
        if ($this->objSess->time === true) {
            $this->objSess->setExpirationSeconds(1800, 'time');
            $this->objSess->setExpirationSeconds(1800);
            $this->objSess->time = true;
        }
        /* ----------------------------------- */
    }

    public function valida($p='') {
    	if (trim(USER_ID) == '') {
            // header("Location: ");
            die();
        }
    }

    public function expire($p) {
        Zend_Session::namespaceUnset('simionline');
    }

}
