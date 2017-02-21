<?php

class DAORegion extends Model{

    /**
     * @var string 
     */
    protected $_tabla = "pre_regiones";

    protected $_primaria = "id_region";
    
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
	$query = "select * from ".$this->_tabla." 

                  where id_region = ?";

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
        $query = $this->db->select("*")->from($this->_tabla);
        $resultado = $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
    public function obtComunasPorRegion($region){
            $query = "select 
                       comunas.gl_nombre_comuna, 
                       comunas.id_comuna 
                       from pre_comunas comunas
                                    left join pre_provincias prov on comunas.id_provincia = prov.id_provincia
                                    left join pre_regiones reg on prov.id_region = reg.id_region
                         where reg.id_region = ?";

            return $this->db->getQuery($query,array($region));
    }
}