<?php

include_once(APP_PATH . "models/DAOUsuario.php");
include_once(APP_PATH . "models/DAOPerfil.php");
include_once(APP_PATH . "models/DAOPerfilOpcion.php");
include_once(APP_PATH . "models/DAOOpcion.php");

/**
 * @param array $params
 * @param Smarty $smarty
 * @return string html
 */
function smarty_function_htmlMenu($params, &$smarty) {
    $DAOUsuario			= New DAOUsuario();
    $DAOPerfil			= New DAOPerfil();
	$DAOPerfilOpcion	= New DAOPerfilOpcion();
	$DAOOpcion			= New DAOOpcion();
    $sesion				= New Zend_Session_Namespace("usuario_carpeta");

    $id_usuario			= $sesion->id;
    $usuario			= $DAOUsuario->getById($id_usuario);
    $id_perfil			= $usuario->id_perfil;
	$opciones			= $DAOPerfilOpcion->getOpcionesRaiz($id_perfil);
	$subOpciones		= $DAOPerfilOpcion->getSubOpciones($id_perfil);

	$smarty->assign("opciones", $opciones);
	$smarty->assign("subOpciones", $subOpciones);
	if(!is_null($usuario)){
        return $smarty->fetch("plugins/view/menu.tpl");
    }
}