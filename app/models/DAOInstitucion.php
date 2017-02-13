<?php

class DAOInstitucion extends Model{

    /**
     *
     * @var string 
     */
    protected $_tabla = "tab_institucion";
    
    /**
     *
     * @var boolean 
     */
    protected $_transaccional = false;
    
    /**
     * 
     */
    function __construct(){
            parent::__construct();
    }
        
}