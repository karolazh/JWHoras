<?php

require_once(APP_PATH . "models/DAOSistemas.php");

/**
 * 
 * @param array $params
 * @param Smarty $smarty
 * @return string html
 */
function smarty_function_listaSistemas($params, &$smarty) {
    $DAOSistemas = New DAOSistemas();
    $lista = $DAOSistemas->listarSistemasPorUsuario($params["id"]);
    
    $html = "";
    
    if(!is_null($lista)){
        foreach($lista as $sistema){
            $html .= "<span class=\"badge\" style=\"margin-bottom:3px\">" . $sistema->nombre . "</span> ";
        }
    }
    
    return $html;
}

