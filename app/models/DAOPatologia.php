<?php

class DAOPatologia extends Model{

    /**
     * @var string 
     */
    protected $_tabla = "tab_patologias";
    protected $_primaria = "pat_id";
    
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
    
    /*** 20170131 - Funcion obtiene datos de una región ***/
    public function getPatologia($id_pat){
	$query = "select * from tab_patologias 
                  where pat_id = ?";

        $consulta = $this->db->getQuery($query,array($id_pat));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
    
    /*
     * 20170203 - Lista Patologias
     */
    public function getListaPatologias(){
        $query = $this->db->select("*")->from("tab_patologias");
        $resultado = $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
}