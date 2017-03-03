<?php

require_once (APP_PATH . 'models/DAOPerfil.php');

/**
 * Guardar usuario
 */
Class Guardar_Perfil{
    
    /**
     * array
     * @var array 
     */
    protected $_parametros = array();
    
    /**
     *
     * @var DAOUsuarios 
     */
    protected $_DAOPerfil;

     /* 
     * @param array $parametros
     */
    public function __construct($parametros) {
        $this->_DAOPerfil = New DAOPerfil();
        
        foreach($parametros as $key => $value){
            if(!is_array($value)){
                $this->_parametros[$key] = TRIM($value);
            } else {
                $this->_parametros[$key] = $value;
            }
        }
    }
    
    /**
     * Guarda el usuario
     */
    public function guardar(){
        
        $id_perfil = $this->_parametros["id_perfil"];
        $campo_id = "id";
        //$fecha_entrega = explode('/', $this->_parametros["fecha_entrega"]);
        //$fecha_entrega_final = $fecha_entrega[2] . '-' . $fecha_entrega[1] . '-' . $fecha_entrega[0];
        
        $data = array("nombre"       => $this->_parametros["nombre_perfil"],
                      "gl_descripcion"   => $this->_parametros["descripcion"]);
        
        $resultado = $this->_DAOPerfil->getPerfilById($id_perfil);
        if(!is_null($resultado)){      
            $this->_DAOPerfil->update($data, $id_perfil, $campo_id);
        }
    }
    
    /**
     * 
     * @param int $id
     */
    protected function _ingresarSistemas($id){
        if(isset($this->_parametros["sistemas"])){
            $sistemas = $this->_parametros["sistemas"];
            if(count($sistemas)>0){
                foreach($sistemas as $id_sistema){
                    $existe = $this->_DAOUsuariosSistema->getByUsuarioSistema($id, $id_sistema);
                    if(is_null($existe)){
                        $data = array("id_usuario" => $id,
                                      "id_sistema" => $id_sistema);
                        $this->_DAOUsuariosSistema->insert($data);
                    }
                }
            }
        }
    }
    
    /**
     * 
     * @param int $id
     */
    protected function _ingresarOficinas($id){
        if(isset($this->_parametros["oficinas"])){
            $oficinas = $this->_parametros["oficinas"];
            if(count($oficinas)>0){
                foreach($oficinas as $id_oficina){
                    $existe = $this->_DAOUsuariosOficina->getByUsuarioOficina($id, $id_oficina);
                    if(is_null($existe)){
                        $data = array("id_usuario" => $id,
                                      "id_oficina" => $id_oficina);
                        $this->_DAOUsuariosOficina->insert($data);
                    }
                }
            }
        }
    }
    
    
    /**
     * Elimina sistemas asociados al usuario
     * que no fueron seleccionados
     * @param int $id
     */
    protected function _eliminarSistemas($id){
        if(isset($this->_parametros["sistemas"])){
            $sistemas = $this->_parametros["sistemas"];
            if(count($sistemas)>0){
                $this->_DAOUsuariosSistema->deleteNotIn($sistemas, $id);
            }
        } else {
            $this->_DAOUsuariosSistema->deleteNotIn(array(), $id);
        }
    }
    
    /**
     * Elimina oficinas asociadas al usuario
     * que no fueron seleccionadas
     * @param int $id
     */
    protected function _eliminarOficinas($id){
        if(isset($this->_parametros["oficinas"])){
            $oficinas = $this->_parametros["oficinas"];
            if(count($oficinas)>0){
                $this->_DAOUsuariosOficina->deleteNotIn($oficinas, $id);
            }
        } else {
            $this->_DAOUsuariosOficina->deleteNotIn(array(), $id);
        }
    }
}

