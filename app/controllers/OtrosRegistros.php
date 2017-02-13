<?php
/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: OtrosRegistros.php
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
*****************************************************************************
!EndHeaderDoc 
*/

//** clase OtrosRegistros ***//
class OtrosRegistros extends Controller{
	
    protected $_DAORegistroMordedores;
    /*
     * Constructor
     */
    function __construct(){
        parent::__construct();
        $this->_DAORegistroMordedores = $this->load->model("DAORegistroMordedores");
    }
    

    /*
     * Otros Registros
     */
    public function otrosRegistros(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        $this->load->css(STATIC_FILES . 'template/plugins/datatables/jquery.dataTables.min.css');
        $this->load->css(STATIC_FILES . 'template/plugins/datatables/dataTables.bootstrap.css');
        $this->_display('OtrosRegistros/otros_registros.tpl');
    }
    
    public function nuevo(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        $this->_display('OtrosRegistros/nuevo.tpl');
    }
}