<?php

require_once(APP_PATH . 'models/DAOOficina.php');

function smarty_function_selectOficina($params, &$smarty) {
    $DAO = New DAOOficina();
    $lista = $DAO->listar("nombre");
    
    $html = "<select style=\"width:100%\" multiple=\"multiple\" name=\"" . $params["nombre"] . "[]\" id=\"" . $params["nombre"] . "\" class=\"" . $params["class"] . "\">";
    $html .= "<option value=\"\"></option>";
    
    if(count($lista)>0){
        foreach($lista as $key => $row){
            $selected = "";
            if(is_array($params["default"]) && in_array($row->id, $params["default"])){
                $selected = "selected";
            }
            $html .= "<option value=\"".$row->id."\" " . $selected . ">"
                    . $row->nombre
                   . "</option>";
        }
    }
    $html .= "</select>";
    
    return $html;
}

