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
    protected $_tabla = "pre_prevision";
    protected $_primaria = "id_prevision";
    protected $_transaccional = false;
    /*
     * Constructor
     */
    
    function __construct()
    {
        parent::__construct();
    }

    public function getPrevision($cod_prevision){
        $query = "select "
                . "gl_nombre_prevision "
                . "from pre_prevision "
                . "where id_prevision = ?";

        $consulta = $this->db->getQuery($query,array($cod_prevision));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
    
    public function getListaPrevision(){
        $query = "select * from pre_prevision";
        $resultado = $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
}