<?php

class DAOPrevision extends Model{

    /**
     * @var string 
     */
    protected $_tabla = "tab_prevision";
    protected $_primaria = "prev_id";
    
    /**
     * @var boolean 
     */
    protected $_transaccional = false;
    
    /**
     * 
     */
    function __construct(){
        parent::__construct();
    }
    
    /*** 20170131 - Funcion obtiene datos de una comuna ***/
    public function getPrevision($cod_prevision){
        $query = "select "
                . "prev_nombre "
                . "from tab_prevision "
                . "where prev_id = ?";

        $consulta = $this->db->getQuery($query,array($cod_prevision));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }

}