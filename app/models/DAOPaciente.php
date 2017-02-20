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

class DAOPaciente extends Model{
    /**
     * @var string 
     */
    protected $_tabla = "tab_pacientes";
    protected $_primaria = "pac_id";
    
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Obtener Lista de * Pacientes
     */
    public function getListaPacientes(){
        $query = "select * from tab_pacientes";
        $resultado = $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
    /*
     * Obtener Paciente por Rut
     */
    public function getPaciente($rut_paciente){
        $query = "select * from tab_pacientes 
                  where pac_rut = ?";

        $consulta = $this->db->getQuery($query,array($rut_paciente));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
}