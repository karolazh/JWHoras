<?php

/**
* Cosof
* @author Victor Retamal <victor.retamal@cosof.cl>
*/

Class Boton{

	/**
	 * Genera boton Ayuda ?
	 * @param string $explicacion
	 * @param string $titulo
	 * @param string $class_posicion 'pull-left', 'pull-right' o '' 
	 * @return string html
	 */
	function botonAyuda($explicacion, $titulo='', $class_posicion="pull-right", $class_color="btn-primary"){
		
		return '<span class="btn btn-xs '.$class_color.' '.$class_posicion.' infoTip" data-pos="'.$class_posicion.'" data-titulo="'.$titulo.'" data-texto="'.$explicacion.'">
					<li class="fa fa-question-circle"></li>
				</span>';
	}
}