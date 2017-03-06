<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: Regiones.php
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

class Regiones extends Controller{

	protected $_DAORegion;
	
	function __construct(){
		parent::__construct();
		
		$this->_DAORegion = $this->load->model('DAORegion');
        //$this->_DAOComuna = $this->load->model("DAOComuna");

	}

    public function cargarComunasPorRegion(){
            $region = $_POST['region'];
            //$daoRegion = $this->load->model('DAORegion');
            $comunas = $this->_DAORegion->getDetalleByIdRegion($region);
            $json = array();
            $i = 0;
            foreach($comunas as $comuna){
                    $json[$i]['id_comuna'] = $comuna->id_comuna;
                    $json[$i]['nombre_comuna'] = $comuna->gl_nombre_comuna;
                    $i++;
            }

            echo json_encode($json);
    }
	
}