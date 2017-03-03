<?php
	class Perfiles extends Controller{
		function __construct(){
			parent::__construct();
			$this->_DAOPerfil = $this->load->model("DAOPerfil");
			//$this->_DAOUsuarios = $this->load->model("DAOUsuarios");
			$this->smarty->addPluginsDir(APP_PATH . "views/templates/mantenedor_avanzados/plugins/");
		}

		public function index(){

		}

		public function NuevoPerfil(){
			$this->_display('avanzados/perfil.tpl');
		}

		public function nuevo_perfil(){
            $fecha_creacion = date("Y-m-d H:i:s");

            //Variables de asignacion al template
            $this->smarty->assign('fecha_creacion_controller', $fecha_creacion);
	        $this->_display('mantenedor_avanzados/nuevo_perfil.tpl');
	        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
	        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
	        $this->load->javascript(STATIC_FILES . 'js/plugins/typeahead/js/bootstrap-typeahead.min.js');
	        $this->load->javascript(STATIC_FILES . 'js/templates/perfiles/perfiles.js');
    	}

    	 //creada por BC
        public function guardarNuevoPerfil(){
            $session = New Zend_Session_Namespace("usuario_carpeta");
            $data = array();
            parse_str($_POST['data'], $data);

            $this->load->lib('Constantes', false);

            $json = array();
            $datos = $data;
            //$datos['fc_fecha_creacion'] =date('Y-m-d H:i:s');
            //$datos['estado'] ="";
            $insertar = $this->_DAOPerfil->insPerfil($datos);
                   
            if ($insertar) {
                    //$id_solicitud = $insertar;
                    $json['estado'] = true;
                    $json['mensaje'] = 'Perfil ingresado correctamente';
            }
            echo json_encode($json);
        }

        public function editar(){
            $this->_addJavascript(STATIC_FILES.'js/templates/perfiles/form.js');
            $DAOPerfil = $this->_DAOPerfil;
            $parametros = $this->request->getParametros();

            $this->smarty->assign("nuevo", false);
            
            $perfil = $DAOPerfil->getPerfilById($parametros[0]);
            

            if(!is_null($perfil)){
                          
                $this->smarty->assign("item", $perfil);

                $this->_display('mantenedor_avanzados/editar_perfil.tpl');

                $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
                $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
                $this->load->javascript('$(".datepicker").datepicker();');

                
            } else {
                throw new Exception("El perfil no existe");
            }
        }

        public function guardar(){
            header('Content-type: application/json');
            
            //$validar = $this->load->lib("Helpers/Validar/ModificarDatosSolicitud", true, "Validar_ModificarDatosSolicitud", $this->_request->getParams());
            //if($validar->isValid()){
                $guardar = $this->load->lib("Helpers/Guardar/ModificarPerfil", true, "Guardar_Perfil", $this->_request->getParams());
                $guardar->guardar();
            //}
            
            $salida = array("error"    => "",
                            "correcto" => "");
            
            $json = Zend_Json::encode($salida);
            echo $json;
        }
    }
?>