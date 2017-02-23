<?php

require_once(APP_PATH . 'models/DAORegion.php');

function smarty_function_selectRegionUsuario($params, &$smarty) {
    $DAORegion = New DAORegion();
    $lista = $DAORegion->listar("nombre");
    
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
		if($region->id == $_SESSION['usuario_carpeta']['region']){
			$html .= "<option value=\"".$region->id."\" " . $selected . ">"
					. $region->nombre
				   . "</option>";
		}		   
    }
    $html .= "</select>";
    
    return $html;
}



