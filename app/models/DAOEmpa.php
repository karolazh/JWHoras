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
    
    /*
     * Ver Empa para Grilla
     */
    public function getEmpaGrilla($id_registro){
        $query =    "SELECT 
                        emp.id_empa AS id_empa,
                        emp.id_registro AS id_registro,
                        date_format(emp.fc_empa,'%d-%m-%Y') AS fc_empa,
                        reg.gl_rut AS rut,
                        com.gl_nombre_comuna AS comuna,
                        ins.gl_nombre AS institucion,
                        usr.gl_rut AS rut,
                        concat_ws(' ' , usr.gl_nombres, usr.gl_apellidos) AS funcionario
                    FROM pre_empa emp
                    LEFT JOIN pre_registro reg ON reg.id_registro = emp.id_registro
                    LEFT JOIN pre_comunas com ON com.id_comuna = emp.id_comuna
                    LEFT JOIN pre_institucion ins ON ins.id_institucion = emp.id_institucion
                    LEFT JOIN pre_usuarios usr ON usr.id_usuario = emp.id_usuario_crea
                    WHERE emp.id_registro =  ?
                    ORDER BY emp.fc_empa DESC";

        $consulta = $this->db->getQuery($query,array($id_registro));
        if($consulta->numRows > 0){
            return $consulta->rows;
        }else{
            return NULL;
        }
    }
}

?>