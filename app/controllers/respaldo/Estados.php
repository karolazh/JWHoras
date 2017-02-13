<?php
	class Estados extends Controller{
		function __construct(){
			parent::__construct();
			$this->_DAOPerfil = $this->load->model("DAOPerfil");
			$this->_DAOEstado = $this->load->model("DAOEstado");
			//$this->_DAOUsuarios = $this->load->model("DAOUsuarios");
			$this->smarty->addPluginsDir(APP_PATH . "views/templates/mantenedor_avanzados/grilla_estado/plugins/");
		}

		public function index(){
			$this->_display('avanzados/estados.tpl');
		}

		public function nuevo_estado(){
			$fecha_creacion = date("Y-m-d H:i:s");

	        //Variables de asignacion al template
       		$this->smarty->assign('fecha_creacion_controller', $fecha_creacion);
	        $this->_display('mantenedor_avanzados/nuevo_estado.tpl');
			$this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
	        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
	        $this->load->javascript(STATIC_FILES . 'js/plugins/typeahead/js/bootstrap-typeahead.min.js');
	        $this->load->javascript(STATIC_FILES . 'js/templates/estados/estados.js');    	}

    	public function guardarNuevoEstado(){
	        $session = New Zend_Session_Namespace("usuario_carpeta");
	        $data = array();
	        parse_str($_POST['data'], $data);

	        $this->load->lib('Constantes', false);

	        $json = array();
	        $datos = $data;
	        //$fecha_creacion = explode('/', $datos['fecha_creacion']);
        	//$datos['fecha_creacion'] = $fecha_creacion[2] . '-' . $fecha_creacion[1] . '-' . $fecha_creacion[0];
	        //$datos['estado'] ="";
	        $insertar = $this->_DAOEstado->insEstado($datos);
	               
	        if ($insertar) {
	                //$id_solicitud = $insertar;
	                $json['estado'] = true;
	                $json['mensaje'] = 'Estado ingresado correctamente';
	        }
	        echo json_encode($json);
	    }

	    public function editar(){
	        $this->_addJavascript(STATIC_FILES.'js/templates/estados/form.js');
	        $DAOEstado = $this->_DAOEstado;
	        $parametros = $this->request->getParametros();

	        $this->smarty->assign("nuevo", false);
	        
	        $estado = $DAOEstado->getEstadoById($parametros[0]);
	        

	        if(!is_null($estado)){
	                      
	        	$this->smarty->assign("item", $estado);

	            $this->_display('mantenedor_avanzados/editar_estado.tpl');

	            $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
	            $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
	            $this->load->javascript('$(".datepicker").datepicker();');

	            
	        } else {
	            throw new Exception("El estado no existe");
	        }
    	}

    	public function guardar(){
	        header('Content-type: application/json');
	        
	        //$validar = $this->load->lib("Helpers/Validar/ModificarDatosSolicitud", true, "Validar_ModificarDatosSolicitud", $this->_request->getParams());
	        //if($validar->isValid()){
	            $guardar = $this->load->lib("Helpers/Guardar/ModificarEstado", true, "Guardar_Estado", $this->_request->getParams());
	            $guardar->guardar();
	        //}
	        
	        $salida = array("error"    => "",
	                        "correcto" => "");
	        
	        $json = Zend_Json::encode($salida);
	        echo $json;
	    }
    
    


	}
?>