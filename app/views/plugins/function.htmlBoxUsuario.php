<?php

include_once(APP_PATH . "models/DAOUsuario.php");
include_once(APP_PATH . "models/DAOPerfil.php");

/**
 * @param array $params
 * @param Smarty $smarty
 * @return string html
 */
function smarty_function_htmlBoxUsuario($params, &$smarty) {
    
    $DAOUsuario = New DAOUsuario();
    $DAOPerfil	= New DAOPerfil();
    
    $sesion		= New Zend_Session_Namespace("usuario_carpeta");
    $id_usuario	= $sesion->id;    
    $usuario	= $DAOUsuario->getById($id_usuario);
    $perfil		= $DAOPerfil->getById($usuario->id_perfil);

    if(!is_null($usuario)){
        $smarty->assign("rut", $usuario->gl_rut);
        $smarty->assign("id_usuario", $usuario->id_usuario);
        $smarty->assign("id_usuario_original", $sesion->id_usuario_original);
        $smarty->assign("usuario", $usuario->gl_nombres . " " . $usuario->gl_apellidos);
        $smarty->assign("gl_nombre_perfil", $perfil->gl_nombre_perfil);
        $smarty->assign("id_perfil", $perfil->id_perfil);
        return $smarty->fetch("plugins/view/box_usuario.tpl");
    }

}