<?php

class DAOAdjuntos extends Model {

    /**
     *
     * @var string 
     */
    protected $_tabla = "pre_adjuntos";

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }

    public function getAdjuntoByRegistro($id_registro) {
        $query = "SELECT gl_path FROM ". $this->_tabla ." WHERE id_registro = ?";
        $params = array($id_registro);
        $resultado = $this->db->getQuery($query, $params);
        if ($resultado->numRows > 0) {
            return $resultado->rows->row_0;
        } else {
            return null;
        }
    }

    public function getTipos() {

        $query = $this->db->select("*")
                ->from("pre_adjuntos_tipo tipo");
        //->whereAND("u.rut" , $rut);

        $resultado = $query->getResult();
        if ($resultado->numRows > 0) {
            return $resultado->rows;
        } else {
            return NULL;
        }
    }

}

?>