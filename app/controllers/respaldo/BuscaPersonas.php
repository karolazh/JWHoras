<?php

class BuscaPersonas extends Controller{
    
    /**
     *
     * @var DAOUsuarios 
     */
    protected $_DAOUsuarios;
    
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->_DAOUsuarios = $this->load->model("DAOUsuarios");
        $this->_DAOUsuariosOficina = $this->load->model("DAOUsuariosOficina");
        $this->smarty->addPluginsDir(APP_PATH . "views/templates/busca_personas/plugins/");
    }
    
    /**
     * Index
     */
    public function index(){
        $this->_addJavascript(STATIC_FILES.'js/plugins/waterfall/handlebars.js');
        $this->_addJavascript(STATIC_FILES.'js/plugins/waterfall/waterfall.min.js');
        $this->_addJavascript(STATIC_FILES.'js/templates/busca_personas/index.js');
        $this->_addJavascript(STATIC_FILES.'js/plugins/jquery.flip.min.js');
        
        $this->_display('busca_personas/index.tpl');
    }
    
    /**
     * Resultados de busqueda
     */
    public function buscar(){
        header('Content-type: application/json');
        
        $limit = array("comienzo"   => $this->_request->getParam("page")-1,
                       "resultados" => 20);
        
        $lista = $this->_DAOUsuarios->listarBusqueda($this->_request->getParams(), $limit);
        $resultados = array();
        $cantidad = 0;
        if(!is_null($lista)){
            foreach($lista as $usuario){
				$imagen = "images/personas/".substr($usuario->rut,0,-2).".jpg";
				if(file_exists("static/".$imagen)){
					$imagen =  "/images/personas/".substr($usuario->rut,0,-2).".jpg";
				}else{
					$imagen =  "/images/no-image.png";
				}					
                $resultados["result"][] = array("image" => STATIC_FILES.$imagen,
                                                "width" => "150",
                                                "id" => $usuario->id,
                                                "rut" => $usuario->rut,
                                                "nombre" => $usuario->nombres." ".$usuario->apellidos);
                $cantidad++;
            }
        }
        $resultados["total"] = $cantidad;
        
        echo Zend_Json_Encoder::encode($resultados);
    }
    public function detalleFuncionario(){

		$parametros = $this->request->getParametros();
		$rut = $parametros[0];
		
		//$datos_usuario = $this->_DAOUsuarios->getByRut($rut);
		//$datos_oficinas = $this->_DAOUsuariosOficina->getUsuarioOficinas($datos_usuario->id);
		
		//$imagen = "images/personas/".substr($datos_usuario->rut,0,-2).".jpg";
		/*
		if(file_exists("static/".$imagen)){
			$datos_usuario->direccionFoto =  STATIC_FILES."/images/personas/".substr($datos_usuario->rut,0,-2).".jpg";
		}else{
			$datos_usuario->direccionFoto =  STATIC_FILES."/images/no-image.png";
		}							
		*/
        //$this->smarty->assign('arrDatos',$datos_usuario);
        //$this->smarty->assign('arrOficinas',$datos_oficinas);
        $this->smarty->display('busca_personas/detalleFuncionario.tpl');
		
    }	
}

