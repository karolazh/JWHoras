<?php

/**
 * Retorna abecedario
 * @param array $params
 * @param Smarty $smarty
 * @return string html
 */
function smarty_function_abecedario($params, &$smarty) {
    $html = "";
    $separador = "";
    for($i=65; $i<=90; $i++) {  
        $html .= $separador . "<a href=\"javascript:void(0);\" class=\"btn btn-xs letra-abecedario\">" . chr($i) . "</a>"; 
        $separador = " | ";
    }
    return $html;
}