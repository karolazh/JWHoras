<?php

/**
* Cosof
* @author Carlos Ayala <carlos.ayala@cosof.cl>
*/
class DAOOficina extends Model{

    /**
     *
     * @var string 
     */
    protected $_tabla = "oficina";
    
    /**
     * 
     */
    function __construct(){
        parent::__construct();
    }

    public function listarPorUsuario($id_usuario){
        $query = $this->db->select("u.*")
                          ->from($this->_tabla . " u")
                          ->join("usuario_oficina o", "o.id_oficina = u.id")
                          ->whereAND("o.id_usuario" , $id_usuario)
                          ->orderBy("u.nombre");
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
            return $resultado->rows;
        } else{
            return NULL;
        }
    }
}