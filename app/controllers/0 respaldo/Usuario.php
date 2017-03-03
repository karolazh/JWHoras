<?php

class Usuario extends Controller{
    
    /**
     *
     * @var DAOUsuarios 
     */
    protected $_DAOUsuarios;
    
    /**
     *
     * @var DAOUsuariosSistema
     */
    protected $_DAOUsuariosSistema;
    
    /**
     *
     * @var DAOSistemas 
     */
    protected $_DAOSistemas;
    
    /**
     * Construct
     */
    function __construct(){
        parent::__construct();
        $this->_DAOUsuarios = $this->load->model("DAOUsuarios");
        $this->_DAOSistemas = $this->load->model("DAOSistemas");
        $this->_DAOUsuariosSistema = $this->load->model("DAOUsuariosSistema");
        $this->smarty->addPluginsDir(APP_PATH . "views/templates/mantenedor_usuarios/plugins/");
    }
    
    /**
     * 
     * @throws Exception
     */
    public function modificar_datos(){
        Acceso::set("ALL");
        
        $this->_addJavascript(STATIC_FILES.'js/templates/usuario/form.js');
        
        $usuario = $this->_getUsuario();
        if(!is_null($usuario)){
            $this->smarty->assign("item", $usuario);
            $sistemas = $this->_listaSistemasUsuario($usuario->id);
            $oficinas = $this->_listaOficinasUsuario($usuario->id);			
			
            $this->smarty->assign("region", $usuario->id_region);
            $this->smarty->assign("oficinas", $oficinas);
            $this->smarty->assign("sistemas", $sistemas);			
           
        } else {
            throw new Exception("El usuario no existe");
        }
        $this->_display('usuario/modificar_datos.tpl');
    }
    
    /**
     * 
     */
    public function modificar_datos_guardar(){
        Acceso::set("ALL");
        
        header('Content-type: application/json');
        
        $validar = $this->load->lib("Helpers/Validar/ModificarDatosUsuario", true, "Validar_ModificarDatosUsuario", $this->_request->getParams());
        if($validar->isValid()){
            $guardar = $this->load->lib("Helpers/Guardar/ModificarDatosUsuario", true, "Guardar_ModificarDatosUsuario", $this->_request->getParams());
            $guardar->guardar();
        }
        
        $salida = array("error"    => $validar->getErrores(),
                        "correcto" => $validar->getCorrecto());
        
        $json = Zend_Json::encode($salida);
        echo $json;
    }
    
    /**
     * 
     */
    public function peticion_modificar_password(){
        Acceso::set("ALL");
        $this->_addJavascript(STATIC_FILES.'js/templates/usuario/password.js');
        $this->_display('usuario/peticion_modificar_password.tpl');
    }
    
    /**
     * 
     */
    public function peticion_modificar_password_email(){
        Acceso::set("ALL");
        header('Content-type: application/json');
        $usuario = $this->_getUsuario();
        
        $correcto = false;
        
        $valido = New Zend_Validate_EmailAddress();
        if($valido->isValid($usuario->email)){
            $correcto = true;
            $string = $this->load->lib("Helpers/String", true, "String");
            $cadena = $string->cadenaAleatoria();
            
            $this->smarty->assign("nombre", $usuario->nombres . " " . $usuario->apellidos);
            $this->smarty->assign("url", HOST . "index.php/Usuario/modificar_password/" . $cadena);
            
            $this->_DAOUsuarios->update(
                                        array("codigo_cambiar_password" => $cadena,
                                              "bo_cambiar_password" => 1), 
                                        $usuario->id
                                       );
            
            $email = $this->load->lib("Helpers/Email", true, "Email");
            $email->from("midas@minsal.cl", "Midas");
            $email->to($usuario->email, $usuario->nombres . " " . $usuario->apellidos);
            $email->subject("MIDAS - Petición de modificación de contraseña");
            $email->setContent($this->smarty->fetch("usuario/peticion_modificar_password_email.tpl"));
            $email->send();
        }
        
        $salida = array("email"    => $usuario->email,
                        "correcto" => $correcto);
        
        $json = Zend_Json::encode($salida);
        echo $json;
    }
    
    /**
     * Formulario para modificar password
     * @throws Exception
     */
    public function modificar_password(){
        $this->_addJavascript(STATIC_FILES.'js/templates/usuario/modificar_password.js');
        
        $parametros = $this->request->getParametros();
        $codigo = $parametros[0];
        
        $usuario = $this->_DAOUsuarios->getByCodigo($codigo);
        if(!is_null($usuario) AND $usuario->bo_cambiar_password == 1){
            $this->smarty->assign("codigo", $codigo);
            $this->_display('usuario/modificar_password.tpl');
        } else {
            throw new Exception("El código no es valido");
        }
    }
    
     /**
     * Guarda el nuevo password
     */
    public function modificar_password_guardar(){
        header('Content-type: application/json');
        
        $validar = $this->load->lib("Helpers/Validar/ActualizarPassword", true, "Validar_ActualizarPassword", $this->_request->getParams());
        if($validar->isValid()){
            $usuario = $this->_DAOUsuarios->getByCodigo($this->_request->getParam("id"));
            $data = array("password" => sha1($this->_request->getParam("password")),
                          "codigo_cambiar_password" => "",
                          "bo_cambiar_password" => 0,
                          "bo_password" => 1);
            $this->_DAOUsuarios->update($data, $usuario->id);
        }
        $salida = array("error"    => $validar->getErrores(),
                        "correcto" => $validar->getCorrecto());
        
        $json = Zend_Json::encode($salida);
        echo $json;
    }
    
    /**
     * 
     * @return array
     */
    protected function _getUsuario(){
        $session = New Zend_Session_Namespace("usuario_carpeta");
        $id_user = $session->id;
        return $this->_DAOUsuarios->getById($id_user);
    }
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

