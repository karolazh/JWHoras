<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOEmpa.php
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

class DAOEmpa extends Model{
    /**
     * @var string 
     */
    protected $_tabla			= "pre_empa";
    protected $_primaria		= "emp_id";
    protected $_transaccional	= false;
    
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
    public function getListaEmpa(){
//        $query = $this->db->select("*")->from("tab_empa");
//        $resultado = $query->getResult();
        
        $query = "select * from tab_empa";
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
    public function getEmpa($id_empa){
        $query = "select * from tab_empa 
                  where emp_id = ?";

        $consulta = $this->db->getQuery($query,array($id_empa));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
}

?>