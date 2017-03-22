<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Controlador de Mantenedor
* Plataforma	: !PHP
* Creacion		: 15/03/2017
* @name			Mantenedor.php
* @version		1.0
* @author		Victor Retamal <victor.retamal@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class Mantenedor extends Controller{

    protected $_DAOPerfil;
    protected $_DAOPerfilOpcion;
	protected $_DAOOpcion;
    protected $_DAOUsuario;
    protected $_DAOWebService;
	
	function __construct(){
		parent::__construct();
        $this->load->lib('Seguridad', false);
		$this->load->lib('Fechas', false);
		$this->load->lib('Evento', false);


        $this->_DAOPerfil			= $this->load->model("DAOPerfil");
		$this->_DAOOpcion			= $this->load->model("DAOOpcion");
        $this->_DAOPerfilOpcion		= $this->load->model("DAOPerfilOpcion");
        $this->_DAOUsuario			= $this->load->model("DAOUsuario");
        $this->_DAOWebService		= $this->load->model("DAOWebService");
	}

	/********************************************** USUARIO **********************************************/
	public function usuario(){
		
		$this->smarty->assign('arr_data',$this->_DAOUsuario->getListaJoinPerfil());
		$this->_display('mantenedor_usuario/bandeja.tpl');
	}

	public function agregarUsuario(){
		$this->_display('mantenedor_usuario/agregar.tpl');
	}

	public function editarUsuario(){
		$parametros	= $this->request->getParametros();
		$id_usuario	= $parametros[0];
		$data		= $this->_DAOUsuario->getById($id_usuario);
		$perfiles	= $this->_DAOPerfil->getLista();
		$this->smarty->assign('itm',$data);
		$this->smarty->assign('perfiles',$perfiles);
		$this->smarty->display('mantenedor_usuario/editar.tpl');
		$this->load->javascript(STATIC_FILES.'js/templates/mantenedor/mantenedor_usuario.js');
	}

	public function editarUsuarioBD(){
		header('Content-type: application/json');
		$id_usuario	= $this->_request->getParam("id_usuario");
		$id_perfil	= $this->_request->getParam("id_perfil");
		//$bo_estado	= $_POST['bo_estado'];
		//$parameters	= array('id_perfil'=>$id_perfil, 'bo_estado'=>$bo_estado);
		$estado		= $this->_DAOUsuario->update(array("id_perfil" => $id_perfil), $id_usuario, "id_usuario");
		if($estado){
			$correcto	= true;
			$mensaje = 'Los datos han sido Actualizados correctamente.';
		}else{
			$correcto	= false;
			$mensaje= 'Hubo un problema al Actualizar.</b><br>Favor intentar nuevamente o contactarse con Soporte.';
		}

		$salida = array("correcto" => $correcto, "mensaje" => $mensaje);
        $json = Zend_Json::encode($salida);
        echo $json;
	}

	public function updateGrillaUsuario(){
		$this->smarty->assign('arr_data',$this->_DAOUsuario->getLista());
		echo $this->view->fetch('mantenedor_usuario/grilla.tpl');
	}

	public function cambiarUsuario(){
		Acceso::redireccionUnlogged($this->smarty);
		$where		= array('bo_activo' => 1);
		
		if($_SESSION['id_usuario_original'] == 0){
			$this->smarty->assign('id_usuario',$_SESSION['id']);
		}else{
			$this->smarty->assign('id_usuario',$_SESSION['id_usuario_original']);
		}

		$this->smarty->assign('arr_data',$this->_DAOUsuario->getListaJoinPerfil($where));
		$this->smarty->display('mantenedor_usuario/cambiar_usuario.tpl');
		$this->load->javascript(STATIC_FILES.'js/templates/mantenedor/mantenedor_usuario.js');
	}

	public function procesarCambio(){
		Acceso::redireccionUnlogged($this->smarty);

		$correcto			= false;
		$mensaje			= '';
		$parametros			= $this->_request->getParams();
		$id_usuario			= $parametros['id_usuario'];
		$id_usuario_cambio	= $parametros['id_usuario_cambio'];

		//revisar que id_usuario sea ADMIN
		
		$usuario			= $this->_DAOUsuario->getLoginByID($id_usuario_cambio);
		if(true){
			$correcto		= true;
			// Evento
				$session						= New Zend_Session_Namespace("usuario_carpeta");
				$session->id					= $usuario->id_usuario;
				$session->nombre				= $usuario->gl_nombres . " " . $usuario->gl_apellidos;
				$session->mail					= $usuario->gl_email;
				$session->rut					= $usuario->gl_rut;
				$session->fono					= $usuario->gl_fono;
				$session->celular				= $usuario->gl_celular;
				$session->id_usuario_original	= $id_usuario;

				$_SESSION['id']					= $usuario->id_usuario;
				$_SESSION['id_usuario_original']= $id_usuario;
				$_SESSION['perfil']				= $usuario->id_perfil;
				$_SESSION['id_tipo_grupo']		= $usuario->id_tipo_grupo;
				$_SESSION['id_institucion']		= $usuario->id_institucion;
				$_SESSION['id_laboratorio']		= $usuario->id_laboratorio;
				$_SESSION['nombre']				= $usuario->gl_nombres . " " . $usuario->gl_apellidos;
				$_SESSION['rut']				= $usuario->gl_rut;
				$_SESSION['mail']				= $usuario->gl_email;
				$_SESSION['fono']				= $usuario->gl_fono;
				$_SESSION['celular']			= $usuario->gl_celular;
				$_SESSION['comuna']				= $usuario->gl_nombre_comuna;
				$_SESSION['provincia']			= $usuario->gl_nombre_provincia;
				$_SESSION['region']				= $usuario->gl_nombre_region;
				$_SESSION['id_region']			= $usuario->id_region;
				$_SESSION['id_comuna']			= $usuario->id_comuna;
				$_SESSION['id_provincia']		= $usuario->id_provincia;
				$_SESSION['id_region']			= $usuario->id_region;
				$_SESSION['primer_login']		= FALSE;
				$_SESSION['autenticado']		= TRUE;
		}else{
			$mensaje	= 'Hubo un problema.</b><br>Favor intentar nuevamente o contactarse con Soporte.';
		}

		$salida	= array("correcto" => $correcto, "mensaje" => $mensaje);
        $json	= Zend_Json::encode($salida);
        echo $json;
	}

	public function volver_usuario(){
		Acceso::redireccionUnlogged($this->smarty);

		$correcto			= false;
		$mensaje			= '';
		$parametros			= $this->_request->getParams();
		$id_usuario_cambio	= $_SESSION['id_usuario_original'];
		
		$usuario			= $this->_DAOUsuario->getLoginByID($id_usuario_cambio);
		if(true){
			$correcto		= true;
			// Evento
				$session						= New Zend_Session_Namespace("usuario_carpeta");
				$session->id					= $usuario->id_usuario;
				$session->nombre				= $usuario->gl_nombres . " " . $usuario->gl_apellidos;
				$session->mail					= $usuario->gl_email;
				$session->rut					= $usuario->gl_rut;
				$session->fono					= $usuario->gl_fono;
				$session->celular				= $usuario->gl_celular;
				$session->id_usuario_original	= 0;

				$_SESSION['id']					= $usuario->id_usuario;
				$_SESSION['id_usuario_original']= 0;
				$_SESSION['perfil']				= $usuario->id_perfil;
				$_SESSION['id_tipo_grupo']		= $usuario->id_tipo_grupo;
				$_SESSION['id_institucion']		= $usuario->id_institucion;
				$_SESSION['id_laboratorio']		= $usuario->id_laboratorio;
				$_SESSION['nombre']				= $usuario->gl_nombres . " " . $usuario->gl_apellidos;
				$_SESSION['rut']				= $usuario->gl_rut;
				$_SESSION['mail']				= $usuario->gl_email;
				$_SESSION['fono']				= $usuario->gl_fono;
				$_SESSION['celular']			= $usuario->gl_celular;
				$_SESSION['comuna']				= $usuario->gl_nombre_comuna;
				$_SESSION['provincia']			= $usuario->gl_nombre_provincia;
				$_SESSION['region']				= $usuario->gl_nombre_region;
				$_SESSION['id_region']			= $usuario->id_region;
				$_SESSION['id_comuna']			= $usuario->id_comuna;
				$_SESSION['id_provincia']		= $usuario->id_provincia;
				$_SESSION['id_region']			= $usuario->id_region;
				$_SESSION['primer_login']		= FALSE;
				$_SESSION['autenticado']		= TRUE;
		}else{
			$mensaje	= 'Hubo un problema.</b><br>Favor intentar nuevamente o contactarse con Soporte.';
		}

		$salida	= array("correcto" => $correcto, "mensaje" => $mensaje);
        $json	= Zend_Json::encode($salida);
        echo $json;
	}

	/********************************************** PERFIL **********************************************/
	public function perfil(){

		$this->smarty->assign('arr_data',$this->_DAOPerfil->getLista());
		
		$this->_display('mantenedor_perfil/bandeja.tpl');
	}

	public function agregarPerfil(){

		$arr_padre	= $this->_DAOOpcion->getAllOpcionRaiz();
		$arr_opcion	= $this->_DAOOpcion->getAllOpcionRama();
		
		$this->smarty->assign('arr_padre',$arr_padre);
		$this->smarty->assign('arr_opcion',$arr_opcion);
		$this->smarty->display('mantenedor_perfil/agregar.tpl');
		$this->load->javascript(STATIC_FILES.'js/templates/mantenedor/mantenedor_perfil.js');
	}

	public function agregarPerfilBD(){
		header('Content-type: application/json');
		$parametros = $this->_request->getParams();
		$gl_nombre		= $parametros['gl_nombre'];
		$gl_descripcion	= $parametros['gl_descripcion'];
		$parameters		= array('gl_nombre_perfil'=>$gl_nombre,
								'gl_descripcion'=>$gl_descripcion,
								'id_usuario_crea'=>$_SESSION['id']);
		$id_perfil		= $this->_DAOPerfil->insert($parameters);
		$arr_opcion		= json_decode($parametros['arr_opcion']);
		if($id_perfil){
			$correcto = true;
			$mensaje  = 'El perfil se ha creado exitosamente';
			foreach($arr_opcion as $opcion){
				$param = array('id_perfil'=>$id_perfil,'id_opcion'=>$opcion->value,'id_usuario_crea'=>$_SESSION['id']);
				$this->_DAOPerfilOpcion->insert($param);
			}
		} else {
			$correcto = false;
			$mensaje = "Hubo problemas al crear el perfil nuevo.";
		}
		
		$salida = array("correcto" => $correcto, "mensaje" => $mensaje);
        $json = Zend_Json::encode($salida);
        echo $json;
	}

	public function editarPerfil(){
		
		$parametros	= $this->request->getParametros();
		$id_perfil	= $parametros[0];
		$data		= $this->_DAOPerfil->getById($id_perfil);
		/*stdClass Object ( [id_perfil] => 1 [gl_nombre_perfil] => ADMINISTRADOR [id_usuario_crea] => [fc_crea] => )*/

		$this->smarty->assign('itm',$data);
		$this->smarty->display('mantenedor_perfil/editar.tpl');
		$this->load->javascript(STATIC_FILES.'js/templates/mantenedor/mantenedor_perfil.js');
	}
	
	public function editarPerfilBD(){
		header('Content-type: application/json');
		$id_perfil			= $this->_request->getParam("id_perfil");
		$gl_nombre_perfil	= $this->_request->getParam("gl_nombre_perfil");
		$gl_descripcion		= $this->_request->getParam("gl_descripcion");
		//$bo_estado	= $_POST['bo_estado'];
		//$parameters	= array('id_perfil'=>$id_perfil, 'bo_estado'=>$bo_estado);
		$estado		= $this->_DAOPerfil->update(
				array(	"gl_nombre_perfil"		=> $gl_nombre_perfil,
						"gl_descripcion"		=> $gl_descripcion						
					), 
				$id_perfil, "id_perfil");
		if($estado){
			$correcto	= true;
			$mensaje = 'Los datos han sido Actualizados correctamente.';
		}else{
			$correcto	= false;
			$mensaje= 'Hubo un problema al Actualizar.</b><br>Favor intentar nuevamente o contactarse con Soporte.';
		}

		$salida = array("correcto" => $correcto, "mensaje" => $mensaje);
        $json = Zend_Json::encode($salida);
        echo $json;
	}
	
	public function editarPerfilOpcion(){

		$parametros		= $this->request->getParametros();
		$id_perfil		= $parametros[0];
		$data			= $this->_DAOPerfil->getById($id_perfil);
		$arr_padre		= $this->_DAOOpcion->getAllOpcionRaiz();
		$arr_opcion		= $this->_DAOOpcion->getAllOpcionRama($id_perfil);
		$arr_opcion_act	= $this->_DAOPerfilOpcion->getAllMenuPerfilPorID($id_perfil);
		$this->smarty->assign('itm',$data);
		$this->smarty->assign('arr_opcion_act',(array)$arr_opcion_act);
		$this->smarty->assign('arr_padre',$arr_padre);
		$this->smarty->assign('arr_opcion',$arr_opcion);
		$this->smarty->display('mantenedor_perfil/editar_menu.tpl');
		$this->load->javascript(STATIC_FILES.'js/templates/mantenedor/mantenedor_perfil.js');
	}

	/********************************************** WEBSERVICE **********************************************/
	public function webservice(){

		$this->smarty->assign('arr_data',$this->_DAOWebService->getLista());
		
		$this->_display('mantenedor_ws/bandeja.tpl');
	}

	public function agregarWebService(){
		$this->_display('mantenedor_ws/agregar.tpl');
	}

	public function editarWebService(){

		$parametros	= $this->request->getParametros();
		$id_web_service	= $parametros[0];
		$data		= $this->_DAOWebService->getById($id_web_service);

		$this->smarty->assign('itm',$data);
		$this->_display('mantenedor_ws/editar.tpl');
	}

	/********************************************** MENU **********************************************/
	public function menu(){

		$this->smarty->assign('arr_data',$this->_DAOPerfilOpcion->getLista());

		$this->_display('mantenedor_menu/bandeja.tpl');
	}

	public function agregarMenuPadre(){
		$this->_display('mantenedor_menu/agregar_padre.tpl');
	}

	public function agregarMenuOpcion(){

		$arr_padre	= $this->_DAOPerfilOpcion->getAllMenuPadre();
		$arr_perfil	= $this->_DAOPerfilOpcion->getAllMenuOpcionPorID(0);

		$this->smarty->assign('arr_padre',$arr_padre);
		$this->smarty->assign('arr_perfil',$arr_perfil);
		$this->_display('mantenedor_menu/agregar_opcion.tpl');
	}

	public function editarMenuOpcion(){

		$parametros	= $this->request->getParametros();
		$id_opcion	= $parametros[0];
		$data		= $this->_DAOPerfilOpcion->getMenuOpcionPorID($id_opcion);
		$arr_padre	= $this->_DAOPerfilOpcion->getAllMenuPadre();

		$this->smarty->assign('itm',$data);
		$this->smarty->assign('arr_padre',$arr_padre);
		$this->_display('mantenedor_menu/editar_opcion.tpl');
	}

	public function editarMenuPerfil(){

		$parametros	= $this->request->getParametros();
		$id_opcion	= $parametros[0];
		$data		= $this->_DAOPerfilOpcion->getMenuOpcionPorID($id_opcion);
		$arr_perfil	= $this->_DAOPerfilOpcion->getAllMenuOpcionPorID($id_opcion);

		$this->smarty->assign('itm',$data);
		$this->smarty->assign('arr_perfil',$arr_perfil);
		$this->_display('mantenedor_menu/editar_menu.tpl');
	}

}