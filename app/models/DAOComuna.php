<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_comuna
* Plataforma	: !PHP
* Creacion		: 24/02/2017
* @name			DAOComuna.php
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

class DAOComuna extends Model {

    protected $_tabla			= "pre_comuna";
    protected $_primaria		= "id_comuna";
    protected $_transaccional	= false;

    function __construct() {
        parent::__construct();
    }

    public function getLista(){
        $query		= "	SELECT * FROM ".$this->_tabla;
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

		$param		= array($id);
        $resultado	= $this->db->getQuery($query,$param);
		
        if($resultado->numRows > 0){
            return $resultado->rows->row_0;
        }else{
            return null;
        }
    }

    public function getByIdProvincia($id_provincia) {
        $query		= "	SELECT * 
						FROM pre_comuna
						WHERE id_provincia = ?";

		$params		= array($id_provincia);
        $resultado	= $this->db->getQuery($query, $params);

        if($resultado->numRows > 0) {
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getInfoComunaxID($id_comuna) {
        $query		= "	SELECT 
							c.id_comuna,
							c.gl_nombre_comuna,
							c.id_provincia,
							p.gl_nombre_provincia,
							r.id_region,
							r.gl_nombre_region
						FROM pre_comuna c
							LEFT JOIN pre_provincia p ON c.id_provincia = p.id_provincia
							LEFT JOIN pre_region r ON p.id_region = r.id_region
						WHERE c.id_comuna = ?";

		$params		= array($id_comuna);
        $consulta	= $this->db->getQuery($query, $params);

        if($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }

}

?>
