<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAORegistroMordedores.php
!Sistema 	  	: SIRAM
!Modulo 	  	: NA
!Descripcion  		: 
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carolina Zamora Hormazábal
!Creacion     		: 02/02/2017
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

class DAORegistroMordedores extends Model{
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Lista Incidentes
     */
    public function getListaIncidentes(){
        $query = $this->db->select("*")->from("tab_incidentes");
        $resultado = $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
    /*
     * Ver Incidente
     */
    public function getIncidentes($id_noticia){
        $query = "select * from tab_incidentes 
                  where inc_id = ?";

        $consulta = $this->db->getQuery($query,array($id_noticia));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }

    /*
     * Lista Regiones
     */
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
    
    /*
     * Inserta Región
     */
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
    
    /*
     * Lista Provincias
     */
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