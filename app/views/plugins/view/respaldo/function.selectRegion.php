<?php

require_once(APP_PATH . 'models/DAORegion.php');

function smarty_function_selectRegion($params, &$smarty) {
    $DAORegion = New DAORegion();
    $lista = $DAORegion->listar("reg_nombre");
    $rel = "";
    if(!empty($params["rel"])){
        $rel = "rel=\"" . $params["rel"] . "\"";
    }
    
    $data_rel = "";   
    if(!empty($params["data_rel"])){
        $data_rel = "data-rel=\"" . $params["data_rel"] . "\"";
    }
    $html = "<select style=\"width:100%\" name=\"" . $params["nombre"] . "\" id=\"" . $params["nombre"] . "\" " . $data_rel . " " . $rel . " class=\"" . $params["class"] . "\">";
    $html .= "<option value=\"\">Seleccione una región</option>";
    foreach($lista as $key => $region){
        $selected = "";
		/*
        if($params["default"] == $region->id){
            $selected = "selected";
        }
		*/
        $html .= "<option value=\"".$region->reg_id."\" " . $selected . ">"
                . $region->reg_nombre
               . "</option>";
    }
    $html .= "</select>";
    
    return $html;
}



