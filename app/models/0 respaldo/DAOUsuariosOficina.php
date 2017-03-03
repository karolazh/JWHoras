<?php

class DAOUsuariosOficina extends Model{

    /**
     *
     * @var string 
     */
    protected $_tabla = "usuario_oficina";
    
    /**
     * Constructor
     */
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * 
     * @param int $id_usuario
     * @param int $id_sistema
     * @return array
     */
    public function getByUsuarioOficina($id_usuario, $id_oficina){
        $query = $this->db->select("s.*")
                          ->from($this->_tabla . " s")
                          ->whereAND("s.id_usuario", $id_usuario)
                          ->whereAND("s.id_oficina", $id_oficina);
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
            return $resultado->rows;
        } else {
            return NULL;
        }
    }
    /**
     * 
     * @param int $id_usuario
     * @return array
     */
    public function getUsuarioOficinas($id_usuario){
        $query = $this->db->select(	"s.* , oficina.nombre")
                          ->from($this->_tabla . " s")
                          ->join("oficina","oficina.id = s.id_oficina","INNER")
                          ->whereAND("s.id_usuario", $id_usuario);
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
            return $resultado->rows;
        } else {
            return NULL;
        }
    }	
    
    /**
     * Borra todos los registros que no existan en el arreglo
     * @param array $ids
     * @param int $id_usuario
     * @return 
     */
    public function deleteNotIn($ids, $id_usuario){
        $query = $this->db->select("s.*")
                          ->from($this->_tabla . " s")
                          ->whereAND("s.id_usuario", $id_usuario);
        
        if(count($ids)>0){
            $query->whereAND("s.id", $ids, "NOT IN");
        }
        
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
            foreach($resultado->rows as $usuario_sistema){
                $this->delete($usuario_sistema->id);
            }
        } else{
            return NULL;
        }
    }
    
}
