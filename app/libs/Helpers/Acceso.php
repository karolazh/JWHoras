<?php

require_once (APP_PATH . 'models/DAOPerfil.php');
require_once (APP_PATH . 'models/DAOUsuarios.php');

Class Acceso{
    
    /**
     *
     * @var DAOUsuarios 
     */
    protected $_DAOUsuarios;
    
    /**
     * Establece el control para acceder a un recurso
     * @param string $nombre_tipo_usuario
     */
    static public function set($nombre_tipo_usuario){
        
        $acceso = New Acceso();
        
        //valida el logeo
        if($nombre_tipo_usuario == "ALL"){
            $acceso->validarLogeo();
        }
        
        if($nombre_tipo_usuario == "ADMINISTRADOR"){
            $acceso->validarTipo(DAOPerfil::ADMINSTRADOR);
        }
    }
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->_DAOUsuarios = New DAOUsuarios();
    }
    
    /**
     * 
     * @param type $id_usuario_tipo
     */
    public function validarTipo($id_usuario_tipo){
       $usuario = $this->_getUsuario();
       if(!is_null($usuario)){
           if($usuario->id_perfil != $id_usuario_tipo){
               $this->_banear();
           }
       } else {
           $this->_banear();
       }
    }
    
    /**
     * 
     */
    public function validarLogeo(){
        $usuario = $this->_getUsuario();
        if(is_null($usuario)){
            $this->_banear();
        }
    }
    
    /**
     * Expulsar usuario
     */
    protected function _banear(){
        session_destroy();
        header("location: " .HOST. "index.php/Login/");
        die();
    }
    
    /**
     * 
     * @return array
     */
    protected function _getUsuario(){
        $session = New Zend_Session_Namespace("usuario_carpeta");
        $id_user = $session->id;
        //echo $id_user;
        return $this->_DAOUsuarios->getById($id_user);
    }
}

