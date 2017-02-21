<?php

class DAOComuna extends Model{

    /**
     * @var string 
     */
    protected $_tabla = "tab_comunas";
    protected $_primaria = "com_id";
    
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
    public function getComuna($cod_comuna){
        $query = "select * from tab_comunas 
                  where com_id = ?";

        $consulta = $this->db->getQuery($query,array($cod_comuna));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
    
    /*
     * 20170203 - Lista Comunas
     */
    public function getListaComunas($id_provincia){
        $query = "select * from tab_comunas 
                  where com_pro_id = ?";

        $resultado = $this->db->getQuery($query,array($id_provincia));
        
        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
     public function getComunaRegion($id_comuna){
            $query = "select c.com_id, r.id_region from tab_comunas c
                                    left join tab_provincias p on c.com_pro_id = p.pro_id
                                    left join tab_regiones r on p.pro_reg_id = r.id_region
                                    where c.com_id = ?";

                    $consulta = $this->db->getQuery($query,array($id_comuna));
                if($consulta->numRows > 0){
                    return $consulta->rows->row_0;
                }else{
                    return null;
                }
    }
        public function obtCentroSaludporComuna($comuna){
            $query = "select e.nombre_establecimiento, e.id_establecimiento from tab_establecimientos_salud e
                                    left join tab_comunas c on c.com_id = e.comuna_establecimiento
                                    where c.com_id = ?";

            return $this->db->getQuery($query,array($comuna));
    }
}