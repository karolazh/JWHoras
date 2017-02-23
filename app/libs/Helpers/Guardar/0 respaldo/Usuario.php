<?php

require_once (APP_PATH . 'models/DAOUsuarios.php');
require_once (APP_PATH . 'models/DAOUsuariosSistema.php');
require_once (APP_PATH . 'models/DAOUsuariosOficina.php');

/**
 * Guardar usuario
 */
Class Guardar_Usuario{
    
    /**
     * array
     * @var array 
     */
    protected $_parametros = array();
    
    /**
     *
     * @var DAOUsuarios 
     */
    protected $_DAOUsuarios;
    protected $_DAOPrioridad;
    
    /**
     *
     * @var DAOUsuariosSistema
     */
    protected $_DAOUsuariosSistema;
    
    /**
     *
     * @var DAOUsuariosOficina 
     */
    protected $_DAOUsuariosOficina;
    
    /**
     * 
     * @param array $parametros
     */
    public function __construct($parametros) {
        $this->_DAOUsuarios = New DAOUsuarios();
        $this->_DAOUsuariosSistema = New DAOUsuariosSistema();
        $this->_DAOUsuariosOficina = New DAOUsuariosOficina();
        
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
        
        $id = $this->_parametros["id"];
        
        $data = array("rut"       => $this->_parametros["rut"],
                      "nombres"   => $this->_parametros["nombre"],
                      "apellidos" => $this->_parametros["apellido"],
                      "email"     => $this->_parametros["email"],
                      "id_perfil" => $this->_parametros["perfil"],
                      "password"  => $this->_parametros["password"]);
        
        $resultado = $this->_DAOUsuarios->getById($id);
        if(!is_null($resultado)){
            
            if(trim($data["password"]) == ""){
                unset($data["password"]);
            } else {
                $data["password"] = sha1($data["password"]);
            }
            
            $this->_DAOUsuarios->update($data, $id);
            //$this->_eliminarSistemas($id);
            //$this->_eliminarOficinas($id);
        } else {
            $data["password"] = sha1($data["password"]);
            $id = $this->_DAOUsuarios->insert($data);
        }
        
        //$this->_ingresarSistemas($id);
        //$this->_ingresarOficinas($id);
    }

    public function guardarPrioridad(){
        
        $id = $this->_parametros["id"];
        
        $data = array("gl_descripcion"=> $this->_parametros["gl_descripcion"]);
        
        $resultado = $this->_DAOPrioridad->getByIdPropiedad($id);
        if(!is_null($resultado)){
            
           
            
            $this->_DAOPrioridad->update($data, $id);
            //$this->_eliminarSistemas($id);
            //$this->_eliminarOficinas($id);
        } else {
            //$data["password"] = sha1($data["password"]);
            //$id = $this->_DAOUsuarios->insert($data);
        }
        
        //$this->_ingresarSistemas($id);
        //$this->_ingresarOficinas($id);
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

