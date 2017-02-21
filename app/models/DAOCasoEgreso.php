<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOCasoEgreso.php
!Sistema 	  	: PREVENCIÓN
!Modulo 	  	: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: David Guzman
!Creacion     		: 14/02/2017
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

class DAOCasoEgreso extends Model{

    protected $_tabla			= "pre_casos_egreso";
    protected $_primaria		= "id_caso_egreso";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    /*
     * Lista Casos de Egreso
     */
    public function getListaCasoEgreso(){
        $query		= "	SELECT * FROM pre_casos_egreso";
        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    /*
     * Ver Caso de Egreso
     */
    public function getCasoEgreso($id_caso_egreso){
        $query	= "	SELECT * 
					FROM pre_casos_egreso 
					WHERE id_caso_egreso = ?";

		$params		= array($id_caso_egreso);
        $consulta	= $this->db->getQuery($query,$params);

        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
}