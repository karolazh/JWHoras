<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOAlcoholismo.php
!Sistema 	  	: PREVENCIÓN
!Modulo 	  	: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Victor Retamal
!Creacion     		: 24/02/2017
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

class DAOAlcoholismo extends Model{

    /**
     *
     * @var string 
     */
    protected $_tabla           = "pre_cuestionario_alcoholismo";
    protected $_primaria		= "id_pregunta";
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
    public function getAll(){
        $query		= "SELECT * FROM pre_cuestionario_alcoholismo";
        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    

}

?>