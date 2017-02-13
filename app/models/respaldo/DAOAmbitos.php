<?php

class DAOAmbitos extends Model{

    /**
     *
     * @var string 
     */
    protected $_tabla = "ambito";
    
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
	
    public function getAmbitos(){
		
        $query = $this->db->select("*")
                          ->from($this->_tabla)
                          ->orderBy("upper(gl_nombre)");
                          //->whereAND("u.rut" , $rut);
        
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
            return $resultado->rows;
        } else{
            return NULL;
        }
    }		
        
}
