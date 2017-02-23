<?php

class DAOUsuariosSistema extends Model{

    /**
     *
     * @var string 
     */
    protected $_tabla = "usuario_sistema";
    
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
    public function getByUsuarioSistema($id_usuario, $id_sistema){
        $query = $this->db->select("s.*")
                          ->from($this->_tabla . " s")
                          ->whereAND("s.id_usuario", $id_usuario)
                          ->whereAND("s.id_sistema", $id_sistema);
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

