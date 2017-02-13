<?php

require_once (__DIR__ . '/../Validar.php');

Class Validar_ActualizarPassword extends Validar{
    
    /**
     * Si es correcto o no
     * @return boolean
     */
    public function isValid(){
        $this->_validarVacio("password");
        $this->_validarVacio("password_repetido");

        if($this->_parametros["password"] != $this->_parametros["password_repetido"]){
            $this->_correcto = false;
            $this->_error["password_repetido"] = "El password no es igual";
        }
        
        return $this->getCorrecto();
    }
}

