<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOAdministracion.php
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

//clase DAOAdministracion
class DAOAdministracion extends Model{
    /**
     * Constructor
     */
	 
    //funcion construct
    function __construct()
    {
        parent::__construct();
    }

    //funcion sql getListaRegion lista regiones 
    public function getListaRegiones(){
        //$query = $this->db->select("id_region , nombre_region")->from("tbl_regiones");
        $query = $this->db->select("id , nombre")->from("region");
        $resultado = $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
    public function insRegion($datos){
        extract($datos);
        //$query = "insert into proyecto values(null,?,?,1,?)";
        $query = "insert into region values(?)";
        $parametros = array(//son lols nombres de los campos de texto de la vista
                            $nombre
                            //$nombre_proyecto,
                            //$descripcion,
                            //$cliente,
                            //$estado
        );

        if ($this->db->execQuery($query, $parametros)) {
            return $this->db->lastInsertId();

        } else {
            return null;
        }
    }
    
    //funcion sql getListaProvincias lista Provincias
    public function getListaProvincias(){
        $query = $this->db->select("id_provincia , nombre_provincias, id_region")->from("tbl_provincias");
        $resultado = $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
}

?>