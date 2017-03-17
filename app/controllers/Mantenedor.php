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
    protected $_DAOUsuario;
    protected $_DAOWebService;
	
	function __construct(){
		parent::__construct();
        $this->load->lib('Seguridad', false);
		$this->load->lib('Fechas', false);
		$this->load->lib('Evento', false);


        $this->_DAOPerfil			= $this->load->model("DAOPerfil");
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

	/********************************************** PERFIL **********************************************/
	public function perfil(){

		$this->smarty->assign('arr_data',$this->_DAOPerfil->getLista());
		
		$this->_display('mantenedor_perfil/bandeja.tpl');
	}

	public function agregarPerfil(){

		$arr_padre	= $this->_DAOPerfilOpcion->getAllMenuPadre();
		$arr_opcion	= $this->_DAOPerfilOpcion->getAllMenuPerfilPorID(0);
		
		$this->smarty->assign('arr_padre',$arr_padre);
		$this->smarty->assign('arr_opcion',$arr_opcion);
		$this->smarty->display('mantenedor_perfil/agregar.tpl');
		$this->load->javascript(STATIC_FILES.'js/templates/mantenedor/mantenedor_perfil.js');
	}

	public function agregarPerfilBD(){
		header('Content-type: application/json');
		$parametros = $this->_request->getParams();
		print_r($parametros);DIE;
		//$gl_nombre		= $_POST['gl_nombre_perfil'];
		//$gl_descripcion	= $_POST['gl_descripcion_perfil'];
		//$arr_opcion		= $_POST['arr_opcion'];
		$parameters		= array('gl_nombre'=>$gl_nombre,'gl_descripcion'=>$gl_descripcion,'id_usuario_creador'=>Session::getSession('id_usuario'));
		$id_perfil		= $this->_DAOPerfil->_insert($parameters);

		foreach($arr_opcion as $id_opcion){
			$param		= array('id_perfil'=>$id_perfil,'id_opcion'=>$id_opcion,'id_usuario_creador'=>Session::getSession('id_usuario'));
			$this->_DAOPerfilOpcion->_insert($param);
		}
		
		if($estado){
			$json['estado']	= true;
			$json['mensaje']= 'Los datos han sido Actualizados correctamente.';
		}else{
			$json['estado']	= false;
			$json['mensaje']= '<b>Hubo un problema al Actualizar.</b><br>Favor intentar nuevamente o contactarse con Soporte.';
		}
		print_r(json_encode($json));DIE();
		echo json_encode($json);
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

	public function editarPerfilOpcion(){

		$parametros	= $this->request->getParametros();
		$id_perfil	= $parametros[0];
		//$data		= $this->_daoMaestroPerfil->getPerfilPorID($id_perfil);
		$data		= $this->_DAOPerfil->getById($id_perfil);
		$arr_padre	= $this->_DAOPerfilOpcion->getAllMenuPadre();
		$arr_opcion	= $this->_DAOPerfilOpcion->getAllMenuPerfilPorID($id_perfil);

		$this->smarty->assign('itm',$data);
		$this->smarty->assign('arr_padre',$arr_padre);
		$this->smarty->assign('arr_opcion',$arr_opcion);
		$this->_display('mantenedor_perfil/editar_menu.tpl');
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