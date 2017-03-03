<?php

require_once (__DIR__ . "/Usuario.php");

/**
 * 
 */
Class Guardar_ModificarDatosUsuario extends Guardar_Usuario{
    /**
     * Guarda el usuario
     */
    public function guardar(){
        
        $session = New Zend_Session_Namespace("usuario_carpeta");
        $id = $session->id;
        
        $data = array("nombres"   => $this->_parametros["nombre"],
                      "apellidos" => $this->_parametros["apellido"],
                      "email"     	=> $this->_parametros["email"],
                      "gl_cargo"    => $this->_parametros["gl_cargo"],
                      "gl_localidad"=> $this->_parametros["gl_localidad"],
                      "gl_anexo"    => $this->_parametros["gl_anexo"],
                      "gl_celular"  => $this->_parametros["gl_celular"],
                      "id_region"   => $this->_parametros["region"]);

        $this->_DAOUsuarios->update($data, $id);
        $this->_eliminarOficinas($id);		
        $this->_ingresarOficinas($id);		
    }
}

