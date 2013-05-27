<?php

/*
 * Desarrollado por: Luis Remicio Obregon
 * Twitter: @remicioluis
 * Gmail: remicioluis@gmail.com
 *--------------------------------------
 * Fecha de desarrollo: 23/05/2013
 * Basado en esquema MVC
 * -------------------------------------
 * Funciones comunes
 */

function get_url() {
    $parametros = array();
    $url = parse_url($_SERVER['REQUEST_URI']);
    foreach (explode("/", $url['path']) as $p)
        if ($p != '')
            $parametros[] = $p;
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $request = $_POST;
            break;
        case 'GET':
            $request = $_GET;
            break;
    }
    if (count($request) > 0) {
        foreach ($request as $index => $value) {
            $parametros[$index] = $value;
        }
    }
    return $parametros;
}

/*
 * Obteniendo path dinamicamente
 */
function getPath() {
    $ruta = realpath(dirname(__FILE__));
    if ( strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' )
        $separator = '\\';
    else
        $separator = '/';
    $aRuta = explode($separator,$ruta);
    $ruta = '';
    foreach($aRuta as $index => $value)
        if ( $index < count($aRuta) - 1 ) $ruta .= $value.$separator;
    return $ruta;
}

class Util {

    public function __construct() {
        
    }

    public static function getFormatDate($_date) {
        if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/", $_date))
            list($dia, $mes, $anio) = split("/", $_date);
        $fecha = mktime(11, 30, 0, $mes, $dia, $anio) - 0 * 24 * 60 * 60;
        return date("Y/m/d", $fecha);
    }

    public static function getFormatDateHour($_date, $h_, $m) {
        if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/", $_date))
            @list($dia, $mes, $anio) = split("/", $_date);
        $fecha = mktime(intval($h_), intval($m), 0, $mes, $dia, $anio) - 0 * 24 * 60 * 60;
        return date("Y/m/d H:i:s", $fecha);
    }

    public static function getFormatDMY($_date) {
        $f = explode('-', $_date);
        return $f[2] . '/' . $f[1] . '/' . $f[0];
    }

    public static function getNombreMes($mes) {
        $a = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre');
        return $a[intval($mes) - 1];
    }

    public static function trimCadena($cadena) {
        return str_replace(' ', '', $cadena);
    }

    public static function iaLower($array_) {
        $array = array();
        foreach($array_ as $fila){
            foreach($fila as $index => $value){
                $fila[strtolower($index)] = $value;
                unset($fila[$index]);
            }
            $array[] = $fila;
        }
        return $array;
    }
    
    public static function read_ini($file_, $_server = '') {
        $array = parse_ini_file($file_, true);
        $aServer = array();
        if ( trim($_server) != '' ){
            foreach( $array as $index => $value ){
                if ( trim($index) == $_server ){
                    $aServer = $value;
                }
            }
        }else{
            $aServer = $array;
        }
        return $aServer;
    }

    public static function conversor_divisas($divisa_origen, $divisa_destino, $cantidad) {
        $cantidad = urlencode($cantidad);
        $divisa_origen = urlencode($divisa_origen);
        $divisa_destino = urlencode($divisa_destino);
        $url = "http://www.google.com/ig/calculator?hl=en&amp;q=$cantidad$divisa_origen=?$divisa_destino";
        $rawdata = file_get_contents($url);
        $data = explode('"', $rawdata);
        $data = explode(' ', $data['3']);
        $var = $data['0'];
        return round($var,3);
    }

    public static function get_Ip() { 
        $ip = ""; 
        if(isset($_SERVER)) { 
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
                $ip=$_SERVER['HTTP_CLIENT_IP']; 
            }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
                $ip=$_SERVER['HTTP_X_FORWARDED_FOR']; 
            }else { 
                $ip=$_SERVER['REMOTE_ADDR']; 
            } 
        }else { 
            if ( getenv( 'HTTP_CLIENT_IP' ) ) { 
                $ip = getenv( 'HTTP_CLIENT_IP' ); 
            }elseif ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) { 
                $ip = getenv( 'HTTP_X_FORWARDED_FOR' ); 
            }else { 
                $ip = getenv( 'REMOTE_ADDR' ); 
            } 
        } 
        if(strstr($ip,',')) { 
            $ip = array_shift(explode(',',$ip)); 
        } 
        return $ip;
    }

}
