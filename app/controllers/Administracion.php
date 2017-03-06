<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: Administracion.php
!Sistema 	  		: PREVENCION DE FEMICIDIOS
!Modulo 	  		: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carolina Zamora <carolina.zamora@cosof.cl>
!Creacion     		: 14/02/2017
!Retornos/Salidas 	: NA
!OrigenReq        	: NA
=============================================================================
!Parametros 		: NA 
=============================================================================
!Testing 			: NA
=============================================================================
!ControlCambio
--------------
!cVersion !cFecha   !cProgramador   !cDescripcion 
-----------------------------------------------------------------------------

-----------------------------------------------------------------------------
*****************************************************************************
!EndHeaderDoc 
*/

//** clase Admnistracion ***//
class Administracion extends Controller{
	
    protected $_DAOAdministracion;

    //funcion construct
    function __construct(){
        parent::__construct();
        $this->_DAOAdministracion = $this->load->model("DAOAdministracion");
    }
    
    /*
     * Mantenedor de Noticias
     */
    public function perfiles(){
        Acceso::redireccionUnlogged($this->smarty);
        print_r("TODO // Administrador Perfiles");
    }

}