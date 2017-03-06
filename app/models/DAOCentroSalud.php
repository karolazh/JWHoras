<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_centro_salud
* Plataforma	: !PHP
* Creacion		: 01/03/2017
* @name			DAOCentroSalud.php
* @version		1.0
* @author		Victor Retamal <victor.retamal@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOCentroSalud extends Model{

    protected $_tabla           = "pre_centro_salud";
    protected $_primaria		= "id_centro_salud";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    public function getLista(){
        $query		= "SELECT * FROM ".$this->_tabla;
        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getById($id){
        $query		= "	SELECT * FROM ".$this->_tabla."
						WHERE ".$this->_primaria." = ?";
						
		$params		= array($id);
        $resultado	= $this->db->getQuery($query, $params);

        if($resultado->numRows>0){
            return $resultado->rows->row_0;
        }else{
            return NULL;
        }
    }

    public function getByIdServicio($id_servicio_salud){
        $query		= "	SELECT * 
						FROM pre_centro_salud
						WHERE id_servicio_salud = ?";
						
		$params		= array($id_servicio_salud);
        $resultado	= $this->db->getQuery($query, $params);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getByIdRegion($id_region) {
        $query		= "	SELECT 
							gl_nombre_establecimiento, 
							id_centro_salud 
						FROM pre_centro_salud
						WHERE id_region = ?";

		$params		= array($id_region);
        $resultado	= $this->db->getQuery($query, $params);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getByIdComuna($id_comuna) {
        $query		= "	SELECT 
							gl_nombre_establecimiento, 
							id_centro_salud 
						FROM pre_centro_salud 
						WHERE id_comuna = ?";

		$params		= array($id_comuna);
        $resultado	= $this->db->getQuery($query, $params);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

}

?>