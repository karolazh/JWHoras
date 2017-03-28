<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Helper de Boton
* Plataforma	: !PHP
* Creacion		: 24/02/2017
* @name			Boton.php
* @version		1.0
* @author		Victor Retamal <victor.retamal@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*
*-----------------------------------------------------------------------------
*****************************************************************************
*/

Class Boton{

	/**
	* Genera boton Ayuda ?
	* @param string $explicacion
	* @param string $titulo
	* @param string $class_posicion 'pull-left', 'pull-right' o '' 
	* @return string html
	*/
	public static function botonAyuda($explicacion, $titulo='', $class_posicion="pull-right", $class_color="btn-primary"){
		
		return '<span class="btn btn-xs '.$class_color.' '.$class_posicion.' infoTip" data-pos="'.$class_posicion.'" data-titulo="'.$titulo.'" data-texto="'.$explicacion.'">
					<li class="fa fa-question-circle"></li>
				</span>';
	}

	public static function botonGrillaPaciente(){
		$id_perfil		= $_SESSION['perfil'];
		$id_region		= $_SESSION['id_region'];
		$id_institucion	= $_SESSION['id_institucion'];
		$id_laboratorio = $_SESSION['id_laboratorio'];

		$xModal		= BASE_URI."/Paciente/ver/+$('#id_paciente').val()+/', 'Detalle Registro', 85";
		$botones 	= "	<button type='button' 
								onClick='xModal.open($xModal);' 
								data-toggle='tooltip' 
								class='btn btn-xs btn-info'
								data-title='Ver Registro'>
								<i class='fa fa-search'></i>
						</button>";
		return $botones;
	}

}