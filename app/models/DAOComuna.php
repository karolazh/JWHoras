<?php

class DAOComuna extends Model {

    protected $_tabla			= "pre_comunas";
    protected $_primaria		= "id_comuna";
    protected $_transaccional	= false;

    function __construct() {
        parent::__construct();
    }

    /*     * * 20170131 - Funcion obtiene datos de una comuna ** */
    public function getComuna($id_comuna) {
        $query	= "	SELECT * 
					FROM " . $this->_tabla . "
					WHERE id_comuna = ?";

		$params		= array($id_comuna);
        $consulta 	= $this->db->getQuery($query, $params);

        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }

    /*
     * 20170203 - Lista Comunas
     */
    public function getListaComunas($id_provincia) {
        $query	= "	SELECT * 
					FROM " . $this->_tabla . " 
					WHERE id_provincia = ?";

		$params		= array($id_provincia);
        $resultado	= $this->db->getQuery($query, $params);

        if ($resultado->numRows > 0) {
            return $resultado->rows;
        } else {
            return NULL;
        }
    }

	// Funcion debería llamarse getInfoComunaxID($id_comuna)
    public function getComunaRegion($id_comuna) {

        $query	= "	SELECT 
						c.id_comuna,
						c.gl_nombre_comuna,
						c.id_provincia,
						p.gl_nombre_provincia,
						r.id_region,
						r.gl_nombre_region
					FROM pre_comunas c
						LEFT JOIN pre_provincias p ON c.id_provincia = p.id_provincia
						LEFT JOIN pre_regiones r ON p.id_region = r.id_region
					WHERE c.id_comuna = ?";

		$params		= array($id_comuna);
        $consulta	= $this->db->getQuery($query, $params);

        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }

    public function obtCentroSaludporComuna($id_comuna) {
        $query	= "	SELECT 
						e.nombre_establecimiento, 
						e.id_establecimiento 
					FROM pre_establecimientos_salud e
						LEFT JOIN pre_comunas c ON c.id_comuna = e.id_comuna_establecimiento
					WHERE c.id_comuna = ?";

		$params		= array($id_comuna);
        return $this->db->getQuery($query, $params);
    }

}
