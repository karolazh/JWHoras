<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOVacunas.php
!Sistema 	  	: SIRAM
!Modulo 	  	: NA
!Descripcion  		: 
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carolina Zamora Hormazábal
!Creacion     		: 03/02/2017
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

class DAOVacunas extends Model{
    /**
     * @var string 
     */
    protected $_tabla = "tab_vacunas";
    protected $_primaria = "vac_id";
    
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Lista Vacunas (todas)
     */
    public function getListaVacunas(){
        //$query = $this->db->select("*")->from("tab_vacunas");
        //$resultado = $query->getResult();
        
        $query = "select tu.usr_id, tu.usr_usuario, tu.usr_nombres, tu.usr_apellidos,
                         tc.com_nombre, tp.pro_nombre, tr.reg_nombre,
                         te.esp_nombre, ti.ins_nombre, tv.*
                  from tab_vacunas tv
                  inner join tab_usuarios tu on tv.vac_usr_id = tu.usr_id
                  left join tab_institucion ti on tu.usr_ins_id = ti.ins_id
                  left join tab_comunas tc on tv.vac_com_id = tc.com_id
                  left join tab_provincias tp on tc.com_pro_id = tp.pro_id
                  left join tab_regiones tr on tr.reg_id = tp.pro_reg_id
                  left join tab_especies te on tv.vac_esp_id = te.esp_id";
        
        $resultado = $this->db->getQuery($query);
        
        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
    /*
     * Lista Vacunas (filtro)
     */
    public function getListaVacunasFiltro($agno, $periodo, $comuna, $palabra){
        $query = "select * from tab_vacunas ";

        $consulta = $this->db->getQuery($query,array($agno));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
    
    /*
     * Ver Vacuna
     */
    public function getVacuna($id_vacuna){
        //$query = "select * from tab_vacunas 
        //          where vac_id = ?";
        $query = "select tu.usr_id, tu.usr_usuario, tu.usr_nombres, tu.usr_apellidos,
                         tc.com_nombre, tp.pro_nombre, tr.reg_nombre,
                         te.esp_nombre, ti.ins_nombre, tv.*
                  from tab_vacunas tv
                  inner join tab_usuarios tu on tv.vac_usr_id = tu.usr_id
                  left join tab_institucion ti on tu.usr_ins_id = ti.ins_id
                  left join tab_comunas tc on tv.vac_com_id = tc.com_id
                  left join tab_provincias tp on tc.com_pro_id = tp.pro_id
                  left join tab_regiones tr on tr.reg_id = tp.pro_reg_id
                  left join tab_especies te on tv.vac_esp_id = te.esp_id";

        $consulta = $this->db->getQuery($query,array($id_vacuna));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
}

?>