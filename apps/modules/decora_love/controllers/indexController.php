<?php

/**
 * Geekode php (http://geekode.net/)
 * @link    https://github.com/remicioluis/geekcode_php
 * @author  Luis Remicio @remicioluis (https://twitter.com/remicioluis)
 * @version 2.0
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
        
        $this->view('index.php', array());
    }    

}