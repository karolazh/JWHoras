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
    /**
     * @var string 
     */
    protected $_tabla = "tab_prevision";
    protected $_primaria = "prev_id";
    
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Lista Empa (todos)
     */
    public function getListaPrevision(){
        $query = "select * from tab_prevision";
        $resultado = $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
    /*
     * Ver Empa
     */
    public function getPrevision($id_previ){
        $query = "select * from tab_prevision
                  where prev_id = ?";

        $consulta = $this->db->getQuery($query,array($id_previ));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
}