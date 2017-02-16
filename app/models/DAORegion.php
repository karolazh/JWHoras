<?php

class DAORegion extends Model{

    /**
     * @var string 
     */
    protected $_tabla = "tab_regiones";
    protected $_primaria = "reg_id";
    
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
    public function getRegion($cod_region){
	$query = "select * from tab_regiones 
                  where reg_id = ?";

        $consulta = $this->db->getQuery($query,array($cod_region));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
    
    /*
     * 20170203 - Lista Regiones
     */
    public function getListaRegiones(){
        $query = $this->db->select("*")->from("tab_regiones");
        $resultado = $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
    public function obtComunasPorRegion($region){
            $query = "select comunas.com_nombre, comunas.com_id from tab_comunas comunas
                                    left join tab_provincias prov on comunas.com_pro_id = prov.pro_id
                                    left join tab_regiones reg on prov.pro_reg_id = reg.reg_id
                                    where reg.reg_id = ?";

            return $this->db->getQuery($query,array($region));
    }
}