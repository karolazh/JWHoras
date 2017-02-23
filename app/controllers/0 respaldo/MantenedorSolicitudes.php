<?php

class MantenedorSolicitudes extends Controller{
    
    /**
     *
     * @var DAOUsuarios 
     */
    protected $_DAOUsuarios;
    protected $_DAOSolicitudes;
    
    /**
     * Construct
     */
    function __construct(){
        parent::__construct();
        Acceso::set("ADMINISTRADOR");
        $this->_DAOSolicitudes = $this->load->model("DAOSolicitudes");
        $this->smarty->addPluginsDir(APP_PATH . "views/templates/Solicitudes/Mantenedores/plugins/");
    }
    
    /**
     * Index
     */
    public function index(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");		
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);		
        $this->_display('Solicitudes/Mantenedores/index.tpl');
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
        $this->_addJavascript(STATIC_FILES.'js/templates/solicitudes/form.js');
        $DAOSolicitudes = $this->_DAOSolicitudes;
        $parametros = $this->request->getParametros();

        $this->smarty->assign("nuevo", false);
        
        $solicitud = $DAOSolicitudes->getSolicitudById($parametros[0]);
        $lista_trabajadores = $DAOSolicitudes->getListaTrabajadores();
        $prioridad = $DAOSolicitudes->getPrioridad();

        if(!is_null($solicitud)){
                      
            $fecha_creacion = $solicitud->fc_fecha_creacion;
            $fecha_entrega = $solicitud->fecha_entrega;
            $fc_fecha_creacion = date("d/m/Y", strtotime($fecha_creacion));
            $fc_fecha_entrega = date("d/m/Y", strtotime($fecha_entrega));

            $this->smarty->assign("solicitud", $solicitud);
            $this->smarty->assign("trabajadores", $lista_trabajadores);
            $this->smarty->assign("fc_fecha_entrega", $fc_fecha_entrega);
            $this->smarty->assign("fc_fecha_creacion", $fc_fecha_creacion);
            $this->smarty->assign("prioridad", $prioridad);

            $this->_display('Solicitudes/Mantenedores/editar.tpl');

            $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
            $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
            $this->load->javascript('$(".datepicker").datepicker();');

            
        } else {
            throw new Exception("La solicitud no existe");
        }
    }
    
    /**
     * Guardar
     */
    public function guardar(){
        header('Content-type: application/json');
        
        //$validar = $this->load->lib("Helpers/Validar/ModificarDatosSolicitud", true, "Validar_ModificarDatosSolicitud", $this->_request->getParams());
        //if($validar->isValid()){
            $guardar = $this->load->lib("Helpers/Guardar/ModificarSolicitud", true, "Guardar_Solicitud", $this->_request->getParams());
            $guardar->guardar();
        //}
        
        $salida = array("error"    => "",
                        "correcto" => "");
        
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