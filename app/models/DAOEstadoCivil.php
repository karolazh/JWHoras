<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_tipo_estado_civil
* Plataforma	: !PHP
* Creacion		: 06/03/2017
* @name			DAOEstadoCivil.php
* @version		1.0
* @author		David Gusman <david.guzman@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*<orlando.vazquez@cosof.cl>	05-06-2017	Modificadas referencias a campos de la BD antigua
* 
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOEstadoCivil extends Model{

    protected $_tabla			= "pre_tipo_estado_civil";
    protected $_primaria		= "id_tipo_estado_civil";
    protected $_transaccional	= false;

    function __construct(){
        parent::__construct();
    }

    public function getLista(){
        $query	= "	SELECT * FROM ".$this->_tabla;
        $result	= $this->db->getQuery($query);

        if($result->numRows>0){
            return $result->rows;
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