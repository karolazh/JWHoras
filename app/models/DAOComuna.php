<?php

/**
*****************************************************************************
* Sistema           : PREVENCION DE FEMICIDIOS
* Descripcion       : Modelo para Tabla pre_comuna
* Plataforma        : !PHP
* Creacion          : 24/02/2017
* @name             DAOComuna.php
* @version          1.0
* @author           Victor Retamal <victor.retamal@cosof.cl>
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

    /**
	 * Descripción : Obtiene Comunas por Id de Provincia
	 * @author  S/N
     * @param   int $id_provincia
	 */
    public function getByIdProvincia($id_provincia) {
        $query		= "	SELECT * 
						FROM pre_comuna
						WHERE id_provincia = ?";

		$param		= array($id_provincia);
        $result	= $this->db->getQuery($query, $param);

        if($result->numRows > 0) {
            return $result->rows;
        }else{
            return NULL;
        }
    }

    /**
	 * Descripción : Obtiene detalle por comuna por Id
	 * @author  S/N
     * @param   int $id_comuna
	 */
    public function getInfoComunaxID($id_comuna) {
        $query	= "	SELECT 
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

		$param	= array($id_comuna);
        $result	= $this->db->getQuery($query, $param);

        if($result->numRows > 0) {
            return $result->rows->row_0;
        }else{
            return NULL;
        }
    }

    /**
	 * Descripción : Obtiene Comunas por Id de Región
	 * @author  S/N
     * @param   int $id_region
	 */
	public function getComunasByIdRegion($id_region){
		$query	= "	SELECT c.*
					FROM pre_comuna c
                    LEFT JOIN pre_region r ON c.id_region = r.id_region
					WHERE c.id_region = ?";

		$param	= array($id_region);
        $resul	= $this->db->getQuery($query,$param);

        if($resul->numRows > 0){
            return $resul->rows;
        }else{
            return NULL;
        }
    }
	
}

?>