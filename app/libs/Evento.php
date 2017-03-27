<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Helper de Eventos
* Plataforma	: !PHP
* Creacion		: 24/02/2017
* @name			Evento.php
* @version		1.0
* @author		Orlando Vázquez <orlando.vazquez@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*
*-----------------------------------------------------------------------------
*****************************************************************************
*/

include_once (APP_PATH . 'models/DAOEvento.php');

Class Evento{

    protected $_DAOEvento;

    public function __construct() {
        $this->_DAOEvento = New DAOEvento();
    }
    
	 /**
     * Guarda un Nuevo Evento
     * @param int $tipo_evento
	 * @param int $id_empa
	 * @param int $id_paciente
	 * @param string $gl_descripcion
	 * @param string $bo_estado
	 * @param int $id_usuario_crea
     */
    public function guardar($tipo_evento,$id_empa, $id_paciente, $gl_descripcion, $bo_estado,$bo_mostrar, $id_usuario_crea){
        
        $datos_evento['eventos_tipo']			= $tipo_evento;
		$datos_evento['id_empa']				= $id_empa;
		$datos_evento['id_paciente']			= $id_paciente;
		$datos_evento['gl_descripcion']			= $gl_descripcion;
		$datos_evento['bo_estado']				= $bo_estado;
		$datos_evento['bo_mostrar']				= $bo_mostrar;
		$datos_evento['id_usuario_crea']		= $id_usuario_crea;
		$resp									= $this->_DAOEvento->insEvento($datos_evento);
		return $resp;
    }

	public function guardarMostrarUltimo($tipo_evento,$id_empa, $id_paciente, $gl_descripcion, $bo_estado,$bo_mostrar, $id_usuario_crea){
        
        $datos_evento['eventos_tipo']		= $tipo_evento;
		$datos_evento['id_empa']			= $id_empa;
		$datos_evento['id_paciente']		= $id_paciente;
		$datos_evento['gl_descripcion']		= $gl_descripcion;
		$datos_evento['bo_estado']			= $bo_estado;
		$datos_evento['bo_mostrar']			= $bo_mostrar;
		$datos_evento['id_usuario_crea']	= $id_usuario_crea;
		$ocultar							= $this->_DAOEvento->ocultarEventos($tipo_evento);
		$resp								= FALSE;

		if ($ocultar){
			$resp							= $this->_DAOEvento->insEvento($datos_evento);
		}
		return $resp;
    }
   
}