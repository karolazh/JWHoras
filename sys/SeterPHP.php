<?php
/**
 * SeterPHP.php :
 * archivo de configuracion para setear directivas de PHP.
 *
 * Se pueden agregar tantas directivas como sean necesarias
 */


/**
 * Verificar ambiente de ejecucion para setear display_errors segun corresponda
 */
if(defined('ENVIROMENT')){
	if(ENVIROMENT == 'DEV' || ENVIROMENT == 'TEST'){
		error_reporting(E_ALL);
		ini_set("display_errors","On");
	}elseif(ENVIROMENT == 'PROD'){
		error_reporting(0);
	}
}


/**
 * setear lenguaje local, especialmente para fechas
 */
setlocale(LC_TIME, 'es','es-ES', 'es_ES.utf8', 'es_CL.utf8');

?>
