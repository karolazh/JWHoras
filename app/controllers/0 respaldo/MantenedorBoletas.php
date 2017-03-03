<?php

class MantenedorBoletas extends Controller{

    /**
     *
     * @var DAOUsuarios 
     */
    protected $_DAOUsuarios;
    
    /**
     *
     * @var DAOUsuariosSistema
     */
    protected $_DAOUsuariosSistema;
    
    /**
     *
     * @var DAOSistemas 
     */
    protected $_DAOSistemas;
    
    /**
     * Construct
     */
    function __construct(){
        parent::__construct();
        Acceso::set("ADMINISTRADOR");
        $this->_DAOUsuarios = $this->load->model("DAOUsuarios");
        $this->_DAOSistemas = $this->load->model("DAOSistemas");
        $this->_DAOUsuariosSistema = $this->load->model("DAOUsuariosSistema");
       // $this->smarty->addPluginsDir(APP_PATH . "views/templates/mantenedor_usuarios/plugins/");
    }
    
}