<?php


class DAOEspecie extends Model{

    /**
     * @var string 
     */
    protected $_tabla = "tab_especies";
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
    public function getEspecie($id_esp){
	$query = "select * from tab_especies 
                  where esp_id = ?";

        $consulta = $this->db->getQuery($query,array($id_esp));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
    
    /*
     * 20170203 - Lista Patologias
     */
    public function getListaEspecies(){
        $query = $this->db->select("*")->from("tab_especies");
        $resultado = $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
}
