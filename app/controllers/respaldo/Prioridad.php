<?php
	class Prioridad extends Controller{


		function __construct(){
			parent::__construct();
			$this->_DAOPerfil = $this->load->model("DAOPerfil");
			$this->_DAOPrioridad = $this->load->model("DAOPrioridad");
			$this->smarty->addPluginsDir(APP_PATH . "views/templates/mantenedor_avanzados/grilla_prioridad/plugins/");
		}

		public function index(){
			$this->_display('avanzados/prioridad.tpl');
		}

		public function nueva_prioridad(){
			$fecha_creacion = date("Y-m-d H:i:s");

	        //Variables de asignacion al template
       		$this->smarty->assign('fecha_creacion_controller', $fecha_creacion);
	        $this->smarty->assign("nuevo", true);
	        
	        $this->_display('mantenedor_avanzados/nueva_prioridad.tpl');
	        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
	        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
	        $this->load->javascript(STATIC_FILES . 'js/plugins/typeahead/js/bootstrap-typeahead.min.js');
	        $this->load->javascript(STATIC_FILES . 'js/templates/prioridades/prioridades.js');
    	}

    	public function guardarNuevaPrioridad(){
    		$session = New Zend_Session_Namespace("usuario_carpeta");
	        $data = array();
	        parse_str($_POST['data'], $data);

	        $this->load->lib('Constantes', false);

	        $json = array();
	        $datos = $data;
	        //$datos['fc_fecha_creacion'] =date('Y-m-d H:i:s');
	        //$datos['estado'] ="";
	        $insertar = $this->_DAOPrioridad->insPrioridad($datos);
	               
	        if ($insertar) {
	                //$id_solicitud = $insertar;
	                $json['estado'] = true;
	                $json['mensaje'] = 'Prioridad ingresada correctamente';
	        }
	        echo json_encode($json);
	    }

	    public function prioridadAEditar(){
	    $this->_addJavascript(STATIC_FILES.'js/templates/prioridades/form.js');
            $DAOPrioridad = $this->_DAOPrioridad;
            $parametros = $this->request->getParametros();

            $this->smarty->assign("nuevo", false);
            
            $prioridad = $DAOPrioridad->getPrioridadById($parametros[0]);
            

            if(!is_null($prioridad)){
                          
                $this->smarty->assign("item", $prioridad);

                $this->_display('mantenedor_avanzados/editar_prioridad.tpl');

                $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
                $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
                $this->load->javascript('$(".datepicker").datepicker();');

                
            } else {
                throw new Exception("La prioridad no existe");
            }
   		}

   		public function guardar(){
	        header('Content-type: application/json');
	        
	        //$validar = $this->load->lib("Helpers/Validar/Usuario", true, "Validar_Usuario", $this->_request->getParams());
	        //if($validar->isValid()){
	            $guardar = $this->load->lib("Helpers/Guardar/ModificarPrioridad", true, "Guardar_Prioridad", $this->_request->getParams());
	            $guardar->guardar();
	        //}
	        
	        $salida = array("error"    => '',
	                        "correcto" => '');
	        
	        $json = Zend_Json::encode($salida);
	        echo $json;
	    }
	}
?>