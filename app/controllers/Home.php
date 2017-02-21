<?php

require_once(APP_PATH . "libs/Helpers/View/Grid.php");

class Home extends Controller{

    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
        $this->smarty->addPluginsDir(APP_PATH . "views/templates/home/plugins/");        
        $this->_DAOUsuarios = $this->load->model("DAOUsuarios");       
    }

    public function index(){
        
    }

    /**
     * Inicio
     */
    public function dashboard(){
        Acceso::redireccionUnlogged($this->smarty);
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        $this->_display('home/dashboard.tpl');
    }
}

?>