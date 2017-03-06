<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_tipo_actividad_economica
* Plataforma	: !PHP
* Creacion		: 20/02/2017
* @name			DAOUsuario.php
* @version		1.0
* @author		David Gusmán <david.guzman@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOTipoActividadEconomica extends Model{

    protected $_tabla			= "pre_tipo_actividad_economica";
    protected $_primaria		= "id_actividad_economica";
    protected $_transaccional	= false;

    function __construct(){
        parent::__construct();
    }
    
    /*
     * 20170203 - Lista Regiones
     */
    public function getLista(){
        $query		= $this->db->select("*")->from($this->_tabla);
        $resultado	= $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getById($id){
        $query	= "	SELECT * FROM ".$this->_tabla."
					WHERE ".$this->_primaria." = ?";

		$param	= array($id);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return null;
        }
    }
    
    /*** 20170131 - Funcion obtiene datos de una región ***/
	/* USAR getById */
    public function getTipoActividadEconomica($id_actividad_economica){
		$query	= "	SELECT * 
					FROM ".$this->_tabla."
					WHERE id_actividad_economica = ?";

		$param	= array($id_actividad_economica);
        $result	= $this->db->getQuery($query,$param);
        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return null;
        }
    }
	
}

?>