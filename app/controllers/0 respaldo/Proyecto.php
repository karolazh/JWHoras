<?php
	class Proyecto extends Controller{
		function __construct(){
			parent::__construct();
			$this->_DAOProyecto = $this->load->model("DAOProyecto");
			//$this->_DAOUsuarios = $this->load->model("DAOUsuarios");
			$this->smarty->addPluginsDir(APP_PATH . "views/templates/mantenedor_avanzados/grilla_proyecto/plugins/");
		}

		public function index(){
			$this->_display('avanzados/proyecto.tpl');

		}

		
		public function nuevo_proyecto(){
	        $this->smarty->assign("nuevo", true);
	        
	        $this->_display('mantenedor_avanzados/nuevo_proyecto.tpl');
	        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
	        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
	        $this->load->javascript(STATIC_FILES . 'js/plugins/typeahead/js/bootstrap-typeahead.min.js');
	        $this->load->javascript(STATIC_FILES . 'js/templates/proyectos/proyectos.js');
    	}

    	 //creada por BC
    	public function guardarNuevoProyecto(){
	        $session = New Zend_Session_Namespace("usuario_carpeta");
	        $data = array();
	        parse_str($_POST['data'], $data);

	        $this->load->lib('Constantes', false);

	        $json = array();
	        $datos = $data;
	        $datos['nr_estado'] =1;
	        $insertar = $this->_DAOProyecto->insProyecto($datos);
	               
	        if ($insertar) {
	                $id_solicitud = $insertar;
	                $json['estado'] = true;
	                $json['mensaje'] = 'Proyecto ingresado correctamente';
	        }
	        echo json_encode($json);
    	}

    	public function guardar(){
	        header('Content-type: application/json');
	        
	        //$validar = $this->load->lib("Helpers/Validar/ModificarDatosSolicitud", true, "Validar_ModificarDatosSolicitud", $this->_request->getParams());
	        //if($validar->isValid()){
	            $guardar = $this->load->lib("Helpers/Guardar/ModificarProyecto", true, "Guardar_Proyecto", $this->_request->getParams());
	            $guardar->guardar();
	        //}
	        
	        $salida = array("error"    => "",
	                        "correcto" => "");
	        
	        $json = Zend_Json::encode($salida);
	        echo $json;
	    }

	    public function editar(){
	        $this->_addJavascript(STATIC_FILES.'js/templates/proyectos/form.js');
	        $DAOProyecto = $this->_DAOProyecto;
	        $parametros = $this->request->getParametros();

	        $this->smarty->assign("nuevo", false);
	        
	        $proyecto = $DAOProyecto->getProyectoById($parametros[0]);
	        

	        if(!is_null($proyecto)){
	                      
	        	$this->smarty->assign("item", $proyecto);

	            $this->_display('mantenedor_avanzados/editar_proyecto.tpl');

	            $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
	            $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
	            $this->load->javascript('$(".datepicker").datepicker();');

	            
	        } else {
	            throw new Exception("El proyecto no existe");
	        }
    	}
	}
?>