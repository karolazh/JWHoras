<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_provincia
* Plataforma	: !PHP
* Creacion		: 01/03/2017
* @name			DAOProvincia.php
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

class DAOProvincia extends Model{

    protected $_tabla			= "pre_provincia";
    protected $_primaria		= "id_provincia";
    protected $_transaccional	= false;

    function __construct(){
        parent::__construct();
    }

    public function getLista(){
        $query	= "	SELECT * FROM ".$this->_tabla;
        $resul	= $this->db->getQuery($query);

        if($resul->numRows>0){
            return $resul->rows;
        }else{
            return NULL;
        }
    }

    public function getById($id){
        $query	= "	SELECT * FROM ".$this->_tabla."
						WHERE ".$this->_primaria." = ?";

		$param	= array($id);
        $resul	= $this->db->getQuery($query,$param);
		
        if($resul->numRows > 0){
            return $resul->rows->row_0;
        }else{
            return null;
        }
    }

    public function getByIdRegion($id_region){
        $query	= "	SELECT * 
					FROM pre_provincia
					WHERE id_region = ?";

		$param	= array($id_region);
        $resul	= $this->db->getQuery($query,$params);

        if($resul->numRows>0){
            return $resul->rows;
        }else{
            return NULL;
        }
    }

}

?>