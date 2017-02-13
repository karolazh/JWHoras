<?php

class DAOSistemas extends Model{

    /**
     *
     * @var string 
     */
    protected $_tabla = "sistema";
    
    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
    }
    
    /**
     * Lista 
     * @param int $id_usuario
     * @return array
     */
    function listarSistemasPorUsuario($id_usuario){
        $query = $this->db->select("u.*")
                          ->from($this->_tabla . " u")
                          ->join("usuario_sistema s", "s.id_sistema = u.id")
                          ->whereAND("s.id_usuario" , $id_usuario)
                          ->orderBy("upper(u.nombre)");
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
            return $resultado->rows;
        } else{
            return NULL;
        }
    }
}
