<?php

class DAOTipoAUDIT extends Model{

    protected $_tabla			= "pre_tipo_audit";
    protected $_primaria		= "id_tipo_audit";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    public function getListaTipoAUDIT(){
        $query		= "	SELECT * FROM ".$this->_tabla;
        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getTipoAUDIT($audit){
        $query	= "	SELECT  * 
                                FROM ".$this->_tabla
					
                              ." WHERE ? BETWEEN nr_min AND nr_max";

	$consulta = $this->db->getQuery($query,array($audit));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }

}