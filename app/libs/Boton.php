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

	public static function getBotonEmpa($id_paciente='0'){
		return	"	<button type='button' 
						onClick=\"location.href=('".BASE_URI."/Empa/nuevo/$id_paciente')\" 
						data-toggle='tooltip' 
						class='btn btn-xs btn-success'
						data-title='Formulario EMPA'>
						<i class='fa fa-book'></i>
					</button>";
	}

	/*
	public static function getBotonPlan($id_paciente='0'){
		return	"	<button type='button' 
						onClick=\"location.href=('".BASE_URI."/Medico/plan_tratamiento/$id_paciente')\" 
						data-toggle='tooltip' 
						class='btn btn-xs btn-default'
						data-title='Plan Tratamiento'>
						<i class='fa fa-medkit'></i>
					</button>";
	}
	*/

	public static function getBotonDiagnostico($id_paciente='0'){
		return	"	<button type='button' 
						onClick=\"location.href=('".BASE_URI."/Especialista/diagnostico/$id_paciente')\" 
						data-toggle='tooltip' 
						class='btn btn-xs btn-default'
						data-title='Diagnóstico'>
						<i class='fa fa-user-md'></i>
					</button>";
	}

	public static function getBotonSeguimiento($id_paciente='0'){
		return	"	<button type='button' 
						onClick=\"location.href=('".BASE_URI."/Gestor/seguimiento/$id_paciente')\" 
						data-toggle='tooltip' 
						class='btn btn-xs btn-warning'
						data-title='Seguimiento'>
						<i class='fa fa-eye'></i>
					</button>";
	}

	public static function getBotonExamen($id_paciente='0'){
		return	"	<button type='button' 
						onClick=\"location.href=('".BASE_URI."/Laboratorio/ver/$id_paciente')\" 
						data-toggle='tooltip' 
						class='btn btn-xs btn-success'
						data-title='Formulario Examen'>
						<i class='fa fa-file-text-o'></i>
					</button>";
	}

	public static function getBotonAgendaExamen($id_paciente='0'){
		return	"	<button type='button' 
						onClick=\"xModal.open('".BASE_URI."/Agenda/ver/$id_paciente', 'Agenda Examen Paciente', 85)\" 
						data-toggle='tooltip' 
						class='btn btn-xs btn-info'
						data-title='Ver Agenda Examen'>
						<i class='fa fa-calendar'></i>
					</button>";
	}

	public static function getBotonAgendaEspecialista($id_paciente='0'){
		return	"	<button type='button' 
						onClick=\"xModal.open('".BASE_URI."/Agenda/verEspecialista/$id_paciente', 'Agenda Especialista', 85)\" 
						data-toggle='tooltip' 
						class='btn btn-xs btn-primary'
						data-title='Ver Agenda Especialista'>
						<i class='fa fa-calendar'></i>
					</button>";
	}

	public static function getBotonVer($id_paciente='0'){
		return	"	<button type='button' 
						onClick=\"xModal.open('".BASE_URI."/Paciente/ver/$id_paciente', 'Detalle Paciente', 85)\" 
						data-toggle='tooltip' 
						class='btn btn-xs btn-info'
						data-title='Ver Paciente'>
						<i class='fa fa-search'></i>
					</button>";
	}

	public static function getBotonBitacora($id_paciente='0'){
		return	"	<button type='button' 
						onClick=\"xModal.open('".BASE_URI."/Bitacora/ver/$id_paciente', 'Bitácora Paciente', 85)\" 
						data-toggle='tooltip' 
						class='btn btn-xs btn-primary'
						data-title='Bitácora'>
						<i class='fa fa-info-circle'></i>
					</button>";
	}

	/**
	* Generar botones en Grilla
	* @param string $bandeja [de donde se llama]
	* @param int $id_paciente
	* @return string html
	*/
	public static function botonGrillaPaciente($bandeja='',$id_paciente='0'){

		$empa 					= Boton::getBotonEmpa($id_paciente);
		//$plan 					= Boton::getBotonPlan($id_paciente);
		$diagnostico 			= Boton::getBotonDiagnostico($id_paciente);
		$seguimiento			= Boton::getBotonSeguimiento($id_paciente);
		$examen 				= Boton::getBotonExamen($id_paciente);
		$agendaExamen 			= Boton::getBotonAgendaExamen($id_paciente);
		$agendaEspecialista 	= Boton::getBotonAgendaEspecialista($id_paciente);
		$ver					= Boton::getBotonVer($id_paciente);
		$bitacora				= Boton::getBotonBitacora($id_paciente);
		$botones				= $agendaExamen.$ver.$bitacora;

		if($bandeja == 'Paciente'){
			$botones	= $empa.$agendaExamen.$ver.$bitacora;
		}else if($bandeja == 'Medico'){
			//$botones	= $empa.$plan.$agendaExamen.$ver.$bitacora;
			$botones	= $empa.$agendaExamen.$ver.$bitacora;
		}else if($bandeja == 'Laboratorio'){
			$botones	= $examen.$agendaExamen.$ver.$bitacora;
		}else if($bandeja == 'Especialista'){
			$botones	= $diagnostico.$agendaEspecialista.$agendaExamen.$ver.$bitacora;
		}else if($bandeja == 'Gestor'){
			$botones	= $seguimiento.$agendaExamen.$ver.$bitacora;
		}
		
		return $botones;
	}

}