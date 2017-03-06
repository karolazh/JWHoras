<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_adjunto_tipo
* Plataforma	: !PHP
* Creacion		: 24/02/2017
* @name			DAOAdjuntoTipo.php
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

class DAOAdjuntoTipo extends Model{

    protected $_tabla           = "pre_adjunto_tipo";
    protected $_primaria		= "id_adjunto_tipo";
    protected $_transaccional	= false;

    function __construct()
    {
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
}

?>