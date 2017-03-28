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

	/**
	* Generar botones en Grilla
	* @param string $bandeja [de donde se llama]
	* @return string html
	*/
	public static function botonGrillaPaciente($bandeja){
		$id_perfil		= $_SESSION['perfil'];
		$id_region		= $_SESSION['id_region'];
		$id_institucion	= $_SESSION['id_institucion'];
		$id_laboratorio = $_SESSION['id_laboratorio'];

		//if $mostrar_especialista != 1 and $mostrar_gestor != 1 Enfermera/Medico
		$empa 	= "	<button type='button' 
						onClick=\"location.href=('".BASE_URI."/Empa/nuevo/'+$('#id_paciente').val())\" 
						data-toggle='tooltip' 
						class='btn btn-xs btn-success'
						data-title='Formulario EMPA'>
						<i class='fa fa-book'></i>
					</button>";

		//Medico - Incluir en el EMPA
		$plan 	= "	<button type='button' 
						onClick=\"location.href=('".BASE_URI."/Medico/plan_tratamiento/'+$('#id_paciente').val())\" 
						data-toggle='tooltip' 
						class='btn btn-xs btn-default'
						data-title='Plan Tratamiento'>
						<i class='fa fa-medkit'></i>
					</button>";

		//{if $mostrar_especialista == 1} Especialista
		$diagnostico 	= "	<button type='button' 
								onClick=\"location.href=('".BASE_URI."/Especialista/diagnostico/'+$('#id_paciente').val())\" 
								data-toggle='tooltip' 
								class='btn btn-xs btn-default'
								data-title='Diagnóstico'>
								<i class='fa fa-user-md'></i>
							</button>";

		//{if $mostrar_gestor == 1} Gestor
		$seguimiento 	= "	<button type='button' 
								onClick=\"location.href=('".BASE_URI."/Gestor/seguimiento/'+$('#id_paciente').val())\" 
								data-toggle='tooltip' 
								class='btn btn-xs btn-danger'
								data-title='Seguimiento'>
								<i class='fa fa-eye'></i>
							</button>";

		// Laboratorio
		$examen 	= "	<button type='button' 
								onClick=\"location.href=('".BASE_URI."/Laboratorio/ver/'+$('#id_paciente').val())\" 
								data-toggle='tooltip' 
								class='btn btn-xs btn-success'
								data-title='Formulario Examen'>
								<i class='fa fa-file-text-o'></i>
							</button>";

		//Enfermera - Especialista - Medico
		$agendaExamen 	= "	<button type='button' 
								onClick=\"xModal.open('".BASE_URI."/Agenda/ver/'+$('#id_paciente').val(), 'Agenda Examen Paciente', 85)\" 
								data-toggle='tooltip' 
								class='btn btn-xs btn-info'
								data-title='Ver Agenda Examen'>
								<i class='fa fa-calendar'></i>
							</button>";

		// Falta Ver Agenda Especialista

		//Todos
		$ver	= "	<button type='button' 
						onClick=\"xModal.open('".BASE_URI."/Paciente/ver/'+$('#id_paciente').val(), 'Detalle Paciente', 85)\" 
						data-toggle='tooltip' 
						class='btn btn-xs btn-info'
						data-title='Ver Paciente'>
						<i class='fa fa-search'></i>
					</button>";

		//Todos
		$bitacora	= "	<button type='button' 
						onClick=\"xModal.open('".BASE_URI."/Bitacora/ver/'+$('#id_paciente').val(), 'Bitácora Paciente', 85)\" 
						data-toggle='tooltip' 
						class='btn btn-xs btn-primary'
						data-title='Bitácora'>
						<i class='fa fa-info-circle'></i>
					</button>";

		//$botones	= $empa.$plan.$diagnostico.$seguimiento.$examen.$agendaExamen.$ver.$bitacora;
		$botones	= $agendaExamen.$ver.$bitacora;

		if($bandeja == 'Paciente'){
			$botones	= $empa.$agendaExamen.$ver.$bitacora;
		}else if($bandeja == 'Medico'){
			$botones	= $empa.$plan.$agendaExamen.$ver.$bitacora;
		}else if($bandeja == 'Laboratorio'){
			$botones	= $examen.$agendaExamen.$ver.$bitacora;
		}
		
		return $botones;
	}

}