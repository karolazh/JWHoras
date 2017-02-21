<?php

class DAOInstitucion extends Model{

    /**
     *
     * @var string 
     */
    protected $_tabla = "pre_institucion";
    protected $_primaria = "id_institucion";
    
    /**
     *
     * @var boolean 
     */
    protected $_transaccional = false;
    
    /**
     * 
     */
    function __construct(){
            parent::__construct();
    }
        
    public function getInstitucion($id_institucion){
        $query = "select * from ".$this->_tabla. 
                  " where ".$this->_primaria." = ?";

        $consulta = $this->db->getQuery($query,array($id_institucion));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
}