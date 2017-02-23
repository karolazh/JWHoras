<?php

require_once(APP_PATH . "models/DAOSistemas.php");

/**
 * 
 * @param array $params
 * @param Smarty $smarty
 * @return string html
 */
function smarty_function_grilla($params, &$smarty) {
    
    $DAOSistemas = New DAOSistemas();
    $lista = $DAOSistemas->listar("nombre");

    $smarty->assign("grilla", $lista);
    return $smarty->fetch("mantenedor_sistemas/plugins/view/grilla.tpl");
}

