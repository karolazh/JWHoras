<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: MantenedorPlanificacion.php
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

//clase Mantenedor Planificacion
class MantenedorPlanificacion extends Controller{
	
	protected $_DAOMantenedorPlanificacion;

//funcion construct
	function __construct(){
        parent::__construct();
        //Acceso::set("ADMINISTRADOR");
       $this->_DAOMantenedorPlanificacion = $this->load->model("DAOMantenedorPlanificacion");
	   $this->_DAORegiones                = $this->load->model("DAORegiones");
       $this->smarty->addPluginsDir(APP_PATH . "views/templates/MantenedorPlanificacion/Mantenedores/plugins/");
    }
	
//funcion index principal 
    public function index(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");        
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);

       //llamado al template
        $this->_display('MantenedorPlanificacion/Mantenedores/index.tpl');   
     }

//funcion nueva Actividad
     public function nuevaActividad(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");        
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);

		/*
		llamada al DAOMantenedorPlanificacion para consultas sql a funcion getListaRegion getListaTipoActividad   
		*/
        $Regiones         = $this->_DAOMantenedorPlanificacion->getListaRegion();
        $TipoActividad    = $this->_DAOMantenedorPlanificacion->getListaTipoActividad();
        
         //smarty 
		 $this->smarty->assign("Regiones",$Regiones);		
         $this->smarty->assign("TipoActividad",$TipoActividad);

		//llamado al template 
        $this->_display('MantenedorPlanificacion/Nuevo/NuevoActividad.tpl');

         //Js asignados al template
		 $this->load->javascript(STATIC_FILES . 'js/templates/MantenedorPlanificacion/regiones.js');
		 $this->load->javascript(STATIC_FILES . 'js/templates/MantenedorPlanificacion/MantenedorPlanificacion.js');
		  $this->load->javascript(STATIC_FILES . 'js/templates/MantenedorPlanificacion/enviar_invitacion.js');
    }

//funcion nueva guardar Nuevo Evento
    public function guardarNuevoEvento(){
        $session = New Zend_Session_Namespace("usuario_carpeta");

		//arreglos necesarios.
        $data          = array();
		$datos_usuario = array();
				
        parse_str($_POST['data'], $data);
        $this->load->lib('Constantes', false);
        $json = array();
		
        $datos                             = $data;
        $datos['fecha_creacion_actividad'] = date('Y-m-d H:i:s');
		
		
		$correos                           = explode(",", $data['invitacion']);
		$actividad                         = $data['actividad'];
			
		//llamada al _DAOMantenedorPlanificacion para consultas insEvento
        $insertar                          = $this->_DAOMantenedorPlanificacion->insEvento($datos);		
		
		if($insertar){		
			foreach($correos as $clave => $i){				
				$id_usuario  			 = $this->_DAOMantenedorPlanificacion->getListaUsuarios($i);				
				foreach($id_usuario->rows as $id_usuario){					
					//arreglo de datos de usuario.
					$datos_usuario['id_usuario']   = $id_usuario->id;
					$datos_usuario['id_actividad'] = $insertar;
					
					//inserta usuarios en la tabla tbl_actividad_usuario.
					$insertar_usuario    	 	 = $this->_DAOMantenedorPlanificacion->insUsuariosInvitacion($datos_usuario);
					
					//envia correos a los usuarios que se eingresaron en el campo de texto.
					//$enviar_email_invitacion     = $this->enviar_email_invitacion($i,$insertar,$actividad);
					
					//$correo,$insertar,$actividad
					
					$json['estado']  = true;
					$json['mensaje'] = 'Actividad N °' . $insertar . ' Agendado<br>';
					
					echo json_encode($json);
					
					if(!is_null($i)){
						$this->load->lib('Email', false);
						$remitente        = "midas@minsal.cl";
						$nombre_remitente =  "Gestión Calidad";
						$destinatario     = $i;
						//$url            = "";
						$asunto  = "GESTIÓN - Invitación";
						
						$mensaje =  "Estimado(a), <br><br>

									 Ud. ha sido invitado a la actividad : <br><br>
									
									 ".$actividad.", favor revise su bandeja de entrada.
									
									 Si usted no inicio este proceso, ignore este mensaje.<br><br>

									 Saludos,<br><br>

									 GESTIÓN CALIDAD";
							
						Email::sendEmail($destinatario, $remitente, $nombre_remitente, $asunto, $mensaje);		
					}
					
					
				}				
			}
			//$json['estado']  = true;
			//$json['mensaje'] = 'Actividad N °' . $insertar . ' Agendado<br>';
		}		
		//echo json_encode($json);
	}

//funcion para realizar el envio de los correos para la invitacion	
	function enviar_email_invitacion($correo,$insertar,$actividad){
        header('Content-type: application/json');	
					
        $email            = $correo;
		$nombre_actividad = $actividad;
        $correcto         = false;	
		$enviado          = 'si';
		
		if(!is_null($email)){
			$this->load->lib('Email', false);
			$remitente        = "midas@minsal.cl";
			$nombre_remitente =  "Gestión Calidad";
			$destinatario     = $email;
			//$url            = "";
			$asunto  = "GESTIÓN - Invitación";
			
			$mensaje =  "Estimado(a), <br><br>

						 Ud. ha sido invitado a la actividad : <br><br>
						
						 ".$nombre_actividad.", favor revise su bandeja de entrada.
						
						 Si usted no inicio este proceso, ignore este mensaje.<br><br>

						 Saludos,<br><br>

						 GESTIÓN CALIDAD";
				
			Email::sendEmail($destinatario, $remitente, $nombre_remitente, $asunto, $mensaje);		
        }
		//return $enviado;
    }

//funcion para cargar Comunas Por Region	
	public function cargarComunasPorRegion(){
		
		$region     = $_POST['region'];			
		$provincias = $this->_DAORegiones->obtProvinciasPorRegion($region);
		
		$json = array();
		$i = 0;
		
		foreach($provincias->rows as $provincias){				
			$json[$i]['id_provincia']      = $provincias->id_provincia;
			$json[$i]['nombre_provincias'] = $provincias->nombre_provincias;
			$i++;			
		}
		echo json_encode($json);
	}

//funcion para cargar Oficina Por Provincia	
	public function cargarOficinaPorProvincia(){
		
		$provincias = $_POST['provincias'];		
		$oficinas   = $this->_DAORegiones->obtOficinasPorProvincias($provincias);
		
		$json = array();
		$i = 0;
		
		foreach($oficinas->rows as $oficinas){				
			$json[$i]['id_oficina']      = $oficinas->id_oficina;
			$json[$i]['nombre_oficina']  = $oficinas->nombre_oficina;
			$i++;			
		}
		echo json_encode($json);
	}	
}