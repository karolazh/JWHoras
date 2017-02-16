<?php if(!defined('BASE_PATH')) exit('No se permite acceder a este script');

abstract class Controller
{
    protected $view;
    
    /**
     *
     * @var Loader 
     */
    protected $load;
    
    /**
     * Javascript agregado al template
     * @var string 
     */
    protected $js = "";
    
    /**
     * Css agregado al template
     * @var string 
     */
    protected $css = "";
    
    /**
     *
     * @var Smarty.class.php 
     */
    protected $smarty;
    
    /**
     *
     * @var Request 
     */
    protected $request;
    
    /**
     *
     * @var Zend_Controller_Request_Http
     */
    protected $_request;
    protected $xajax;
    protected $xajaxResponse;
    protected $_helper;

    public function __construct()
    {
        $this->_request = New Zend_Controller_Request_Http();

        //$this->view = new View(new Request);
        $this->request = new Request();
        $this->load = new Loader();
        
        $this->load->lib("Helpers/Acceso", false, "Acceso");
        $this->smarty = $this->load->lib('Smarty/Smarty.class',true,'Smarty');
        
        /* directorios de templates para smarty */
        $this->smarty->template_dir = array(APP_PATH . "views/templates",
                                            APP_PATH . "views"    );
        $this->smarty->compile_dir  = APP_PATH . "views/templates_c";
        $this->smarty->cache_dir    = APP_PATH . "views/cache";
        $this->smarty->config_dir   = APP_PATH . "views/configs";
        $this->smarty->plugins_dir  = array(APP_PATH . "libs/Smarty/plugins",
                                            APP_PATH . "libs/Smarty/sysplugins",
                                            APP_PATH . "views/plugins"
                                            );

        $this->smarty->assign('static', STATIC_FILES);
        $this->smarty->assign('base_url', BASE_URI);
        $this->smarty->assign('js', "");
        $this->smarty->error_reporting = E_ALL & ~E_NOTICE; 
        
        $request = new Zend_Controller_Request_Http();
        $myCookie = $request->getCookie('datos_usuario_carpeta');
        if(!is_null($myCookie)){
            $DAOUsuario = $this->load->model("DAOUsuarios");
            $usuario = $DAOUsuario->getById($myCookie);
            
            $session 			= New Zend_Session_Namespace("usuario_carpeta");
            //$session->id 		= $usuario->id;
            //$session->rut 		= $usuario->rut;
            //$session->usuario 	= $usuario->nombres." ".$usuario->apellidos;
            $session->id 		= $usuario->usr_id;
            $session->rut 		= $usuario->usr_rut;
            $session->usuario 	= $usuario->usr_nombres." ".$usuario->usr_apellidos;
        }
    }
        
    /**
     * Despliega el template
     * @param string $template
     * @param boolean $layout si se carga o no el layout
     */
    protected function _display($template, $layout = true){
        $this->smarty->assign("js", $this->js);
        $this->smarty->assign("css", $this->css);
        if($layout){
            $this->smarty->assign("content", $this->smarty->fetch($template));
            $this->smarty->display("template.tpl");
        } else {
            $this->smarty->display($template);
        }
    }
    
    /**
     * Añade javascript al templat
     * @param string $js
     */
    protected function _addJavascript($js){
        if(strpos($js,".js") !== false){
            $this->js .= '<script src="'.$js.'" type="text/javascript"></script>';    
        }else{
            $this->js .= '<script type="text/javascript">'.$js.'</script>';
        }
    }
    
    /**
     * Añade CSS
     * @param type $css
     */
    protected function _addCss($css){
        if(strpos($css,".css") !== false){
            $this->css .= '<link rel="stylesheet" type="text/css" href="'.$css.'" />';    
        }
    }

}