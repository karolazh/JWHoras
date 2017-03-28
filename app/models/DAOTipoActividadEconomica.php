<?php

/**
*****************************************************************************
* Sistema           : PREVENCION DE FEMICIDIOS
* Descripcion       : Modelo para Tabla pre_tipo_actividad_economica
* Plataforma        : !PHP
* Creacion          : 06/03/2017
* @name             DAOTipoActividadEconomica.php
* @version          1.0
* @author           David Gusmán <david.guzman@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*<david.guzman@cosof.cl>	07-03-2017	Cambio de clave primaria para que funcione correctamente
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
            return NULL;
        }
    }
	
}

?>