<?php

class Login extends Controller {
    /*     * * @var ** */

    protected $_DAOUsuarios;
    protected $_DAORegion;
    protected $_DAOComuna;
    protected $_DAOProvincias;

    /*     * * Constructor ** */

    function __construct() {
        parent::__construct();
        $this->load->lib('Seguridad', false);
        $this->_DAOUsuarios = $this->load->model("DAOUsuarios");
        $this->_DAORegion = $this->load->model("DAORegion");
        $this->_DAOComuna = $this->load->model("DAOComuna");
        $this->_DAOProvincias = $this->load->model("DAOProvincias");
    }

    /*     * * Formulario de logeo ** */

    public function index() {
        $session = New Zend_Session_Namespace("usuario_carpeta");

        if (isset($session->id)) {
            $usuario = $this->_DAOUsuarios->getById($session->id);
            if (!is_null($usuario)) {
                header("location: index.php/Home/dashboard");
                die();
            }
        }
        $_SESSION['autenticado'] = FALSE;
        $this->smarty->assign("hidden", "hidden");
        $this->_addJavascript(STATIC_FILES . 'js/lib/validador.js');
        $this->smarty->display('login/login.tpl');
    }

    /*     * * Recuperar Password ** */

    public function recuperar_password() {
        $this->_addJavascript(STATIC_FILES . 'js/templates/login/recuperar_password.js');
        $this->_addJavascript(STATIC_FILES . 'js/lib/validador.js');
        $this->_display('login/recuperar_password.tpl', false);
    }

    //*** 20170127 - Procesa Login de Usuario***//
    public function procesar() {
        $rut = trim($this->_request->getParam("rut"));
        $password = trim($this->_request->getParam("password"));
        //$recordar = trim($this->_request->getParam("recordar"));
        $usuario = $this->_DAOUsuarios->getByRut($rut);
        //a mayores iteraciones es mas lento adivinar la contraseña
        $iteraciones = 1000000;
        $valido = FALSE;
        $primer_login = FALSE;
        if (!is_null($usuario)) {
            $salt = $usuario->usr_salt;
            if ($usuario->usr_ultimo_login === NULL) {
                $primer_login = TRUE;
            }
            if ($usuario->usr_password == (hash_pbkdf2('sha512', $password, $salt, $iteraciones))) {
                $valido = true;
            }
        }
        if ($valido and $rut != "" and $password != "") {
            $session = New Zend_Session_Namespace("usuario_carpeta");
            $session->id = $usuario->usr_id;
            $session->nombre = $usuario->usr_nombres . " " . $usuario->usr_apellidos;
            $session->mail = $usuario->usr_email;
            if (!$primer_login) {
                $ultimo_login = date('Y-m-d H:i:s');
                $datos = array($ultimo_login, $session->id);
                $upd = $this->_DAOUsuarios->setUltimoLogin($datos);
            }
            $comuna = "";
            $region = "";
            $provincia = "";

            $id_comuna = $usuario->usr_com_id;
            echo $id_comuna;
            /* obtiene nombre de comuna */
            if ($id_comuna) {
                $result = $this->_DAOComuna->getComuna($id_comuna);
                if ($result) {
                    $comuna = $result->com_nombre;
                    $id_provincia = $result->com_pro_id;

                    /* obtiene código de región a través de provincia */
                    $result2 = $this->_DAOProvincias->getProvincia($id_provincia);
                    if ($result2) {
                        $provincia = $result2->pro_nombre;
                        $id_region = $result2->pro_reg_id;

                        /* obtiene nombre de región */
                        $result3 = $this->_DAORegion->getRegion($id_region);
                        if ($result3) {
                            $cod = $result3->reg_codigo;
                            $nom = $result3->reg_nombre;
                            $region = $cod . " - " . $nom;
                        }
                    }
                    //if(!is_null($result2))
                }
                //if(!is_null($result))
            }
            //if(!is_null($id_comuna))       

            $_SESSION['id'] = $usuario->usr_id;
            $_SESSION['perfil'] = $usuario->usr_pfl_id;
            $_SESSION['nombre'] = $usuario->usr_nombres . " " . $usuario->usr_apellidos;
            $_SESSION['rut'] = $usuario->usr_rut;
            $_SESSION['mail'] = $usuario->usr_email;
            $_SESSION['fono'] = $usuario->usr_fono;
            $_SESSION['celular'] = $usuario->usr_celular;
            $_SESSION['comuna'] = $comuna;
            $_SESSION['provincia'] = $provincia;
            $_SESSION['region'] = $region;
            $_SESSION['primer_login'] = $primer_login;
            $_SESSION['autenticado'] = TRUE;
            if ($recordar == 1) {
                setcookie('datos_usuario_carpeta', $usuario->usr_id, time() + 365 * 24 * 60 * 60);
            }
            if ($primer_login) {
                header('Location: ' . BASE_URI . '/Login/actualizar');
            } else {
                header('Location: ' . BASE_URI . '/Home/dashboard');
            }
        } else {
            $this->smarty->assign("hidden", "");
            $this->smarty->assign("texto_error", "Los datos ingresados no son válidos.");
            $this->_addJavascript(STATIC_FILES . 'js/lib/validador.js');
            $this->smarty->display('login/login.tpl');
        }
    }

    //*** 20170127 - Formulario para obtener cuenta de usuario **//
    public function obtener_cuenta() {
        $this->_addJavascript(STATIC_FILES . 'js/templates/login/obtener_cuenta.js');
        $this->_display('login/obtener_cuenta.tpl', false);
    }

    //*** 20170127 - Formulario Actualiza Password ***//
    public function actualizar() {
        //Seguridad::validar_sesion($this->smarty);
        Acceso::redireccionUnlogged($this->smarty);
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
        $this->smarty->assign("texto_error", "Los datos ingresados no son válidos.");
        $this->_addJavascript(STATIC_FILES . 'js/lib/validador.js');
        $this->_addJavascript(STATIC_FILES . 'js/templates/login/actualizar_password.js');
        $this->_display('login/actualizar.tpl');
    }
/*
    /*** 20170127 - Formulario Actualiza Password ***/
/*
    public function actualizar2() {
        $this->smarty->assign("nombre", $_SESSION['nombre']);
        $this->smarty->assign("rut", $_SESSION['rut']);
        $this->smarty->assign("mail", $_SESSION['mail']);
        $this->smarty->assign("fono", $_SESSION['fono']);
        $this->smarty->assign("celular", $_SESSION['celular']);
        $this->smarty->assign("comuna", $_SESSION['comuna']);
        $this->smarty->assign("provincia", $_SESSION['provincia']);
        $this->smarty->assign("region", $_SESSION['region']);

        $this->smarty->assign("hidden", "hidden");
        $this->_addJavascript(STATIC_FILES . 'js/templates/login/actualizar_password.js');
        $this->_display('login/actualizar2.tpl');
    }

    */
    //*** 20170201 - Funcion guarda nueva password ***//
    public function ajax_guardar_nuevo_password() {
        header('Content-type: application/json');

        $session = New Zend_Session_Namespace("usuario_carpeta");

        $validar = $this->load->lib("Helpers/Validar/ActualizarPassword", true, "Validar_ActualizarPassword", $this->_request->getParams());

        if ($validar->isValid()) {
            //$date = date('Y-m-d H:i:s');
            $iteraciones = 1000000;
            $bin = openssl_random_pseudo_bytes(64);
            $salt = bin2hex($bin);
            $fecha_login = $password = sha1($this->_request->getParam("password"));
            $password = hash_pbkdf2('sha512', $this->_request->getParam("password"), $salt, $iteraciones);
            $ultimo_login = date('Y-m-d H:i:s');
            $datos = array($password, $salt, $ultimo_login, $session->id);

            $upd = $this->_DAOUsuarios->setPassword($datos);
            if ($upd) {
                $primer_login = FALSE;
                $_SESSION['primer_login'] = $primer_login;
            }
        }

        $salida = array("error" => $validar->getErrores(),
            "correcto" => $validar->getCorrecto());

        $json = Zend_Json::encode($salida);
        echo $json;
    }

    /**
     * 
     */
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
/*
    public function crear_cuenta_nueva() {
        header('Content-type: application/json');
        //echo $this->_request->getParam("nombre");
        //print_r($_FILES);die();

        $validar = $this->load->lib("Helpers/Validar/Usuario", true, "Validar_Usuario", $this->_request->getParams());
        $correcto = false;
        if ($validar->isValid()) {
            $email = trim($this->_request->getParam("email"));
            $rut = trim($this->_request->getParam("rut"));
            $nombres = trim($this->_request->getParam("nombre"));
            $apellidos = trim($this->_request->getParam("apellido"));

            if (!in_array("", array($apellidos, $email, $rut, $nombres))) {
                $data = array("usr_usuario" => $email,
                    "usr_usuario_canon" => $email,
                    "usr_rut" => $rut,
                    "usr_nombres" => $nombres,
                    "usr_apellidos" => $apellidos,
                    "usr_email" => $email,
                    "usr_password" => "cambiame",
                    "usr_salt" => "sal",
                    "usr_perfil" => "a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}"
                );
                $data["usr_password"] = Seguridad::generar_sha1($data["usr_password"]);
                $id = $this->_DAOUsuarios->insert($data);

                $correcto = true;
            } else {
                $correcto = false;
            }
        }
        $salida = array("error" => $validar->getErrores(),
            "correcto" => $validar->getCorrecto());

        $json = Zend_Json::encode($salida);
        echo $json;
    }

    private function validarArchivo() {
        
    }
*/
    public function recuperar_password_rut() {
        header('Content-type: application/json');
        $rut = "";
        $correcto = false;
        $error = array();
        $rutparam = $this->_request->getParam("rut");
        if (trim($this->_request->getParam("rut")) != "") {
            $usuario = $this->_DAOUsuarios->getByRut($this->_request->getParam("rut"));
            if (!is_null($usuario)) {
                $correcto = true;
                $cadena = Seguridad::randomPass(12);
                $bin = openssl_random_pseudo_bytes(64);
                $salt = bin2hex($bin);
                $iteraciones = 1000000;
                $cadenahash = hash_pbkdf2('sha512', $cadena, $salt, $iteraciones);
                $this->smarty->assign("nombre", $usuario->usr_nombres . " " . $usuario->usr_apellidos);
                $this->smarty->assign('pass', $cadena);
                $this->smarty->assign("url", HOST . "/index.php/Usuario/modificar_password/" . $cadena);
                $ultimo_login = NULL;
                $this->_DAOUsuarios->update(
                        array("usr_password" => $cadenahash, "usr_salt" => $salt, "usr_ultimo_login" => $ultimo_login), $usuario->usr_id, "usr_id"
                );

                $this->load->lib('Email', false);
                $remitente = "midas@minsal.cl";
                $nombre_remitente = "Prevención de Femicidios";
                $destinatario = $usuario->usr_email;

                $asunto = "PREDEFEM - Recuperar contraseña";
                $mensaje = $this->smarty->fetch("login/recuperar_password_rut.tpl");
                Email::sendEmail($destinatario, $remitente, $nombre_remitente, $asunto, $mensaje);
            } else {
                $correcto = false;
                $error['rut'] = "";
            }
        }

        $salida = array("rut" => $rut, "error" => $error,
            "correcto" => $correcto);

        $json = Zend_Json::encode($salida);
        echo $json;
    }

    /*
      public function validaRutMidas(){
      $parametros   = $this->request->getParametros();
      $json         = array();

      print_r($parametros);
      die();

      if(isset($parametros[0])){
      $url = trim($parametros[0],'?');
      $url = explode("=",$url);
      $rut = trim($url[1]);

      if(is_null($rut) or empty($rut)){
      die();
      }

      $usuario = $this->_DAOUsuarios->getByRut($rut);

      if(count($usuario) > 0){
      $json['rut']       = $usuario->rut;
      $json['nombres']   = $usuario->nombres;
      $json['apellidos'] = $usuario->apellidos;
      $json['email']     = $usuario->email;

      echo json_encode($json);
      }
      }else{
      echo false;
      }
      }
     */

    /*
      function loginRemoto(){
      $rut   = $this->_request->getParam('rut');
      $json         = array();

      if(isset($rut)){

      $usuario = $this->_DAOUsuarios->getByRut($rut);
      //print_r($usuario);die;
      $session 			        = New Zend_Session_Namespace("usuario_carpeta");
      $session->id 		        = $usuario->id;
      $session->region 		    = $usuario->id_region;
      $session->gl_ocultar_tour   = $usuario->gl_ocultar_tour;
      $session->rut 		        = $usuario->rut;
      $session->usuario 	        = $usuario->nombres." ".$usuario->apellidos;

      setcookie('datos_usuario_carpeta', $usuario->id, time() + 365 * 24 * 60 * 60);
      if($usuario->bo_password==1){
      header('Location: '.BASE_URI.'/Home/dashboard');
      }else{
      header('Location: '.BASE_URI.'/Login/actualizar');
      }
      }else{
      $this->smarty->assign("hidden","");
      $this->smarty->display('login/login.tpl');
      }
      }
     */
}
