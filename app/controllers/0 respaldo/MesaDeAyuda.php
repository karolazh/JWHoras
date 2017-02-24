<?php
//** clase MesaDeAyuda ***//
class MesaDeAyuda extends Controller{
    
    protected $_DAOUsuarios;

    /*
     * Constructor
     */
    function __construct(){
        parent::__construct();
        $this->_DAOUsuarios = $this->load->model("DAOUsuarios");
    }
    

    /*
     * Otros Registros
     */
    public function Inicio(){
        Acceso::redireccionUnlogged($this->smarty);
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        $this->smarty->assign("rut",$_SESSION['rut']);
        $this->_display('MesaDeAyuda/mesa_de_ayuda.tpl');
    }
    
}