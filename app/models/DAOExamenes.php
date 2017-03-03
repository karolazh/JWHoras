<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOExamenes.php
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

class DAOExamenes extends Model{

    protected $_tabla           = "pre_examenes";
    protected $_primaria	= "id_examen";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    /*
     * Lista tipos de adjuntos
     */
    public function getListaExamenes(){
        $query		= "SELECT * FROM pre_examenes";
        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
}