<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAONoticias.php
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

class DAONoticias extends Model{
    /**
     * @var string 
     */
    protected $_tabla = "tab_noticias";
    protected $_primaria = "not_id";
    
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Lista Noticias
     */
    public function getListaNoticias(){
        $query = $this->db->select("*")->from("tab_noticias");
        $resultado = $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
    /*
     * Ver Noticia
     */
    public function getNoticia($id_noticia){
        $query = "select * from tab_noticias 
                  where not_id = ?";

        $consulta = $this->db->getQuery($query,array($id_noticia));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
}

?>