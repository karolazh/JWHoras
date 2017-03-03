<?php

class DAOTipoIMC extends Model{

    protected $_tabla			= "pre_tipo_imc";
    protected $_primaria		= "id_tipo_imc";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    public function getListaTipoIMC(){
        $query		= "	SELECT * FROM pre_tipo_imc";
        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getTipoIMC($imc){
        $query	= "	SELECT  * 
                                FROM pre_tipo_imc
					
                                WHERE ? BETWEEN nr_min AND nr_max";

	$consulta = $this->db->getQuery($query,array($imc));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }

}