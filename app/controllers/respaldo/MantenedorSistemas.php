<?php

class MantenedorSistemas extends Controller{

    /**
     *
     * @var DAOSistemas 
     */
    protected $_DAOSistemas;
    
    /**
     * Constructor
     */
    function __construct(){
        
        parent::__construct();
        Acceso::set("ADMINISTRADOR");
        $this->_DAOSistemas = $this->load->model("DAOSistemas");       
        $this->smarty->addPluginsDir(APP_PATH . "views/templates/mantenedor_sistemas/plugins/");
    }
    
    /**
     * Index
     */
    function index(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");		
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);				
        $this->_display('mantenedor_sistemas/index.tpl');
    }
    
    /**
     * Nuevo
     */
    function nuevo(){
        $this->_addJavascript(STATIC_FILES.'js/templates/mantenedor_sistemas/form.js');
        $this->_display('mantenedor_sistemas/nuevo.tpl');
    }
    
    /**
     * Editar
     */
    function editar(){
        $this->_addJavascript(STATIC_FILES.'js/templates/mantenedor_sistemas/form.js');
        $parametros = $this->request->getParametros();

        $sistema = $this->_DAOSistemas->getById($parametros[0]);
        if(!is_null($sistema)){
            $this->smarty->assign("sistema", $sistema);
            $this->_display('mantenedor_sistemas/editar.tpl');
        } else {
            throw new Exception("El sistema no existe");
        }
    }
    
    /**
     * Guardar
     */
    function guardar(){
        header('Content-type: application/json');
        $id = $this->_request->getParam("id");
        
        $data = array("nombre" => $this->_request->getParam("nombre"),
                      "descripcion" => $this->_request->getParam("descripcion"),
                      "url_produccion" => $this->_request->getParam("url_produccion"),
                      "url_desarrollo" 	=> $this->_request->getParam("url_desarrollo"),
                      "gl_color" 		=> $this->_request->getParam("gl_color"),
                      "gl_icono" 		=> $this->_request->getParam("gl_icono"),
                      "gl_activo" 		=> $this->_request->getParam("gl_activo")
					  );
        
        
        
        $sistema = $this->_DAOSistemas->getById($id);
        if(!is_null($sistema)){
            $this->_DAOSistemas->update($data, $id);
        } else {
            $this->_DAOSistemas->insert($data);
        }
        
        $salida = array("error"    => array(),
                        "correcto" => true);
        
        $json = Zend_Json::encode($salida);
        echo $json;
    }
    
    
}

