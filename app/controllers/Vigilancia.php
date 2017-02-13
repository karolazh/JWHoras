<?php

/*
  !IniHeaderDoc
 * ****************************************************************************
  !NombreObjeto 		: Vigilancia.php
  !Sistema 	  	: SIRAM
  !Modulo 	  	: NA
  !Descripcion  		:
  !Plataforma   		: !PHP
  !Perfil       		:
  !Itinerado    		: NA
  !Uso          		: NA
  !Autor        		: Orlando Vázquez
  !Creacion     		: 02/02/2017
  !Retornos/Salidas 	: NA
  !OrigenReq        	: NA
  =============================================================================
  !Parametros 		: NA
  =============================================================================
  !Testing 		: NA
  =============================================================================
  !ControlCambio
  --------------
  !cVersion !cFecha   !cProgramador   !cDescripcion
  -----------------------------------------------------------------------------

  -----------------------------------------------------------------------------
 * ****************************************************************************
  !EndHeaderDoc
 */

//** clase OtrosRegistros ***//
class Vigilancia extends Controller {
    /*
     * Constructor
     */

    function __construct() {
        parent::__construct();
    }

    /*
     * Otros Registros
     */

    public function Vigilancia() {
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        $this->load->css(STATIC_FILES . 'template/plugins/datatables/jquery.dataTables.min.css');
        $this->load->css(STATIC_FILES . 'template/plugins/datatables/dataTables.bootstrap.css');
        $this->_display('Vigilancia/vigilancia.tpl');
    }

}
