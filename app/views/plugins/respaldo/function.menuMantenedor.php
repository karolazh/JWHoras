<?php

require_once(APP_PATH . "models/DAOUsuarios.php");
require_once(APP_PATH . "models/DAOPerfil.php");

/**
 * 
 * @param array $params
 * @param Smarty $smarty
 * @return string html
 */
function smarty_function_menuMantenedor($params, &$smarty) {
    $sesion = New Zend_Session_Namespace("usuario_carpeta");
    
    $DAOUsuarios = New DAOUsuarios();
    $usuario = $DAOUsuarios->getById($sesion->id);
    if($usuario->id_perfil == DAOPerfil::ADMINSTRADOR){
        return $smarty->fetch("plugins/view/mantenedores.tpl");
    }
}
