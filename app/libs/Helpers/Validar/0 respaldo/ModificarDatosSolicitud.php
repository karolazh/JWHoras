<?php


require_once (__DIR__ . '/ModificarDatosSolicitud.php');

/**
 * Validar formulario de ingreso de usuario
 */
Class Validar_ModificarDatosSolicitud extends Validar_Solicitud{
    
     /**
     * Si es correcto o no
     * @return boolean
     */
    public function isValid(){
        $this->_validarVacio("nombre");
        $this->_validarVacio("apellido");
        
        $this->_validarVacio("email");
        $this->_validarEmail("email");
        return $this->getCorrecto();
    }
}

