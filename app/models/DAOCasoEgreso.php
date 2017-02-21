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
    /**
     * @var string 
     */
    protected $_tabla = "pre_casos_egreso";
    protected $_primaria = "id_caso_egreso";
    
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Lista Casos de Egreso
     */
    public function getListaCasoEgreso(){
        $query = "select * from pre_casos_egreso";
        $resultado = $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
    /*
     * Ver Caso de Egreso
     */
    public function getCasoEgreso($id_cas_egr){
        $query = "select * from pre_casos_egreso 
                  where id_caso_egreso = ?";

        $consulta = $this->db->getQuery($query,array($id_cas_egr));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
}