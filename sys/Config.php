<?php
/**
 * Config.sys
 *
 * Fichero de configuracion general del framework.
 *
 * Se definen rutas y credenciales de acceso a base de datos.
 *
 * Tambien se define array con opciones de configuracion para el sistema
 *
 */

/* Descomentar si se desea trabajar con sesiones */
//session_start();

/**
 * APP_NAME: Nombre de la aplicación
 */
define('APP_NAME','');

/**
 * ENVIROMENT:
 * Define el ambiente de ejecucion, estos pueden ser
 * DEV (desarrollo)
 * TEST (testing)
 * QA ()
 * PROD (produccion)
 */
defined('ENVIROMENT')
    || define('ENVIROMENT', (getenv('ENVIROMENT') ? getenv('ENVIROMENT') : 'DEV'));

/**
 * BASE_PATH: define la ruta base de la aplicacion en la url
 */
define('BASE_PATH','/index.php');

/**
 * determinar directorio donde se ejecuta el sistema
 */
$dir_base = DS;

if(strpos($_SERVER['REQUEST_URI'], BASE_PATH) !== false){
    $path = explode(BASE_PATH, $_SERVER['REQUEST_URI']);
    
    if(!empty($path[0])){
        $dir_base .= trim($path[0],"/") . DS ;
    }    
}else{
    $dir_base = '';
}

define('DIR_BASE',$dir_base);

define('BASE_URI', DIR_BASE . trim(BASE_PATH,"/"));

define('HOST', 'http://' . $_SERVER['SERVER_NAME']);

define('EXT','');

/**
 * STATIC_FILES: corresponde a la carpeta donde se alojan archivos estaticos como hojas de estilo y archivos javascript
 */
define('STATIC_FILES', DIR_BASE . 'static/');

/**
 * DEFAULT_CONTROLLER: define el controlador por defecto/inicial para el sistema
 */
define('DEFAULT_CONTROLLER', 'Login');

/**
 * DEFAULT_TEMPLATE: define template por defecto usado en el sistema
 */
define('DEFAULT_TEMPLATE', '');

/**
 * PATH_404 : ruta de pagina personalizada para error 404 si es que se tiene
 */
define('PATH_404', '');

/**
 * ERROR_LOG_FILE : fichero personalizado para log de errores
 */
define('ERROR_LOG_FILE', 'tmp/logs/error_log');

/**
 * LANGUAGE: Define idioma del sistema
 * es: spanish
 * en: english
 */
define('LANGUAGE','es');

/**
 * EMAIL_ADMIN: correo principal de administrador
 */
define('EMAIL_ADMIN','');

/**
 * Credenciales para conexion a base de datos
 */

if(ENVIROMENT == 'DEV'){//utilizando en ambniente DEV
	define('DB_HOST', '192.168.0.200');
	define('DB_USER', 'usrmidas');
	define('DB_PASS', 'Cosof20172017.,');
        define('DB_NAME', 'prevencion');
	define('DB_PORT', '3306');
}elseif(ENVIROMENT == 'LOCAL'){
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
//	define('DB_NAME', 'tickets2');
        define('DB_NAME', 'prevencion');
	define('DB_PORT', '3306');
}elseif(ENVIROMENT == 'TEST'){
	define('DB_HOST', '192.168.10.113');
	define('DB_USER', 'valparaiso');
	define('DB_PASS', 'aSd452Fh67');
	define('DB_NAME', 'finanzas_test');
	define('DB_PORT', '3306');
}elseif(ENVIROMENT == 'PROD'){
	define('DB_HOST', '192.168.10.113');
	define('DB_USER', 'valparaiso');
	define('DB_PASS', 'aSd452Fh67');
	define('DB_NAME', 'finanzas');
	define('DB_PORT', '3306');
}

define('DB_CHAR', 'utf8');
define('DB_TYPE', 'MYSQL');
define('DB_PREFIX','');
define('DB_TRANSACCIONES', true);

global $config;

/* codificacion */
$config['codificacion'] = 'utf-8';

/*
    Setear log de errores
 */
$config['log_activado'] = false;

/**
 * Configuraciones generales
 */
$config['email_admin'] = "";

/**
* Directrices de PHP
**/

# zona horaria
date_default_timezone_set('America/Santiago');

if(ENVIROMENT != "PROD"){
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
}