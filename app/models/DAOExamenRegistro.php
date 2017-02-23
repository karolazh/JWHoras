<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOExamenRegistro.php
!Sistema 	  	: PREVENCIÓN
!Modulo 	  	: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carolina Zamora
!Creacion     		: 22/02/2017
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

class DAOExamenRegistro extends Model{

    protected $_tabla           = "pre_examen_registro";
    protected $_primaria	= "id_examen_registro";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    /*
     * Lista Exámenes (todos)
     */
    public function getListaExamenRegistro(){
        $query      = "SELECT * FROM pre_examen_registro";
        $resultado  = $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
    /*
     * Lista Exámenes (por registro)
     */
    public function getListaExamenRegistroxId($id_registro){
        $query	=   "SELECT
                        exr.id_examen_registro AS id_exr,
                        date_format(exr.fc_crea,'%d-%m-%Y') AS fc_crea,
                        exr.id_examen AS id_exa,
                        exa.gl_nombre_examen AS nombre_examen,
                        exr.id_laboratorio,
                        lab.gl_nombre_laboratorio AS nombre_laboratorio,
                        exr.gl_folio AS folio,
                        exr.gl_resultado AS resultado,
                        exr.id_empa AS id_empa
                    FROM pre_examen_registro exr
                    LEFT JOIN pre_examenes exa ON exa.id_examen = exr.id_examen
                    LEFT JOIN pre_laboratorios lab ON lab.id_laboratorio = exr.id_laboratorio 
                    WHERE exr.id_registro = ?
                    ORDER BY exr.fc_crea DESC";
        
        $params		= array($id_registro);
        $resultado	= $this->db->getQuery($query, $params);

        if ($resultado->numRows > 0) {
            return $resultado->rows;
        } else {
            return NULL;
        }
    }
}