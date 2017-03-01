<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOEmpaAudit.php
!Sistema 	  	: PREVENCIÓN
!Modulo 	  	: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Orlando Vazquez
!Creacion     		: 28/02/2017
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

class DAOEmpaAudit extends Model{

    /**
     *
     * @var string 
     */
    protected $_tabla           = "pre_empa_audit";
    protected $_primaria		= "id_audit";
    protected $_transaccional	= false;

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Lista Adjuntos (todos)
     */
    public function getAuditByEMPA($id_empa){
        $query		= "SELECT 
						id_audit,
						id_empa,
						id_pregunta,
						nr_valor
						FROM pre_empa_audit 
						WHERE id_empa = ".$id_empa;
        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    

}

?>