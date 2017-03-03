<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOPrevision.php
!Sistema 	  	: PREVENCIÓN
!Modulo 	  	: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: 
!Creacion     		: 16/02/2017
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

class DAOPrevision extends Model{

    protected $_tabla			= "pre_prevision";
    protected $_primaria		= "id_prevision";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    public function getPrevision($cod_prevision){
        $query	= "	SELECT
						gl_nombre_prevision 
					FROM pre_prevision
					WHERE id_prevision = ? ";

		$params		= array($cod_prevision);
        $consulta	= $this->db->getQuery($query,$params);

		if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
    
    public function getListaPrevision(){
		$query		= "SELECT * FROM pre_prevision";
        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
}