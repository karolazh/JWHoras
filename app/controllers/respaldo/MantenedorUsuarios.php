<?php

class MantenedorUsuarios extends Controller{
    
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
        $this->smarty->addPluginsDir(APP_PATH . "views/templates/mantenedor_usuarios/plugins/");
    }
    
    /**
     * Index
     */
    public function index(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");		
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);		
        $this->_display('mantenedor_usuarios/index.tpl');
    }
    
    /**
     * 
     */
    public function nuevo(){
        $this->_addJavascript(STATIC_FILES.'js/templates/mantenedor_usuarios/form.js');
        
        $this->smarty->assign("nuevo", true);
        
        $this->_display('mantenedor_usuarios/nuevo.tpl');
    }
    
    /**
     * 
     * @throws Exception
     */
    public function editar(){
        $this->_addJavascript(STATIC_FILES.'js/templates/mantenedor_usuarios/form.js');
        $parametros = $this->request->getParametros();

        $this->smarty->assign("nuevo", false);
        
        $usuario = $this->_DAOUsuarios->getById($parametros[0]);
        if(!is_null($usuario)){
            
            //$sistemas = $this->_listaSistemasUsuario($usuario->id);
            //$oficinas = $this->_listaOficinasUsuario($usuario->id);
           /* $this->smarty->assign("region", $usuario->id_region);
            $this->smarty->assign("oficinas", $oficinas);
            $this->smarty->assign("sistemas", $sistemas);*/
            $this->smarty->assign("item", $usuario);
            $this->_display('mantenedor_usuarios/editar.tpl');
        } else {
            throw new Exception("El usuario no existe");
        }
    }
    
    /**
     * Guardar
     */
    public function guardar(){
        header('Content-type: application/json');
        
        $validar = $this->load->lib("Helpers/Validar/Usuario", true, "Validar_Usuario", $this->_request->getParams());
        if($validar->isValid()){
            $guardar = $this->load->lib("Helpers/Guardar/Usuario", true, "Guardar_Usuario", $this->_request->getParams());
            $guardar->guardar();
        }
        
        $salida = array("error"    => $validar->getErrores(),
                        "correcto" => $validar->getCorrecto());
        
        $json = Zend_Json::encode($salida);
        echo $json;
    }
    
    /**
     * 
     * @param int $id_usuario
     * @return array
     */
    protected function _listaSistemasUsuario($id_usuario){
        $sistemas = array();
        $lista_sistemas = $this->_DAOSistemas->listarSistemasPorUsuario($id_usuario);
        if(!is_null($lista_sistemas)){
            foreach($lista_sistemas as $row){
                $sistemas[] = $row->id;
            }
        }
        return $sistemas;
    }
    
    /**
     * 
     * @param type $id_usuario
     * @return type
     */
    protected function _listaOficinasUsuario($id_usuario){
        $oficina = array();
        $DAOOficina = $this->load->model("DAOOficina");
        $lista = $DAOOficina->listarPorUsuario($id_usuario);
        if(!is_null($lista)){
            foreach($lista as $row){
                $oficina[] = $row->id;
            }
        }
        return $oficina;
    }
}