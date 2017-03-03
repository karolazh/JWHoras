<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOAdjuntosTipo.php
!Sistema 	  	: PREVENCIÓN
!Modulo 	  	: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carolina Zamora
!Creacion     		: 22/02/2017
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

class DAOAdjuntosTipo extends Model{

    protected $_tabla           = "pre_adjuntos_tipo";
    protected $_primaria	= "id_tipo_adjunto";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    /*
     * Lista tipos de adjuntos
     */
    public function getListaAdjuntosTipo(){
        $query		= "SELECT * FROM pre_adjuntos_tipo";
        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
}