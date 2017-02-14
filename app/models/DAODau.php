<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAODau.php
!Sistema 	  	: PREVENCIÓN
!Modulo 	  	: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carolina Zamora Hormazábal
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

class DAODau extends Model{
    /**
     * @var string 
     */
    protected $_tabla = "tab_dau";
    protected $_primaria = "dau_id";
    
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Lista DAU
     */
    public function getListaDAU(){
        $query = $this->db->select("*")->from("tab_dau");
        $resultado = $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
    /*
     * Ver DAU
     */
    public function getDAU($id_dau){
        $query = "select * from tab_dau 
                  where dau_id = ?";

        $consulta = $this->db->getQuery($query,array($id_dau));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
}

?>