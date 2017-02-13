<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: MantenedorArchivos.php
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

//clase mantenedor archivos
class MantenedorArchivos extends Controller{


	protected $_DAOMantenedorArchivos;
    protected $_DAOArchivos;

//funcion constructor 	
	function __construct(){
        parent::__construct();
        //Acceso::set("ADMINISTRADOR");
        $this->_DAOMantenedorArchivos = $this->load->model("DAOMantenedorArchivos");
        $this->smarty->addPluginsDir(APP_PATH . "views/templates/MantenedorArchivos/Mantenedores/plugins/");
    }
	
//funcion index principal 
    public function index(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");        
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);

		//llamada al DAOMantenedorArchivos para consultas sql a funcion getSolicitudesAsignadas
        $arr = $this->_DAOMantenedorArchivos->getSolicitudesAsignadas();
        $this->smarty->assign('arrResultado', $arr);

        //llamado al template
        $this->_display('MantenedorArchivo/Mantenedores/index.tpl');       
    }
	
//funcion para crear nueva carpeta
	public function Nuevo(){
       $sesion = New Zend_Session_Namespace("usuario_carpeta"); 
               
        $this->smarty->assign("id_usuario", $sesion->id);

        if (isset($_SESSION['adjuntos'])) {
            unset($_SESSION['adjuntos']);
        }
		
		//llamada al DAOMantenedorArchivos para consultas sql
        $DAOMantenedorArchivos = $this->_DAOMantenedorArchivos;
       
        $fecha_creacion = date("Y-m-d");
        $this->smarty->assign('fecha_creacion_controller', $fecha_creacion);      

        //llamado al template
        $this->_display('MantenedorArchivo/Nuevo/nuevo.tpl');

        //Js asignados al template
        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
        $this->load->javascript(STATIC_FILES . 'js/plugins/typeahead/js/bootstrap-typeahead.min.js');
        $this->load->javascript(STATIC_FILES . 'js/templates/MantenedorArchivo/MantenedorArchivos.js');
        $this->load->javascript('$(".datepicker").datepicker();');
    }
	
//funcion para crear nueva subcarpeta
    public function crearsubcarpeta(){
       $sesion = New Zend_Session_Namespace("usuario_carpeta"); 

        $params             = $this->request->getParametros();
        $id_carpeta_archivo = $params[0]; 

		//smarty
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("id_carpeta_archivo", $id_carpeta_archivo);

        if (isset($_SESSION['adjuntos'])) {
            unset($_SESSION['adjuntos']);
        }
		
		//llamada al DAOMantenedorArchivos para consultas sql
        $DAOMantenedorArchivos = $this->_DAOMantenedorArchivos;
       
        $fecha_creacion = date("Y-m-d");
        $this->smarty->assign('fecha_creacion_controller', $fecha_creacion);      

        //llamado al template
        $this->_display('MantenedorArchivo/Nuevo/nuevo_sub_carpeta.tpl');

        //Js asignados al template
        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
        $this->load->javascript(STATIC_FILES . 'js/plugins/typeahead/js/bootstrap-typeahead.min.js');
        $this->load->javascript(STATIC_FILES . 'js/templates/MantenedorArchivo/MantenedorArchivos.js');
        $this->load->javascript('$(".datepicker").datepicker();');
    }

//funcion para ver bitacora de carpeta
    public function BitacoraCarpeta(){
        $session = New Zend_Session_Namespace("usuario_carpeta");

        $params             = $this->request->getParametros();
        $id_carpeta_archivo = $params[0];
       
	   //llamada al DAOMantenedorArchivos para consultas sql funcion getBitacora
        $arr = $this->_DAOMantenedorArchivos->getBitacora($id_carpeta_archivo);
		
		//smarty
        $this->smarty->assign('arrResultadoBitacora',$arr);

       //llamado al template
        $this->smarty->display('MantenedorArchivo/Grillas/bitacoraCarpeta.tpl');

         //Js asignados al template
        $this->load->javascript(STATIC_FILES . 'js/templates/MantenedorArchivo/MantenedorArchivos.js');
    }
	
//funcion para ver detalle de Carpeta
    public function verDetalleCarpeta(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");

        if (isset($_SESSION['adjuntos']))
            unset($_SESSION['adjuntos']);

        $params             = $this->request->getParametros();
        $id_carpeta_archivo = $params[0];

		//llamada al DAOMantenedorArchivos para consultas sql funcion getSolicitudById y getArchivosSolicitudArchivos	
        $revisar_carpeta = $this->_DAOMantenedorArchivos->getSolicitudById($id_carpeta_archivo);
        $revisar         = $this->_DAOMantenedorArchivos->getArchivosSolicitudArchivos($id_carpeta_archivo);

		//smarty
        $this->smarty->assign("revisar_carpeta", $revisar_carpeta);
        $this->smarty->assign("revisar", $revisar);
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("id_carpeta_archivo", $id_carpeta_archivo);
        $this->smarty->display('MantenedorArchivo/Mantenedores/verDetalleCarpeta.tpl');

         //Js asignados al template
        $this->load->javascript(STATIC_FILES . 'js/templates/MantenedorArchivo/MantenedorArchivos.js');
    }

//funcion para modificar Archivos 	
    public function ModificarArchivo(){
        $session = New Zend_Session_Namespace("usuario_carpeta");        

        $params       = $this->request->getParametros();
        $id_documento = $params[0];

		//llamada al DAOMantenedorArchivos para consultas sql funcion getArchivos y getListaEstadosArchivos
        $arr                   = $this->_DAOMantenedorArchivos->getArchivos($id_documento);
        $lista_estado_archivos = $this->_DAOMantenedorArchivos->getListaEstadosArchivos(); 
        $this->smarty->assign('arr', $arr);

        //llamado al template
         $this->smarty->assign("id_usuario", $session->id);
         $this->smarty->assign("lista_estado_archivos", $lista_estado_archivos);
         $this->smarty->display('MantenedorArchivo/Mantenedores/EditarArchivo.tpl');

         //Js asignados al template
        $this->load->javascript(STATIC_FILES . 'js/templates/MantenedorArchivo/MantenedorArchivos.js');
   } 

//funcion para ver Bitacora de la Version
   public function BitacoraVersion(){
        $session = New Zend_Session_Namespace("usuario_carpeta");        

        $params       = $this->request->getParametros();       
         
        if(!empty($params[0])){
          $id_documento = $params[0]; 
          $arr          = $this->_DAOMantenedorArchivos->getArchivosVersionados($id_documento);
          $this->smarty->assign('arr', $arr);
        }   

        //llamado al template
        $this->smarty->display('MantenedorArchivo/Mantenedores/BitacoraArchivo.tpl');

         //Js asignados al template
        $this->load->javascript(STATIC_FILES . 'js/templates/MantenedorArchivo/MantenedorArchivos.js');
   }

//funcion para actualizar archivo de la carpeta
   public function updateArchivoCarpeta(){
        $session  = New Zend_Session_Namespace("usuario_carpeta");
        $data     = array();
        $data2    = array();

        parse_str($_POST['data'], $data);

        $this->load->lib('Constantes', false);
        $json     = array();
        $datos    = $data;

        $datos['fecha_update']     = date('Y-m-d H:i:s');
        $update                    = $this->_DAOMantenedorArchivos->updArchivo($datos);

        $bitacora = $data2;
       
        if($update){
        //Guarda historial en tabla tbl_bitacora
            $id_usuario                         = $session->id;
            $bitacora['fecha_bitacora']         = date('Y-m-d H:i:s'); 
            $bitacora['id_usuario_bitacora']    = $id_usuario;
            $bitacora['nombre_evento_bitacora'] = 'Se Modifica archivo '. $data['nombre_archivo'];
            $bitacora['id_carpeta_archivo']     =  $data['cd_solicitud_fk_archivo'];
            $insertar                           = $this->_DAOMantenedorArchivos->insBitacora($bitacora);
            //fin Guarda historial en tabla tbl_bitacora
            $json['estado']                     = true;
            $json['mensaje']                    = 'Archivo Actualizado<br>';
                      
            echo json_encode($json);
        }
   }     

//funcion para revisar solicitud
     public function revisarSolicitud(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");

        if (isset($_SESSION['adjuntos']))
            unset($_SESSION['adjuntos']);

        $params             = $this->request->getParametros();
        $id_carpeta_archivo = $params[0];   

		//llamada al DAOMantenedorArchivos para consultas sql funcion getSolicitudById,getArchivosSolicitudArchivos,getSubCarpetas 
        $revisar_carpeta = $this->_DAOMantenedorArchivos->getSolicitudById($id_carpeta_archivo);
        $revisar         = $this->_DAOMantenedorArchivos->getArchivosSolicitudArchivos($id_carpeta_archivo);
        $arr             = $this->_DAOMantenedorArchivos->getSubCarpetas($id_carpeta_archivo);


		//smarty
        $this->smarty->assign('arrResultado', $arr);
        $this->smarty->assign("revisar_carpeta", $revisar_carpeta);
        $this->smarty->assign("revisar", $revisar);
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("id_carpeta_archivo", $id_carpeta_archivo);

        //llamado al template
        $this->_display('MantenedorArchivo/Mantenedores/editar.tpl');

        //Js asignados al template
        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
        $this->load->javascript(STATIC_FILES . 'js/plugins/typeahead/js/bootstrap-typeahead.min.js');
        $this->load->javascript(STATIC_FILES . 'js/templates/MantenedorArchivo/MantenedorArchivos.js');
        $this->load->javascript('$(".datepicker").datepicker();');

    }

//funcion para revisar subcarpeta
    public function revisarSubCarpeta(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");

        if (isset($_SESSION['adjuntos']))
            unset($_SESSION['adjuntos']);

        $params             = $this->request->getParametros();
        $id_carpeta_archivo = $params[0];

		//llamada al DAOMantenedorArchivos para consultas sql funcion getSolicitudById,getArchivosSolicitudArchivos,getSubCarpetas
        $revisar_carpeta = $this->_DAOMantenedorArchivos->getSolicitudById($id_carpeta_archivo);
        $revisar         = $this->_DAOMantenedorArchivos->getArchivosSolicitudArchivos($id_carpeta_archivo);
        $arr             = $this->_DAOMantenedorArchivos->getSubCarpetas($id_carpeta_archivo);

		//smarty
        $this->smarty->assign('arrResultado', $arr);
        $this->smarty->assign("revisar_carpeta", $revisar_carpeta);
        $this->smarty->assign("revisar", $revisar);
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("id_carpeta_archivo", $id_carpeta_archivo);

        //llamado al template
        $this->_display('MantenedorArchivo/Mantenedores/editarSubCarpeta.tpl');

        //Js asignados al template
        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
        $this->load->javascript(STATIC_FILES . 'js/plugins/typeahead/js/bootstrap-typeahead.min.js');
        $this->load->javascript(STATIC_FILES . 'js/templates/MantenedorArchivo/MantenedorArchivos.js');
        $this->load->javascript('$(".datepicker").datepicker();');

    } 
	
//funcion para subirArchivo
    public function subirArchivo(){
        $archivo         = $_FILES['archivo']; 
        $nombre_archivo  = $_POST['nombre_archivo'];       
        $error = false;

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
            $this->adjuntarArchivo($mensaje);
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
            $this->adjuntarArchivo($mensaje);
            $this->load->javascript('parent.MantenedorArchivos.cargarGrillaAdjuntos();');            
        }
    }

//funcion para subirArchivoNuevo
    public function subirArchivoNuevo(){
        $archivo         = $_FILES['archivo'];
        $nombre_archivo  = $_POST['nombre_archivo'];       
        $error = false;

        if(empty($archivo["tmp_name"])){
            $error = true;
            $mensaje = '<div class="alert alert-danger text-center">Favor seleccionar archivo</div>';
        }else{
            $archivo['contenido'] = base64_encode(file_get_contents($archivo['tmp_name']));     

            if($nombre_archivo == ""){
                $error = true;
                $mensaje = '<div class="alert alert-danger text-center">Favor ingrese nombre archivo</div>';
            }

            if($archivo['tmp_name'] == ""){
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

            if(empty($archivo['contenido'])){
                $error = true;
                $mensaje = '<div class="alert alert-danger text-center">Archivo sin contenido</div>';
            }

            if(!$this->validarArchivo($archivo['type'])){
                $error = true;
                $mensaje = '<div class="alert alert-danger text-center">Tipo de Archivo no permitido aca</div>';
            }
        }

        if ($error){
            $this->adjuntarArchivoNuevo($mensaje);
        } else {
            $this->load->lib('Fechas', false);
            $session                    = New Zend_Session_Namespace("usuario_carpeta");

            $archivo['usuario']         = $session->usuario;
            $archivo['usuario_id']      = $session->id;
            $archivo['fecha']           = date('d/m/Y H:i:s');
            $archivo['sha']             = sha1($archivo['name'] . uniqid());
            $archivo['nombre_archivo']  = $nombre_archivo;
            $_SESSION['adjuntos'][]     = $archivo;
            $mensaje                    = '<div class="alert alert-success text-center">Archivo nuevo adjuntado</div>';
            $this->adjuntarArchivoNuevo($mensaje);
            $this->load->javascript('parent.MantenedorArchivos.cargarGrillaAdjuntosNuevos();');            
        }
    }

//subir Archivo Nuevo Versionado
	public function subirArchivoNuevoVersionado(){
        $archivo                  = $_FILES['archivo'];
        $nombre_archivo           = $_POST['nombre_archivo'];
        $id_archivo               = $_POST['id_archivo'];
        $id_archivo_relacionado   = $_POST['id_archivo_relacionado'];
        $version                  = $_POST['version'];
        $error 					  = false;

        if(empty($archivo["tmp_name"])){
            $error = true;
            $mensaje = '<div class="alert alert-danger text-center">Favor seleccionar archivo</div>';
        }else{
            $archivo['contenido'] = base64_encode(file_get_contents($archivo['tmp_name']));     

            if($nombre_archivo == ""){
                $error = true;
                $mensaje = '<div class="alert alert-danger text-center">Favor ingrese nombre archivo</div>';
            }

            if($archivo['tmp_name'] == ""){
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

            if(empty($archivo['contenido'])){
                $error = true;
                $mensaje = '<div class="alert alert-danger text-center">Archivo sin contenido</div>';
            }

            if(!$this->validarArchivo($archivo['type'])){
                $error = true;
                $mensaje = '<div class="alert alert-danger text-center">Tipo de Archivo no permitido aca</div>';
            }
        }

        if($error){
            $this->adjuntarArchivoNuevoVersion($mensaje);
        }else{
            $this->load->lib('Fechas', false);
            $session                           = New Zend_Session_Namespace("usuario_carpeta");
            $archivo['id_archivo_relacionado'] = $id_archivo_relacionado;
            $archivo['id_archivo']             = $id_archivo;
            $archivo['usuario']                = $session->usuario;
            $archivo['usuario_id']             = $session->id;
            $archivo['fecha']                  = date('d/m/Y H:i:s');
            $archivo['sha']                    = sha1($archivo['name'] . uniqid());
            $archivo['nombre_archivo']         = $nombre_archivo;
            $archivo['version']                = $version;
            $_SESSION['adjuntos'][]            = $archivo;
            $mensaje                           = '<div class="alert alert-success text-center">Archivo nuevo adjuntado</div>';
            $this->adjuntarArchivoNuevoVersion($mensaje);
            $this->load->javascript('parent.MantenedorArchivos.cargarGrillaAdjuntosNuevosVersionado();');            
        }
    }

//subir subir Archivo Nuevo subcarpeta	
    public function subirArchivoNuevosubcarpeta(){
        $archivo         = $_FILES['archivo'];
        $nombre_archivo  = $_POST['nombre_archivo'];       
        $error           = false;

        if(empty($archivo["tmp_name"])){
            $error = true;
            $mensaje = '<div class="alert alert-danger text-center">Favor seleccionar archivo</div>';
        }else{
            $archivo['contenido'] = base64_encode(file_get_contents($archivo['tmp_name']));     

            if($nombre_archivo == ""){
                $error = true;
                $mensaje = '<div class="alert alert-danger text-center">Favor ingrese nombre archivo sub carpeta</div>';
            }

            if($archivo['tmp_name'] == ""){
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

            if(empty($archivo['contenido'])){
                $error = true;
                $mensaje = '<div class="alert alert-danger text-center">Archivo sin contenido</div>';
            }

            if(!$this->validarArchivo($archivo['type'])){
                $error = true;
                $mensaje = '<div class="alert alert-danger text-center">Tipo de Archivo no permitido aca</div>';
            }
        }

        if($error){
            $this->adjuntarArchivoNuevoSubCarpeta($mensaje);
        }else{
            $this->load->lib('Fechas', false);
            $session = New Zend_Session_Namespace("usuario_carpeta");

            $archivo['usuario']         = $session->usuario;
            $archivo['usuario_id']      = $session->id;
            $archivo['fecha']           = date('d/m/Y H:i:s');
            $archivo['sha']             = sha1($archivo['name'] . uniqid());
            $archivo['nombre_archivo']  = $nombre_archivo;
            $_SESSION['adjuntos'][]     = $archivo;

            $mensaje                    = '<div class="alert alert-success text-center">Archivo nuevo adjuntado a sub Carpeta</div>';
            $this->adjuntarArchivoNuevoSubCarpeta($mensaje);
            $this->load->javascript('parent.MantenedorArchivos.cargarGrillaAdjuntosNuevosSubCarpetas();');            
        }
    }
	
//Funcion  validar Archivo
    protected function validarArchivo($tipo){
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
        $template = $this->smarty->fetch('MantenedorArchivo/Nuevo/grilla_adjuntos.tpl');

        echo $template;
    }

//Funcion cargar Grilla Adjuntos Nuevos	
    public function cargarGrillaAdjuntosNuevos(){
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
		//smarty
        $this->smarty->assign('adjuntos', $arr);

        //llamado al template
        $template = $this->smarty->fetch('MantenedorArchivo/Nuevo/grilla_adjuntos_nuevos.tpl');

        echo $template;
    }

//Funcion cargar Grilla Adjuntos Nuevos SubCarpetas		
    public function cargarGrillaAdjuntosNuevosSubCarpetas(){
        $arr = array();
        $i = 0;
        if (isset($_SESSION['adjuntos']) and count($_SESSION['adjuntos']) > 0) {
            foreach ($_SESSION['adjuntos'] as $item) {
                $arr[$i]['name']           = $item['name'];
                $arr[$i]['indice']         = $i;
                $arr[$i]['fecha']          = $item['fecha'];
                $arr[$i]['usuario']        = $item['usuario'];
                $arr[$i]['usuario_id']     = $item['usuario_id'];
                $arr[$i]['nombre_archivo'] = $item['nombre_archivo'];
                              
                $i++;
            }
        }
		
		//smarty
        $this->smarty->assign('adjuntos', $arr);

        //llamado al template
        $template = $this->smarty->fetch('MantenedorArchivo/Nuevo/grilla_adjuntos_nuevos_sub_carpetas.tpl');

        echo $template;
    }

//Funcion cargar Grilla Adjuntos Nuevos Versionado
    public function cargarGrillaAdjuntosNuevosVersionado(){
        $arr = array();
        $i = 0;
        if (isset($_SESSION['adjuntos']) and count($_SESSION['adjuntos']) > 0) {
            foreach ($_SESSION['adjuntos'] as $item) {
                $arr[$i]['id_archivo_relacionado']      = $item['id_archivo_relacionado'];
                $arr[$i]['id_archivo']      = $item['id_archivo'];
                $arr[$i]['name']            = $item['name'];
                $arr[$i]['indice']          = $i;
                $arr[$i]['fecha']           = $item['fecha'];
                $arr[$i]['usuario']         = $item['usuario'];
                $arr[$i]['usuario_id']      = $item['usuario_id'];
                $arr[$i]['nombre_archivo']  = $item['nombre_archivo'];
                $arr[$i]['version']         = $item['version'];
                              
                $i++;
            }
        }
		
		//smarty
        $this->smarty->assign('adjuntos', $arr);

        //llamado al template
        $template = $this->smarty->fetch('MantenedorArchivo/Nuevo/grilla_adjuntos_nuevos_versionados.tpl');

        echo $template;
    }

//Funcion para ver Adjunto
    public function verAdjunto(){
        $params = $this->request->getParametros();

        if (isset($_SESSION['adjuntos'])) {
            $adjunto = $_SESSION['adjuntos'][$params[0]];
            header('Content-Type: ' . $adjunto['type']);
            header('Content-Disposition: inline; filename="' . $adjunto['name'] . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            echo base64_decode($adjunto['contenido']);
            exit();
        }else{
            $sha = $params[0];
            $_DAOArchivos = $this->load->model('DAOArchivos');
            $adjunto = $_DAOArchivos->getArchivoPorSha($sha);
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

//Funcion para ver Adjunto Carpeta	
    public function verAdjuntoCarpeta(){
        $params = $this->request->getParametros();
        
        if (isset($_SESSION['adjuntos'])) {
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
            $adjunto = $_DAOArchivos->getArchivoPorIdDocumento($id_documento);
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

//Funcion para borrar Adjunto Nuevo
    public function borrarAdjuntoNuevo(){
        $indice = $_POST['indice'];
        $i = 0;
        unset($_SESSION['adjuntos'][$indice]);

        $arr = $_SESSION['adjuntos'];
        unset($_SESSION['adjuntos']);
        foreach ($arr as $item) {
            $_SESSION['adjuntos'][] = $item;
        }

        $this->cargarGrillaAdjuntosNuevos();
    }

//Funcion para adjuntar Archivo
    public function adjuntarArchivo($mensaje = null){
        $params = $this->request->getParametros();       
            if (!is_null($mensaje)) {
                $this->smarty->assign('mensaje', $mensaje);
            }
			
            //llamado al template            
            $this->smarty->display('MantenedorArchivo/Nuevo/adjuntar_archivo.tpl');
    }

//Funcion para adjuntar Archivo Nuevo
    public function adjuntarArchivoNuevo($mensaje = null){
        $params     = $this->request->getParametros();
            if (!is_null($mensaje)) {
                $this->smarty->assign('mensaje', $mensaje);
            } 
			
            //llamado al template          
            $this->smarty->display('MantenedorArchivo/Nuevo/adjuntar_archivo_nuevo.tpl');
    }
	
//Funcion para adjuntar Archivo Nuevo SubCarpeta
   public function adjuntarArchivoNuevoSubCarpeta($mensaje = null){
        $params = $this->request->getParametros(); 
             if (!is_null($mensaje)) {
                $this->smarty->assign('mensaje', $mensaje);
            }  
			
            //llamado al template          
            $this->smarty->display('MantenedorArchivo/Nuevo/adjuntar_archivo_nuevo_sub_carpeta.tpl');
    }

//Funcion para adjuntar subcarpeta
    public function adjuntarArchivosubcarpeta($mensaje = null){
        $params = $this->request->getParametros();       
            if (!is_null($mensaje)) {
                $this->smarty->assign('mensaje', $mensaje);
            }
			
            //llamado al template            
            $this->smarty->display('MantenedorArchivo/Nuevo/adjuntar_archivo_nuevo_sub_carpeta.tpl');
    }
	
//Funcion para adjuntar Archivo Nuevo Version
	public function adjuntarArchivoNuevoVersion($mensaje = null, $id_archivo = null,$id_archivo_relacionado=null,$version=null){
        $params     = $this->request->getParametros();
	
	if(empty($params[0])  or  empty($params[2])){
            }else{
                $id_archivo = $params[0];
                $version    = $params[2];
            }
        
            if (!is_null($mensaje)) {
                $this->smarty->assign('mensaje', $mensaje);
            }
			
			//smarty
            $this->smarty->assign("id_archivo", $id_archivo); 
            $this->smarty->assign("id_archivo_relacionado", $id_archivo_relacionado);
            $this->smarty->assign("version", $version);

            //llamado al template          
            $this->smarty->display('MantenedorArchivo/Nuevo/adjuntar_archivo_nueva_version.tpl');
    }

//Funcion para guardar Nueva Solicitud
   public function guardarNuevaSolicitud(){
        $session = New Zend_Session_Namespace("usuario_carpeta");

        $data        = array();
        $data2       = array();
        $correlativo = 0;

        parse_str($_POST['data'], $data);
        $this->load->lib('Constantes', false);
        $json = array();

        $datos    = $data;
        $bitacora = $data2;        

        $datos['fc_fecha_creacion'] = date('Y-m-d H:i:s');
        $datos['padre']             = 'si';
		
		//llamada al _DAOMantenedorArchivos para consultas sql a funcion insSolicitud
        $insertar_solicitud         		= $this->_DAOMantenedorArchivos->insSolicitud($datos);
        $bitacora['fecha_bitacora']         = date('Y-m-d H:i:s'); 
        $bitacora['id_usuario_bitacora']    = $data['id_usuario'];
        $bitacora['nombre_evento_bitacora'] = 'Se crea Carpeta '. $data['nombre'];
        $bitacora['id_carpeta_archivo']     =  $insertar_solicitud ;
		
		//llamada al _DAOMantenedorArchivos para consultas sql a funcion insBitacora
        $insertar                           = $this->_DAOMantenedorArchivos->insBitacora($bitacora);

    if($insertar_solicitud){
            $id_solicitud = $insertar_solicitud;

            if(empty($_SESSION['adjuntos'])){
                $json['estado']  = true;
                $json['mensaje'] = 'Carpeta N °' . $id_solicitud . ' Creada sin archivos<br>';
            }else{
				if(isset($_SESSION['adjuntos']) and count($_SESSION['adjuntos'])){
					$_DAOArchivos = $this->load->model('DAOArchivos');
					$ruta = 'solicitudes/' . $insertar;
					
					if (!is_dir($ruta)){
                                mkdir($ruta, 0777, true);
                        }
						foreach ($_SESSION['adjuntos'] as $item){
                                $data = array(
                                    'solicitud'              => $insertar_solicitud,
                                    'nombre'                 => $item['name'],
                                    'nombre_archivo'         => $item['nombre_archivo'],
                                    'ruta'                   => $ruta,
                                    'sha'                    => $item['sha'],
                                    'mime'                   => $item['type'],
                                    'usuario_id'             => $session->id,                            
                                    'fecha'                  => $datos['fc_fecha_creacion'],
                                    'estado'                 => 1,
                                    'id_usuario_modifica'    => 0,
                                    'fecha_update'           => '',
                                    'versionado'             => 'no',
                                    'id_archivo_relacionado' => 0,
                                    'version'                => 1

                                );

                                $adjunto = fopen($ruta . '/' . $item['name'], 'w+b');
                                fwrite($adjunto, base64_decode($item['contenido']));
                                fclose($adjunto);

                                if (is_file($ruta . '/' . $item['name']) and is_readable($ruta . '/' . $item['name'])){
                                    $guardar = $_DAOArchivos->insArchivo($data);

                                    //Guarda historial en tabla tbl_bitacora
                                    $id_usuario = $session->id;
                                    $bitacora['fecha_bitacora']         = date('Y-m-d H:i:s'); 
                                    $bitacora['id_usuario_bitacora']    = $id_usuario;
                                    $bitacora['nombre_evento_bitacora'] = 'Se Adjunta archivo  '. $item['nombre_archivo'];
                                    $bitacora['id_carpeta_archivo']     =  $id_solicitud;
                                    $insertar_bitacora                  = $this->_DAOMantenedorArchivos->insBitacora($bitacora);
                                    //fin Guarda historial en tabla tbl_bitacora
                                }   
                    }
                    $json['estado'] = true;
                    $json['mensaje'] = 'Carpeta N °' . $insertar_solicitud   . ' Creada<br>';
                }
            }            
        echo json_encode($json);
    }
}

//Funcion para guardar Nuevo Subcarpeta
	public function guardarNuevaSubcarpeta(){
        $session = New Zend_Session_Namespace("usuario_carpeta");

        $data     = array();
        $data2    = array();

        parse_str($_POST['data'], $data);
        $this->load->lib('Constantes', false);
        $json = array();

        $datos    = $data;

        $bitacora = $data2; 

        $datos['padre']                     = 'no';
        $datos['id_carpeta_relacionada']    = $data['id_carpeta_archivo'];
        $datos['fc_fecha_creacion']         = date('Y-m-d H:i:s'); 
        $insertar_solicitud                 = $this->_DAOMantenedorArchivos->insSolicitudSubCarpeta($datos);

        $bitacora['fecha_bitacora']         = date('Y-m-d H:i:s'); 
        $bitacora['id_usuario_bitacora']    = $data['id_usuario'];
        $bitacora['nombre_evento_bitacora'] = 'Se crea sub Carpeta '. $data['nombre'];
        $bitacora['id_carpeta_archivo']     =  $insertar_solicitud ;
		
        $insertar                           = $this->_DAOMantenedorArchivos->insBitacora($bitacora);

        if($insertar_solicitud){
            $id_solicitud = $insertar_solicitud ;

            if(empty($_SESSION['adjuntos'])){
                $json['estado'] = true;
                $json['mensaje'] = 'Carpeta N °' . $id_solicitud . ' Creada sin archivos<br>';
            }else{
                        if (isset($_SESSION['adjuntos']) and count($_SESSION['adjuntos'])) {
                        $_DAOArchivos = $this->load->model('DAOArchivos');
                        $ruta = 'solicitudes/' . $insertar;

                            if (!is_dir($ruta)) {
                                mkdir($ruta, 0777, true);
                            }

                            foreach ($_SESSION['adjuntos'] as $item) {
                                $data = array(
                                    'solicitud'              => $insertar_solicitud,
                                    'nombre'                 => $item['name'],
                                    'nombre_archivo'         => $item['nombre_archivo'],
                                    'ruta'                   => $ruta,
                                    'sha'                    => $item['sha'],
                                    'mime'                   => $item['type'],
                                    'usuario_id'             => $session->id,                            
                                    'fecha'                  => $datos['fc_fecha_creacion'],
                                    'estado'                 => 1,
                                    'id_usuario_modifica'    => 0,
                                    'fecha_update'           => '',
                                    'versionado'             => 'no',
                                    'id_archivo_relacionado' => 0
                                );

                                $adjunto = fopen($ruta . '/' . $item['name'], 'w+b');
                                fwrite($adjunto, base64_decode($item['contenido']));
                                fclose($adjunto);

                                if (is_file($ruta . '/' . $item['name']) and is_readable($ruta . '/' . $item['name'])) {
                                    $guardar = $_DAOArchivos->insArchivo($data);

                                    //Guarda historial en tabla tbl_bitacora
                                    $id_usuario = $session->id;
                                    $bitacora['fecha_bitacora']         = date('Y-m-d H:i:s'); 
                                    $bitacora['id_usuario_bitacora']    = $id_usuario;
                                    $bitacora['nombre_evento_bitacora'] = 'Se Adjunta archivo  '. $item['nombre_archivo'];
                                    $bitacora['id_carpeta_archivo']     =  $id_solicitud;
                                    $insertar_bitacora                  = $this->_DAOMantenedorArchivos->insBitacora($bitacora);
                                    //fin Guarda historial en tabla tbl_bitacora
                                }   
                    }
                    $json['estado'] = true;
                    $json['mensaje'] = 'Sub Carpeta N °' . $insertar_solicitud   . ' Creada<br>';
                }
            }            
        echo json_encode($json);
    }
}

//Funcion para guardar Nuevo Archivo	
    public function guardarNuevoArchivo(){
        $session = New Zend_Session_Namespace("usuario_carpeta");
        $data = array();
        parse_str($_POST['data'], $data);
        $this->load->lib('Constantes', false);
        $json = array();
        $datos = $data;
        $error = false;

        if(empty($_SESSION['adjuntos'])){
            $json['estado'] = FALSE;
            $json['mensaje'] = 'Favor cargar archivo nuevo<br>';
        }else{
			 $datos['fc_fecha_update']     = date('Y-m-d H:i:s');
			 $update                       = $this->_DAOMantenedorArchivos->updSolicitud($datos);

            if($update){
                    $id_solicitud = $update;
                        if (isset($_SESSION['adjuntos']) and count($_SESSION['adjuntos'])) {
                            $_DAOArchivos = $this->load->model('DAOArchivos');
                            $ruta = 'solicitudes/' . $update;

                                if (!is_dir($ruta)) {
                                    mkdir($ruta, 0777, true);
                                }
                                foreach ($_SESSION['adjuntos'] as $item) {
                                    $data = array(
                                        'solicitud'              => $id_solicitud,
                                        'nombre'                 => $item['name'],
                                        'nombre_archivo'         => $item['nombre_archivo'],
                                        'ruta'                   => $ruta,
                                        'sha'                    => $item['sha'],
                                        'mime'                   => $item['type'],
                                        'usuario_id'             => $session->id,                            
                                        'fecha'                  => date('Y-m-d H:i:s'),
                                        'estado'                 => 1,
                                        'id_usuario_modifica'    => 0,
                                        'fecha_update'           => '',
                                        'versionado'             => 'no',
                                        'id_archivo_relacionado' => 0,
                                        'version'                => 1
                                    );

                                    $adjunto = fopen($ruta . '/' . $item['name'], 'w+b');
                                    fwrite($adjunto, base64_decode($item['contenido']));
                                    fclose($adjunto);

                                    if (is_file($ruta . '/' . $item['name']) and is_readable($ruta . '/' . $item['name'])) {
                                        $guardar = $_DAOArchivos->insArchivo($data);

                                       //Guarda historial en tabla tbl_bitacora
                                        $id_usuario                         = $session->id;
                                        $bitacora['fecha_bitacora']         = date('Y-m-d H:i:s'); 
                                        $bitacora['id_usuario_bitacora']    = $id_usuario;
                                        $bitacora['nombre_evento_bitacora'] = 'Se Adjunta archivo  '. $item['nombre_archivo'];
                                        $bitacora['id_carpeta_archivo']     =  $id_solicitud;
                                        $insertar                           = $this->_DAOMantenedorArchivos->insBitacora($bitacora);
                                        //fin Guarda historial en tabla tbl_bitacora
                                    }
                                }   
                            }
                    $json['estado'] = true;
                    $json['mensaje'] = 'Carpeta N °' . $id_solicitud . ' Actualizada<br>';
            }            
        }                   
        echo json_encode($json);
    }

//Funcion para guardar Nuevo Archivo SubCarpeta	
    public function guardarNuevoArchivoSubCarpeta(){
        $session = New Zend_Session_Namespace("usuario_carpeta");
        $data = array();
        parse_str($_POST['data'], $data);
        $this->load->lib('Constantes', false);
        $json = array();
        $datos = $data;
        $error = false;

        if(empty($_SESSION['adjuntos'])){
            $json['estado'] = FALSE;
            $json['mensaje'] = 'Favor cargar archivo nuevo<br>';
        }else{
			 $datos['fc_fecha_update']     = date('Y-m-d H:i:s');
			 $update                       = $this->_DAOMantenedorArchivos->updSolicitud($datos);

            if($update){
                    $id_solicitud = $update;
                        if (isset($_SESSION['adjuntos']) and count($_SESSION['adjuntos'])) {
                            $_DAOArchivos = $this->load->model('DAOArchivos');
                            $ruta = 'solicitudes/' . $update;

                                if (!is_dir($ruta)) {
                                    mkdir($ruta, 0777, true);
                                }
                                foreach ($_SESSION['adjuntos'] as $item) {
                                    $data = array(
                                        'solicitud'           => $id_solicitud,
                                        'nombre'              => $item['name'],
                                        'nombre_archivo'      => $item['nombre_archivo'],
                                        'ruta'                => $ruta,
                                        'sha'                 => $item['sha'],
                                        'mime'                => $item['type'],
                                        'usuario_id'          => $session->id,                            
                                        'fecha'               => date('Y-m-d H:i:s'),
                                        'estado'              => 1,
										'versionado'          => 'no',
                                        'id_usuario_modifica' => 0,
                                        'fecha_update'        => '',
										'version'             => 1,
										'id_archivo_relacionado' => 0
                                    );

                                    $adjunto = fopen($ruta . '/' . $item['name'], 'w+b');
                                    fwrite($adjunto, base64_decode($item['contenido']));
                                    fclose($adjunto);

                                    if (is_file($ruta . '/' . $item['name']) and is_readable($ruta . '/' . $item['name'])) {
                                        $guardar = $_DAOArchivos->insArchivo($data);

                                        //Guarda historial en tabla tbl_bitacora
                                        $id_usuario                         = $session->id;
                                        $bitacora['fecha_bitacora']         = date('Y-m-d H:i:s'); 
                                        $bitacora['id_usuario_bitacora']    = $id_usuario;
                                        $bitacora['nombre_evento_bitacora'] = 'Se Adjunta archivo  '. $item['nombre_archivo'];
                                        $bitacora['id_carpeta_archivo']     =  $id_solicitud;
                                        $insertar                           = $this->_DAOMantenedorArchivos->insBitacora($bitacora);
                                        //fin Guarda historial en tabla tbl_bitacora
                                    }
                                }   
                        }
                    $json['estado'] = true;
                    $json['mensaje'] = 'Sub Carpeta N °' . $id_solicitud . ' Actualizada<br>';
            }            
        }                   
        echo json_encode($json);
    }

//Funcion para guardar Nuevo Archivo Version
    public function guardarNuevoArchivoVersion(){
        $session = New Zend_Session_Namespace("usuario_carpeta");
        $data = array();
        parse_str($_POST['data'], $data);
        $this->load->lib('Constantes', false);
        $json = array();
        $datos = $data;
        $error = false;

        if(empty($_SESSION['adjuntos'])){
            $json['estado']  = FALSE;
            $json['mensaje'] = 'Favor cargar archivo nuevo<br>';
        }else{
         $datos['fc_fecha_update']     = date('Y-m-d H:i:s');
         $update                       = $this->_DAOMantenedorArchivos->updSolicitud($datos);

            if($update){
                    $id_solicitud = $update;
                        if (isset($_SESSION['adjuntos']) and count($_SESSION['adjuntos'])) {
                            $_DAOArchivos = $this->load->model('DAOArchivos');
                            $ruta = 'solicitudes/' . $update;

                                if (!is_dir($ruta)) {
                                    mkdir($ruta, 0777, true);
                                }
                                foreach ($_SESSION['adjuntos'] as $item) {
                                    $id_archivo                 = $item['id_archivo'];
                                    $nombre_archivo             = $item['name'];
                                    $nombre_archivo_versionado  = $item['id_archivo'].'-'.$item['name'];
                                    $id_archivo_relacionado     = $item['id_archivo_relacionado'];
                                    $version                    = $item['version'];
                                    $version_mas_uno            = $version + 1;


                                    if(empty($id_archivo_relacionado)){
                                        $data = array(
                                        'solicitud'              => $id_solicitud,
                                        'nombre'                 => $nombre_archivo_versionado,
                                        'nombre_archivo'         => $item['nombre_archivo'],
                                        'ruta'                   => $ruta,
                                        'sha'                    => $item['sha'],
                                        'mime'                   => $item['type'],
                                        'usuario_id'             => $session->id,                            
                                        'fecha'                  => date('Y-m-d H:i:s'),
                                        'estado'                 => 1,
                                        'id_usuario_modifica'    => 0,
                                        'fecha_update'           => '',
                                        'versionado'             => 'si',
                                        'id_archivo_relacionado' => $item['id_archivo'],
                                        'version'                => $version_mas_uno

                                        );
                  
                                            $guardar            = $_DAOArchivos->insArchivo($data);
                                            $actualizar_archivo = $_DAOArchivos->updArchivo($data);
                                    }else{
                                        $data = array(
                                        'solicitud'              => $id_solicitud,
                                        'nombre'                 => $nombre_archivo_versionado,
                                        'nombre_archivo'         => $item['nombre_archivo'],
                                        'ruta'                   => $ruta,
                                        'sha'                    => $item['sha'],
                                        'mime'                   => $item['type'],
                                        'usuario_id'             => $session->id,                            
                                        'fecha'                  => date('Y-m-d H:i:s'),
                                        'estado'                 => 1,
                                        'id_usuario_modifica'    => 0,
                                        'fecha_update'           => '',
                                        'versionado'             => 'si',
                                        'id_archivo_relacionado' => $id_archivo_relacionado,
                                        'id_archivo'             => $item['id_archivo'],
                                        'version'                => $version_mas_uno

                                        ); 
                                            $guardar               = $_DAOArchivos->insArchivo($data);
                                            $actualizar_archivo_an = $_DAOArchivos->updArchivos($data);   
                                         
                                        }

                                    $adjunto = fopen($ruta . '/' . $nombre_archivo_versionado, 'w+b');
                                    fwrite($adjunto, base64_decode($item['contenido']));
                                    fclose($adjunto);

                                    if (is_file($ruta . '/' . $nombre_archivo_versionado) and is_readable($ruta . '/' . $nombre_archivo_versionado)) {

                                       //Guarda historial en tabla tbl_bitacora
                                        $id_usuario                         = $session->id;
                                        $bitacora['fecha_bitacora']         = date('Y-m-d H:i:s'); 
                                        $bitacora['id_usuario_bitacora']    = $id_usuario;
                                        $bitacora['nombre_evento_bitacora'] = 'Se Adjunta nueva version  '. $item['nombre_archivo'];
                                        $bitacora['id_carpeta_archivo']     =  $id_solicitud;
                                        $insertar                           = $this->_DAOMantenedorArchivos->insBitacora($bitacora);
                                        //fin Guarda historial en tabla tbl_bitacora
                                    }
                                }   
                            }
                    $json['estado'] = true;
                    $json['mensaje'] = 'Archivo N °' . $item['id_archivo'] . ' Actualizada<br>';
            }            
        }                   
        echo json_encode($json);
    }



}