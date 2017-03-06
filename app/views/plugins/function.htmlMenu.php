<?php

require_once(APP_PATH . "models/DAOUsuario.php");

/**
 * 
 * @param array $params
 * @param Smarty $smarty
 * @return string html
 */
function smarty_function_htmlMenu($params, &$smarty) {
    
    $DAOUsuario = New DAOUsuario();
    
    $sesion = New Zend_Session_Namespace("usuario_carpeta");
    $id_usuario = $sesion->id;
    
    $usuario = $DAOUsuario->getById($id_usuario);
    if(!is_null($usuario)){
        return $smarty->fetch("plugins/view/menu.tpl");
    }
}