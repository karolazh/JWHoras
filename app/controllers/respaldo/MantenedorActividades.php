<?php
/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: MantenedorActividades.php
!Sistema 	  		: Gestion Calidad
!Modulo 	  		: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carlos Escalona
!Creacion     		: 09/11/2016
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

//clase Mantenedor Actividades
class MantenedorActividades extends Controller{

	protected $_DAOMantenedorActividades;

//funcion constructor	
	function __construct(){
        parent::__construct();
        //Acceso::set("ADMINISTRADOR");
       $this->_DAOMantenedorActividades = $this->load->model("DAOMantenedorActividades");
	   $this->_DAOArchivos              = $this->load->model("DAOArchivos");
       $this->smarty->addPluginsDir(APP_PATH . "views/templates/MantenedorActividades/Mantenedores/plugins/");
    }

//funcion index principal 	
    public function index(){
		//Sessiones
        $sesion = New Zend_Session_Namespace("usuario_carpeta");        
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);

		//llamada al _DAOMantenedorActividades para consultas sql a funcion getActividades
		$arr = $this->_DAOMantenedorActividades->getActividades($sesion->id);

		$this->smarty->assign('arrResultado', $arr);
		
       //llamado al template
        $this->_display('MantenedorActividades/Mantenedores/index.tpl');  
     }

//funcion para crear Invitacion actividad	 
	public function Invitacion_actividad(){
        $session = New Zend_Session_Namespace("usuario_carpeta");
		
		//request de los parametros
        $params         = $this->request->getParametros();
        $id_actividad   = $params[0];
		
       //llamado al template
        $this->smarty->display('MantenedorActividades/Nuevo/Invitacion_actividad.tpl');
    }
	
//funcion para revisar solicitud
    public function revisarActividad(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");        
        $this->smarty->assign("id_usuario", $sesion->id);
        
        if (isset($_SESSION['adjuntos']))
            unset($_SESSION['adjuntos']);
	
		//request de los parametros
        $params       = $this->request->getParametros();
        $id_actividad = $params[0];  

		//llamada al _DAOMantenedorActividades para consultas sql funcion getActividadesRevisar, getListaTipoRespuestas, getArchivosActividades 
		$revisar      			 = $this->_DAOMantenedorActividades->getActividadesRevisar($id_actividad);
		$respuestas      	     = $this->_DAOMantenedorActividades->getListaTipoRespuestas();
		$revisar_documentos      = $this->_DAOArchivos->getArchivosActividades($id_actividad);
				
		//smarty
		$this->smarty->assign("revisar", $revisar);
		$this->smarty->assign("respuestas", $respuestas);
		$this->smarty->assign("revisar_documentos", $revisar_documentos);
		$this->smarty->assign("id_actividad", $id_actividad);
		
		//llamado al template
        $this->_display('MantenedorActividades/Mantenedores/editar.tpl'); 

		//Js asignados al template
        $this->load->javascript(STATIC_FILES . 'js/templates/MantenedorActividades/MantenedorActividades.js');		
    }

//Funcion para adjuntar Archivo Nuevo
    public function adjuntarArchivoNuevo($mensaje = null){
        $params     = $this->request->getParametros();
            if(!is_null($mensaje)) {
				$this->smarty->assign('mensaje', $mensaje);
            } 
			
            //llamado al template          
            $this->smarty->display('MantenedorActividades/Nuevo/Adjuntar_archivo_nuevo.tpl');
    }
	
//Funcion cargar Grilla Adjuntos	
    public function cargarGrillaAdjuntos(){
        $arr = array();
        $i = 0;
		
        if (isset($_SESSION['adjuntos']) and count($_SESSION['adjuntos']) > 0) {
            foreach ($_SESSION['adjuntos'] as $item) {
                $arr[$i]['name']            = $item['name'];
                $arr[$i]['indice']          = $i;
                $arr[$i]['fecha']           = $item['fecha'];
                $arr[$i]['usuario']         = $item['usuario'];
                $arr[$i]['usuario_id']      = $item['usuario_id'];
                $arr[$i]['nombre_archivo']  = $item['nombre_archivo'];
                              
                $i++;
            }
        }
        $this->smarty->assign('adjuntos', $arr);

        //llamado al template
        $template = $this->smarty->fetch('MantenedorActividades/Nuevo/grilla_adjuntos.tpl');

        echo $template;
    }	
	
//funcion para subirArchivo
    public function subirArchivo(){
        $archivo         = $_FILES['archivo']; 
        $nombre_archivo  = $_POST['nombre_archivo'];       
        $error = false;

		//validacion de template de tpl Adjutar_archivo_nuevo.tpl
        if(empty($archivo["tmp_name"])){
            $error = true;
            $mensaje = '<div class="alert alert-danger text-center">Favor seleccionar archivo</div>';
        }else{
            $archivo['contenido'] = base64_encode(file_get_contents($archivo['tmp_name']));     

            if($nombre_archivo == ""){
                $error = true;
                $mensaje = '<div class="alert alert-danger text-center">Favor ingrese nombre archivo</div>';
            }

            if($archivo['tmp_name'] == null){
                $error = true;
                $mensaje = '<div class="alert alert-danger text-center">Seleccione archivo</div>';
            }

            if($archivo['error'] > 0){
                $error = true;
                $mensaje = '<div class="alert alert-danger text-center">Error al subir archivo</div>';
            }

            if($archivo['size'] == 0){
                $error = true;
                $mensaje = '<div class="alert alert-danger text-center">Archivo con peso 0</div>';
            }

            if(!$this->validarArchivo($archivo['type'])){
                $error = true;
                $mensaje = '<div class="alert alert-danger text-center">Tipo de Archivo no permitido aca</div>';
            }
        }
		
        if($error){
            $this->adjuntarArchivoNuevo($mensaje);
        }else{
            $this->load->lib('Fechas', false);
            $session                    = New Zend_Session_Namespace("usuario_carpeta");
            $archivo['usuario']         = $session->usuario;
            $archivo['usuario_id']      = $session->id;
            $archivo['fecha']           = date('d/m/Y H:i:s');
            $archivo['sha']             = sha1($archivo['name'] . uniqid());
            $archivo['nombre_archivo']  = $nombre_archivo;
            $_SESSION['adjuntos'][]     = $archivo;
            $mensaje                    = '<div class="alert alert-success text-center">Archivo adjuntado</div>';
            $this->adjuntarArchivoNuevo($mensaje);
            $this->load->javascript('parent.MantenedorActividades.cargarGrillaAdjuntos();');            
        }
    }
	
//Funcion  validar Archivo
    protected function validarArchivo($tipo){
		//tipo de formato que la aplicacion soporte
        $tipos = array(
            'application/pdf',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-excel',
            'application/msword'
        );

        if (in_array(trim($tipo), $tipos)) {
            return true;
        } else {
            return false;
        }
    }
	
//Funcion para borrar Adjunto
    public function borrarAdjunto(){
        $indice = $_POST['indice'];
        $i = 0;
        unset($_SESSION['adjuntos'][$indice]);

        $arr = $_SESSION['adjuntos'];
        unset($_SESSION['adjuntos']);
        foreach ($arr as $item) {
            $_SESSION['adjuntos'][] = $item;
        }
        $this->cargarGrillaAdjuntos();
    }
	
//Funcion para actualizar la actividad	
	public function modificarActividad(){
			$sesion = New Zend_Session_Namespace("usuario_carpeta");        
			$this->smarty->assign("id_usuario", $sesion->id);
			$this->smarty->assign("rut", $sesion->rut);
			$this->smarty->assign("usuario", $sesion->usuario);
			
			$data        = array();
			
			parse_str($_POST['data'], $data);
			
			$this->load->lib('Constantes', false);
			$json = array();

			$datos    = $data;		
			
			//fecha de guardado de la actividad 
			$datos['fc_fecha_respuesta'] = date('Y-m-d H:i:s');
			$datos['fecha_subida'] 		 = date('Y-m-d H:i:s');
			$datos['respondio']          = 'SI';
			$id_actividad          		 = $data['id_actividad'];
			
			//Guarda en tabla detalle actividad 
			$insertar_actividad_detalle = $this->_DAOMantenedorActividades->insActividad($datos);
			
		if($insertar_actividad_detalle){
				$id_insertar_detalle = $id_actividad;
				
					if(empty($_SESSION['adjuntos'])){
						$json['estado'] = true;
						$json['mensaje'] = 'Actividad °' . $id_insertar_detalle   . ' Actualizada<br>';
					}else{			
					//ver si tiene session de archivos
					if(isset($_SESSION['adjuntos']) and count($_SESSION['adjuntos'])){
								$_DAOMantenedorActividades = $this->load->model('DAOMantenedorActividades');
								$ruta = 'actividades/' . $id_insertar_detalle;
								
								if(!is_dir($ruta)){
									mkdir($ruta, 0777, true);
								}	
								
								foreach ($_SESSION['adjuntos'] as $item){
										$data = array('id_actividad'           => $id_insertar_detalle,
													  'usuario_id'             => $datos['id_usuario'],
													  'nombre'                 => $item['name'],
													  'nombre_archivo'         => $item['nombre_archivo'],
													  'fecha_subida'           => $datos['fecha_subida'],
													  'ruta'                   => $ruta,
													  'sha'                    => $item['sha'],
													  'mime'                   => $item['type']																									
										);
										
										$adjunto = fopen($ruta . '/' . $item['name'], 'w+b');
										fwrite($adjunto, base64_decode($item['contenido']));
										fclose($adjunto);

										if (is_file($ruta . '/' . $item['name']) and is_readable($ruta . '/' . $item['name'])){
											$guardar = $_DAOMantenedorActividades->insArchivoActividad($data);
										}   
								}
						$json['estado'] = true;
						$json['mensaje'] = 'Actividad °' . $id_insertar_detalle   . ' Actualizada<br>';
					}
				}			
			echo json_encode($json);
		}	
	}
	
//Funcion para ver Adjunto Carpeta	
    public function verAdjuntoActividades(){
        $params = $this->request->getParametros();
		
		if(isset($_SESSION['adjuntos'])){
            $adjunto = $_SESSION['adjuntos'][$params[0]];
            header('Content-Type: ' . $adjunto['type']);
            header('Content-Disposition: inline; filename="' . $adjunto['name'] . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            echo base64_decode($adjunto['contenido']);
            exit();
        }else{
            $id_documento = $params[0];
            $_DAOArchivos = $this->load->model('DAOArchivos');
            $adjunto = $_DAOArchivos->getArchivoPorIdDocumentoActividades($id_documento);
            $ruta = $adjunto->gl_ruta_archivo . '/' . $adjunto->gl_nombre_archivo;
            header('Content-Type: ' . $adjunto->gl_mime_archivo);
            header('Content-Disposition: inline; filename="' . $adjunto->gl_nombre_archivo . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            readfile($ruta);
            exit();
        }
    }
	
//funcion para modificacr la actividad  cuando ya esta modificada	
	public function modificarActividadModificada(){
			$sesion = New Zend_Session_Namespace("usuario_carpeta");        
			$this->smarty->assign("id_usuario", $sesion->id);
			$this->smarty->assign("rut", $sesion->rut);
			$this->smarty->assign("usuario", $sesion->usuario);
			
			$data        = array();
			
			parse_str($_POST['data'], $data);
			
			$this->load->lib('Constantes', false);
			$json = array();
			
			$id_actividad  	= $data['id_actividad'];

			$datos    = $data;	

			//fecha de guardado de la actividad 
			$datos['fecha_respuesta_actualizada'] = date('Y-m-d H:i:s');
			
			//Registros traidos desde el editar tpl de la actividad 
			$datos['id_usuario_modifica']         = $data['id_usuario'];
			$datos['id_actividad']                = $id_actividad;
			$datos['id_tipo_respuesta']           = $data['id_tipo_respuesta'];
			$datos['comentario'] 				  = $data['comentario'];
		
			//Actualiza en tabla detalle actividad 
			$actualizar_actividad_detalle = $this->_DAOMantenedorActividades->updateActividadDetalle($datos);
		
			if($actualizar_actividad_detalle){
				$json['estado'] = true;
				$json['mensaje'] = 'Actividad °' . $id_actividad   . ' Actualizada<br>';
				
				echo json_encode($json);				
			}
	}
}