<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: Solicitudes.php
!Sistema 	  		: Gestion Calidad
!Modulo 	  		: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carlos Escalona
!Creacion     		: 19/10/2016
!Retornos/Salidas 	: NA
!OrigenReq        	: NA
=============================================================================
!Parametros 		: NA 
=============================================================================
!Testing 			: NA
=============================================================================
!ControlCambio
--------------
!cVersion !cFecha   !cProgramador   !cDescripcion 
-----------------------------------------------------------------------------

-----------------------------------------------------------------------------
*****************************************************************************
!EndHeaderDoc 
*/

class Solicitudes extends Controller{
    
    protected $_DAOSolicitudes;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->_DAOUsuarios    = $this->load->model("DAOUsuarios");        
        $this->_DAOAdjuntos    = $this->load->model("DAOAdjuntos");
        $this->_DAOSolicitudes = $this->load->model("DAOSolicitudes");
        
        $this->smarty->addPluginsDir(APP_PATH . "views/templates/Solicitudes/Mantenedores/plugins/");
    }
   
//funcion para nuevo index	 
    public function index(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");        
        //$this->smarty->assign("id_usuario", $sesion->usuario);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);
	
        $arr = $this->_DAOSolicitudes->getSolicitudes($sesion->id);
	
	    $this->smarty->assign('arrResultado',$arr);
    
        //llamado al template
        $this->_display('Solicitudes/Mantenedores/index.tpl');
    }

//funcion para nuevo Solicitud		
    public function nuevo(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");        
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);

        $fecha_creacion = date("Y-m-d H:i:s");
        $this->smarty->assign('fecha_creacion', $fecha_creacion); 

        $estado_solicitudes   = $this->_DAOSolicitudes->getListaEstadoSolicitudes();
		$archivos_almacenados = $this->_DAOSolicitudes->getListaArchivos();
    
        $this->smarty->assign("estado_solicitudes", $estado_solicitudes);
		$this->smarty->assign("archivos_almacenados", $archivos_almacenados);

        //llamado al template
        $this->_display('Solicitudes/Mantenedores/form.tpl');

         //Js asignados al template
        $this->load->javascript(STATIC_FILES . 'js/templates/solicitudes/solicitudes.js');
    }

//funcion para guardarNuevaSolicitud 
    public function guardarNuevaSolicitud(){
        $session    = New Zend_Session_Namespace("usuario_carpeta");
        
        $data        = array();
        
        parse_str($_POST['data'], $data);
        $this->load->lib('Constantes', false);
        $json = array();

        $datos    = $data;

        $insertar_solicitud         = $this->_DAOSolicitudes->insSolicitud($datos);		
	
        if($insertar_solicitud){
			
			$data_2 = array('id_solicitud'      => $insertar_solicitud,
							'id_archivo'        => $datos['id_archivo'],
							'fc_fecha_creacion' => $datos['fecha_creacion'],
							'id_usuario'        => $datos['id_usuario']);
							
			$guardar = $this->_DAOSolicitudes->insSolicitudDetalle($data_2);				
			
			$json['estado'] = true;
			$json['mensaje'] = 'Solicitud N °' . $insertar_solicitud   . ' Creada<br>';
            }          
		echo json_encode($json);
    } 

//funcion para revisarSolicitud 
    public function revisarSolicitud(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
		$this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);

        $params              = $this->request->getParametros();
        $id_solicitud        = $params[0];	

        $estado_solicitudes  		  = $this->_DAOSolicitudes->getListaEstadoSolicitudes();		
        $revisar_solicitud   		  = $this->_DAOSolicitudes->getSolicitudetalle($id_solicitud);
		$revisar_solicitud_archivos   = $this->_DAOSolicitudes->getSolicitudetalleArchivos($id_solicitud);
		$archivos_almacenados 	      = $this->_DAOSolicitudes->getListaArchivos();		
		
		$this->smarty->assign('id_solicitud', $id_solicitud);
        $this->smarty->assign('arrResultado',  $revisar_solicitud);
        $this->smarty->assign('estado_solicitudes', $estado_solicitudes);
		$this->smarty->assign('revisar_solicitud_archivos', $revisar_solicitud_archivos);
		$this->smarty->assign('archivos_almacenados', $archivos_almacenados);
        
        //llamado al template
        $this->_display('Solicitudes/Mantenedores/editar_form.tpl');

        //Js asignados al template
        $this->load->javascript(STATIC_FILES . 'js/templates/solicitudes/Solicitudes.js');
     } 
	 
//funcion para actualizar solicitud
   public function updateSolicitud(){
        $session  = New Zend_Session_Namespace("usuario_carpeta");
        $data     = array();
     
        parse_str($_POST['data'], $data);

        $this->load->lib('Constantes', false);
        $json     = array();
		
        $datos    = $data;
		
		print_r($datos);
		exit();
		
		$datos['id_solicitud']     = $data['id_solicitud'];
		$datos['fecha_update']     = date('Y-m-d H:i:s');

	    $update                    = $this->_DAOSolicitudes->updateSolicitud($datos);
		
		if($update){
			$datos_archivo['id_solicitud']   = $update;
			$datos_archivo['id_archivo']     = $data['id_archivo'];			
			
			$update_archivo       			 = $this->_DAOSolicitudes->updateSolicitudArchivos($datos_archivo);							

			$json['estado'] = true;
			$json['mensaje'] = 'Solicitude N °' . $update   . ' actualizada<br>';
	 }    
	  echo json_encode($json);
   }	 
}
