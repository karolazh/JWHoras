<?php

/**
*****************************************************************************
* Sistema           : PREVENCION DE FEMICIDIOS
* Descripcion       : Modelo para Tabla pre_region
* Plataforma        : !PHP
* Creacion          : 25/02/2017
* @name             DAORegion.php
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

class DAORegion extends Model{

    protected $_tabla			= "pre_region";
    protected $_primaria		= "id_region";
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
            return NULL;
        }
    }

    /**
	 * Descripción : Obtiene detalle por Región
     * @author  S/N
     * @param   int $id_region
	 */
    public function getDetalleByIdRegion($id_region){
		$query	= "	SELECT 
						c.*,
						p.gl_nombre_provincia,
						r.gl_codigo_region,
						r.gl_nombre_region,
						r.gl_latitud,
						r.gl_longitud
					FROM pre_region r
                    LEFT JOIN pre_provincia p  ON r.id_region = p.id_region
                    LEFT JOIN pre_comuna c ON p.id_provincia = c.id_provincia
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