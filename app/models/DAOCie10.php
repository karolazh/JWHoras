<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_cie10_4
* Plataforma	: !PHP
* Creacion		: 22/03/2017
* @name			DAOCie10.php
* @version		1.0
* @author		David Guzmán <david.guzman@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*<david.guzman@cosof.cl>	22/03/2017	DAOCie10
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOCie10 extends Model{

    protected $_tabla           = "pre_cie10_4";
    protected $_primaria		= "id_cie10";
    protected $_transaccional	= false;

    function __construct()
    {
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