<?php

class DAOComuna extends Model {

    /**
     * @var string 
     */
    protected $_tabla = "pre_comunas";
    protected $_primaria = "com_id";

    /**
     * @var boolean 
     */
    protected $_transaccional = false;

    /**
     * 
     */
    function __construct() {
        parent::__construct();
    }

    /*     * * 20170131 - Funcion obtiene datos de una comuna ** */

    public function getComuna($cod_comuna) {
        $query = "select * from "
                . $this->_tabla .
                " where id_comuna = ?";

        $consulta = $this->db->getQuery($query, array($cod_comuna));
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
        $query = "select * from "
                . $this->_tabla .
                " where com_pro_id = ?";

        $resultado = $this->db->getQuery($query, array($id_provincia));

        if ($resultado->numRows > 0) {
            return $resultado->rows;
        } else {
            return NULL;
        }
    }

    public function getComunaRegion($id_comuna) {
        $query = "select c.id_comuna, r.id_region from " .$this->_tabla.
                                   " left join pre_provincias p on c.id_provincia = p.id_provincia
                                    left join pre_regioens r on p.id_region = r.id_region
                                    where c.id_comuna = ?";

        $consulta = $this->db->getQuery($query, array($id_comuna));
        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }

    public function obtCentroSaludporComuna($comuna) {
        $query = "select e.nombre_establecimiento, e.id_establecimiento from tab_establecimientos_salud e
                                    left join tab_comunas c on c.com_id = e.comuna_establecimiento
                                    where c.com_id = ?";

        return $this->db->getQuery($query, array($comuna));
    }

}
