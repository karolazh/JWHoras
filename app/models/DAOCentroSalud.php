<?php

/**
*****************************************************************************
* Sistema           : PREVENCION DE FEMICIDIOS
* Descripcion       : Modelo para Tabla pre_centro_salud
* Plataforma        : !PHP
* Creacion          : 01/03/2017
* @name             DAOCentroSalud.php
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

class DAOCentroSalud extends Model{

    protected $_tabla           = "pre_centro_salud";
    protected $_primaria		= "id_centro_salud";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    public function getLista(){
        $query	= "SELECT * FROM ".$this->_tabla;
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
        $result	= $this->db->getQuery($query, $param);

        if($result->numRows>0){
            return $result->rows->row_0;
        }else{
            return NULL;
        }
    }

    /**
	 * Descripción : Obtiene centro de salud por Id
	 * @author  S/N
     * @param   int $id_servicio_salud
	 */
    public function getByIdServicio($id_servicio_salud){
        $query = "  SELECT * 
					FROM pre_centro_salud
					WHERE id_servicio_salud = ?";
						
		$param	= array($id_servicio_salud);
        $result	= $this->db->getQuery($query, $param);

        if($result->numRows>0){
            return $result->rows;
        }else{
            return NULL;
        }
    }

    /**
	 * Descripción : Obtiene centro de salud por Región
	 * @author  S/N
     * @param   int $id_region
	 */
    public function getByIdRegion($id_region) {
        $query = "  SELECT 
                        gl_nombre_establecimiento, 
                        id_centro_salud 
					FROM pre_centro_salud
					WHERE id_region = ?";

		$param	= array($id_region);
        $result	= $this->db->getQuery($query, $param);

        if($result->numRows>0){
            return $result->rows;
        }else{
            return NULL;
        }
    }

    /**
	 * Descripción : Obtiene centro de salud por Comuna
	 * @author  S/N
     * @param   int $id_comuna
	 */
    public function getByIdComuna($id_comuna) {
        $query = "  SELECT 
                        gl_nombre_establecimiento, 
                        id_centro_salud 
                    FROM pre_centro_salud 
                    WHERE id_comuna = ?";

		$param	= array($id_comuna);
        $result	= $this->db->getQuery($query, $param);

        if($result->numRows>0){
            return $result->rows;
        }else{
            return NULL;
        }
    }

    /**
	 * Descripción : Obtiene centros de salud Ordenados por Nombre
	 * @author  S/N
	 */
	public function getListaOrdenada(){
        $query = "  SELECT *
					FROM pre_centro_salud
					ORDER BY gl_nombre_establecimiento ASC";
        
        $result	= $this->db->getQuery($query);

        if($result->numRows>0){
            return $result->rows;
        }else{
            return NULL;
        }
    }
	
}

?>