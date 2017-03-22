<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_cie10_capitulo
* Plataforma	: !PHP
* Creacion		: 21/03/2017
* @name			DAOCie10Capitulo.php
* @version		1.0
* @author		David Guzmán <david.guzman@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*<david.guzman@cosof.cl>	21/03/2017	DAOCie10Capitulo
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOCie10Capitulo extends Model{

    protected $_tabla           = "pre_cie10_capitulo";
    protected $_primaria		= "id_capitulo";
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
	
	public function getDetalleByIdCapitulo($id_capitulo){
		$query	= "	SELECT 
						c2.*
					FROM pre_cie10_capitulo c1
						LEFT JOIN pre_cie10_seccion c2 ON c1.id_capitulo = c2.id_capitulo
					WHERE c1.id_capitulo = ?";

		$param	= array($id_capitulo);
        $resul	= $this->db->getQuery($query,$param);

        if($resul->numRows > 0){
            return $resul->rows;
        }else{
            return NULL;
        }
    }

}

?>