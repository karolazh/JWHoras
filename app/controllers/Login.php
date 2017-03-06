<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: Login.php
!Sistema 	  		: PREVENCION DE FEMICIDIOS
!Modulo 	  		: NA
!Descripcion  		: 
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Victor Retamal <victor.retamal@cosof.cl>
!Creacion     		: 20/02/2017
!Retornos/Salidas 	: NA
!OrigenReq        	: NA
=============================================================================
!Parametros 		: NA 
=============================================================================
!Testing 			: NA
=============================================================================
*!ControlCambio
*--------------
*!cProgramador					!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*<orlando.vazquezl@cosof.cl>	06-05-2017	Modificación referencias a DAO's de acuerdo a nueva estructura de BD.
-----------------------------------------------------------------------------

-----------------------------------------------------------------------------
*****************************************************************************
!EndHeaderDoc 
*/

class Login extends Controller {

    protected $_DAOUsuario;
    protected $_DAORegion;
    protected $_DAOComuna;
    protected $_DAOProvincia;
    protected $DAOAuditoriaLogin;

    /*** Constructor ***/
    function __construct() {
        parent::__construct();
		include_once("app/libs/nusoap/lib/nusoap.php");
		
        $this->load->lib('Seguridad', false);
        $this->_DAOUsuario = $this->load->model("DAOUsuario");
        $this->_DAORegion = $this->load->model("DAORegion");
        $this->_DAOComuna = $this->load->model("DAOComuna");
        $this->_DAOProvincia = $this->load->model("DAOProvincia");
        $this->_DAOAuditoriaLogin = $this->load->model("DAOAuditoriaLogin");
    }

    public function index() {
        $session = New Zend_Session_Namespace("usuario_carpeta");

        if (isset($session->id)) {
            $usuario = $this->_DAOUsuario->getById($session->id);
            if (!is_null($usuario)) {
                header("location: index.php/Home/dashboard");
                die();
            }
        }
        $_SESSION['autenticado'] = FALSE;
        $this->smarty->assign("hidden", "hidden");
        $this->smarty->display('login/login.tpl');
    }

    /*** Recuperar Password ***/
    public function recuperar_password() {
        $this->_addJavascript(STATIC_FILES . 'js/templates/login/recuperar_password.js');
        $this->_display('login/recuperar_password.tpl', false);
    }

    /*** 20170127 - Procesa Login de Usuario***/
    public function procesar() {
        $rut			= trim($this->_request->getParam("rut"));
        $password		= Seguridad::generar_sha512($this->_request->getParam("password"));
        //$recordar		= trim($this->_request->getParam("recordar"));
        $recordar		= 0;
		$primer_login	= FALSE;
		$comuna			= "";
		$region			= "";
		$provincia		= "";

        $usuario		= $this->_DAOUsuario->getLogin($rut, $password);

        if (empty($usuario->fc_ultimo_login)) {
			$primer_login = TRUE;
		}

        if ($usuario) {
			if($usuario->bo_activo == 1){
				$registro			= $this->_DAOAuditoriaLogin->registro_login($usuario->id_usuario, $rut, 'login');
				
				$session			= New Zend_Session_Namespace("usuario_carpeta");
				$session->id		= $usuario->id_usuario;
				$session->nombre	= $usuario->gl_nombres . " " . $usuario->gl_apellidos;
				$session->mail		= $usuario->gl_email;
				$session->rut		= $usuario->gl_rut;
				$session->fono		= $usuario->gl_fono;
				$session->celular	= $usuario->gl_celular;

				if (!$primer_login) {
					$ultimo_login	= date('Y-m-d H:i:s');
					$datos			= array($ultimo_login, $session->id);
					$upd			= $this->_DAOUsuarios->setUltimoLogin($datos);
				}

				$_SESSION['id']				= $usuario->id_usuario;
				$_SESSION['perfil']			= $usuario->id_perfil;
				$_SESSION['gl_grupo_tipo']	= $usuario->gl_grupo_tipo;
				$_SESSION['id_institucion']	= $usuario->id_institucion;
				$_SESSION['nombre']			= $usuario->gl_nombres . " " . $usuario->gl_apellidos;
				$_SESSION['rut']			= $usuario->gl_rut;
				$_SESSION['mail']			= $usuario->gl_email;
				$_SESSION['fono']			= $usuario->gl_fono;
				$_SESSION['celular']		= $usuario->gl_celular;
				$_SESSION['comuna']			= $usuario->gl_nombre_comuna;
				$_SESSION['provincia']		= $usuario->gl_nombre_provincia;
				$_SESSION['region']			= $usuario->gl_nombre_region;
				$_SESSION['id_comuna']		= $usuario->id_comuna;
				$_SESSION['id_provincia']	= $usuario->id_provincia;
				$_SESSION['id_region']		= $usuario->id_region;
				$_SESSION['primer_login']	= $primer_login;
				$_SESSION['autenticado']	= TRUE;

				if ($recordar == 1) {
					setcookie('datos_usuario_carpeta', $usuario->id_usuario, time() + 365 * 24 * 60 * 60);
				}
				if($primer_login) {
					header('Location: ' . BASE_URI . '/Login/actualizar');
				}else{
					header('Location: ' . BASE_URI . '/Home/dashboard');
				}
			}else{
				$this->smarty->assign("hidden", "");
				$this->smarty->assign("texto_error", "Usuario se encuentra Inhabilitado.");
				$this->smarty->display('login/login.tpl');				
			}
        }else{
			$registro	= $this->_DAOAuditoriaLogin->registro_login(0, $rut, 'login');
            $this->smarty->assign("hidden", "");
            $this->smarty->assign("texto_error", "Los datos ingresados no son válidos.");
            $this->smarty->display('login/login.tpl');
        }
    }

    public function validaRutMidas() {
		$parametros		= $this->request->getParametros();
		$rut_usuario	= $parametros[0];
		$usuario		= array();

		if( isset($rut_usuario) and trim($rut_usuario) != "" ){
			$usuario		= $this->_DAOUsuario->getLoginMidas(strtolower($rut_usuario));
		}

		if($usuario){			
			echo json_encode(array('rut'=>$usuario->gl_rut));
		}else{
			echo json_encode(array('rut'=>''));
		}

	}

	public function loginRemotoMidas(){
        define('MIDAS_WS_AUTH_USER','Midas_Soap_User');
        define('MIDAS_WS_AUTH_PASS','BQT9U4Ni2yVZHhPQq3T2YpM8RsvwPCSNK0mQX33nBjmfIbvgQK3UeRsLJJxRELetXk8iL9Gj'); 

		$parametros		= $this->request->getParametros();
		$token			= $parametros[0];

		$usuario		= array();
		//$ws_info		= $this->_daoWS_Sistema->getWS('MIDAS' ,ENVIROMENT);
		//$wsdl			= $ws_info->sistema_wsdl;
		
		$ws				= new nusoap_client('https://192.168.10.165/midas_prueba/ws/wsMIDAS.php?wsdl');
		$ws->setCredentials(MIDAS_WS_AUTH_USER, MIDAS_WS_AUTH_PASS, 'basic');
		$ws->soap_defencoding	= 'UTF-8';
		$ws->decode_utf8 		= false;
		$error					= $ws->getError();

		if($error){
            $this->smarty->assign("hidden", "");
            $this->smarty->assign("texto_error", "Usuario no está activo o hubo un problema con el WebService.");
            $this->smarty->display('login/login.tpl');
		}else{
			$ws_data    = array(
								'token'	=> $token,
								);

			$param		= array('cabecera' => $ws_data);
			$arr		= $ws->call('validarToken', $param);

			if(isset($arr['rut']) and trim($arr['rut']) != "" ){
				$usuario	= $this->_DAOUsuario->getLoginMidas(strtolower($arr['rut']));
			}else{
				$this->smarty->assign("hidden", "");
				$this->smarty->assign("texto_error", $arr['error']['GlosaError']);
				$this->smarty->display('login/login.tpl');
			}

			
			if ($usuario) {
				if($usuario->bo_activo == 1){
					$registro	= $this->_DAOAuditoriaLogin->registro_login($usuario->id_usuario, $arr['rut'], 'loginMIDAS', $token);
					$session			= New Zend_Session_Namespace("usuario_carpeta");
					$session->id		= $usuario->id_usuario;
					$session->nombre	= $usuario->gl_nombres . " " . $usuario->gl_apellidos;
					$session->mail		= $usuario->gl_email;
					$session->rut		= $usuario->gl_rut;
					$session->fono		= $usuario->gl_fono;
					$session->celular	= $usuario->gl_celular;

					if (!$primer_login) {
						$ultimo_login	= date('Y-m-d H:i:s');
						$datos			= array($ultimo_login, $session->id);
						$upd			= $this->_DAOUsuario->setUltimoLogin($datos);
					}

					$_SESSION['id']				= $usuario->id_usuario;
					$_SESSION['perfil']			= $usuario->id_perfil;
					$_SESSION['gl_grupo_tipo']	= $usuario->gl_grupo_tipo;
					$_SESSION['id_institucion']	= $usuario->id_institucion;
					$_SESSION['nombre']			= $usuario->gl_nombres . " " . $usuario->gl_apellidos;
					$_SESSION['rut']			= $usuario->gl_rut;
					$_SESSION['mail']			= $usuario->gl_email;
					$_SESSION['fono']			= $usuario->gl_fono;
					$_SESSION['celular']		= $usuario->gl_celular;
					$_SESSION['comuna']			= $usuario->gl_nombre_comuna;
					$_SESSION['provincia']		= $usuario->gl_nombre_provincia;
					$_SESSION['region']			= $usuario->gl_nombre_region;
					$_SESSION['id_comuna']		= $usuario->id_comuna;
					$_SESSION['id_provincia']	= $usuario->id_provincia;
					$_SESSION['id_region']		= $usuario->id_region;
					$_SESSION['primer_login']	= $primer_login;
					$_SESSION['autenticado']	= TRUE;

					if ($recordar == 1) {
						setcookie('datos_usuario_carpeta', $usuario->id_usuario, time() + 365 * 24 * 60 * 60);
					}
					if($primer_login) {
						header('Location: ' . BASE_URI . '/Login/actualizar');
					}else{
						header('Location: ' . BASE_URI . '/Home/dashboard');
					}
				}else{
					$registro	= $this->_DAOAuditoriaLogin->registro_login(0, $arr['rut'], 'loginMIDAS', $token);
					$this->smarty->assign("hidden", "");
					$this->smarty->assign("texto_error", "Usuario se encuentra Inhabilitado.");
					$this->smarty->display('login/login.tpl');				
				}
			}else{
				$this->smarty->assign("hidden", "");
				$this->smarty->assign("texto_error", "Los datos ingresados no son válidos.");
				$this->smarty->display('login/login.tpl');
			}
		}
	}

    //*** 20170127 - Formulario para obtener cuenta de usuario **//
    public function obtener_cuenta() {
        $this->_addJavascript(STATIC_FILES . 'js/templates/login/obtener_cuenta.js');
        $this->_display('login/obtener_cuenta.tpl', false);
    }

    //*** 20170127 - Formulario Actualiza Password ***//
    public function actualizar() {
        $this->smarty->assign("nombre", $_SESSION['nombre']);
        $this->smarty->assign("rut", $_SESSION['rut']);
        $this->smarty->assign("mail", $_SESSION['mail']);
        $this->smarty->assign("fono", $_SESSION['fono']);
        $this->smarty->assign("celular", $_SESSION['celular']);
        $this->smarty->assign("comuna", $_SESSION['comuna']);
        $this->smarty->assign("provincia", $_SESSION['provincia']);
        $this->smarty->assign("region", $_SESSION['region']);
        $this->smarty->assign("primer_login", $_SESSION['primer_login']);
        $this->smarty->assign("hidden", "hidden");
        $this->_addJavascript(STATIC_FILES . 'js/templates/login/actualizar_password.js');
        $this->_display('login/actualizar.tpl');
    }
            /* obtiene nombre de comuna */
    //*** 20170201 - Funcion guarda nueva password ***//
    public function ajax_guardar_nuevo_password() {
        header('Content-type: application/json');

        $session = New Zend_Session_Namespace("usuario_carpeta");

        $validar = $this->load->lib("Helpers/Validar/ActualizarPassword", true, "Validar_ActualizarPassword", $this->_request->getParams());

        if ($validar->isValid()) {
            //$date = date('Y-m-d H:i:s');
            $password		= Seguridad::generar_sha512($this->_request->getParam("password"));
            $ultimo_login	= date('Y-m-d H:i:s');
            $datos			= array($password, $ultimo_login, $session->id);

            $upd = $this->_DAOUsuario->setPassword($datos);
            if ($upd) {
                $primer_login = FALSE;
                $_SESSION['primer_login'] = $primer_login;
            }
        }

        $salida = array("error" => $validar->getErrores(),
            "correcto" => $validar->getCorrecto());
        $this->smarty->assign("hidden", "");
        $json = Zend_Json::encode($salida);
        echo $json;
    }

    public function logoutUsuario() {
        if (isset($_COOKIE['datos_usuario_carpeta'])) {
            unset($_COOKIE['datos_usuario_carpeta']);
            setcookie('datos_usuario_carpeta', '', time() - 1); // empty value and old timestamp
        }
        unset($_SESSION['usuario_carpeta']);
        unset($_SESSION['adjuntos']);
        //session_destroy();
        header('Location:' . BASE_URI);
    }
    
    public function recuperar_password_rut() {
        header('Content-type: application/json');
        $rut			= trim($this->_request->getParam("rut"));
        $correcto		= false;
        $error			= array();
        $destinatario	= "";

        if (trim($this->_request->getParam("rut")) != "") {
            $usuario	= $this->_DAOUsuario->getByRut($this->_request->getParam("rut"));

            if (!is_null($usuario)) {
                $correcto	= true;
                $cadena		= Seguridad::randomPass(12);
                $cadenahash	= Seguridad::generar_sha512($cadena);

                $this->smarty->assign("nombre", $usuario->gl_nombres . " " . $usuario->gl_apellidos);
                $this->smarty->assign('pass', $cadena);
                $this->smarty->assign("url", HOST . "/index.php/Usuario/modificar_password/" . $cadena);
                $ultimo_login = NULL;
                $this->_DAOUsuario->update(
                        array("gl_password" => $cadenahash, "fc_ultimo_login" => $ultimo_login), $usuario->id_usuario, "id_usuario"
                );

                $this->load->lib('Email', false);
                $remitente			= "midas@minsal.cl";
                $nombre_remitente	= "Prevención de Femicidios";
                $destinatario		= $usuario->gl_email;

                $asunto				= "PREDEFEM - Recuperar contraseña";
                $mensaje			= $this->smarty->fetch("login/recuperar_password_rut.tpl");
                Email::sendEmail($destinatario, $remitente, $nombre_remitente, $asunto, $mensaje);
            } else {
                $correcto		= false;
                $error['rut']	= "";
            }
        }
        $salida = ["rut" => $rut, "error" => $error,
            "correcto" => $correcto, "correo" => $destinatario];

        $json = Zend_Json::encode($salida);
        echo $json;
    }
    
}
