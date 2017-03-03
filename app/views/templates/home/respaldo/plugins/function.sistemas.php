<?php

require_once(APP_PATH . "models/DAOSistemas.php");
require_once(APP_PATH . "models/DAOUsuarios.php");
require_once(APP_PATH . "models/DAOPerfil.php");

/**
 * 
 * @param array $params
 * @param Smarty $smarty
 * @return string html
 */
function smarty_function_sistemas($params, &$smarty) {
    $sesion = New Zend_Session_Namespace("usuario_carpeta");
    
    
    $DAOSistemas = New DAOSistemas();
    $DAOUsuarios = New DAOUsuarios();
    $usuario = $DAOUsuarios->getById($sesion->id);
	
    //Obtener lista de sistemas
    $lista_sistemas = $DAOSistemas->listar("nombre");

    $html = "";
 
    $string_validacion = md5($usuario->rut."345asd123fgh");
    
    $smarty->assign("rut", $usuario->rut);
    $smarty->assign("string_validacion", $string_validacion);
	
	
    foreach($lista_sistemas as $sistema){
        $tiene_acceso = false;

        $arr_acceso = array();
        if($sistema->url_valida_acceso != ""){
			if($sistema->id == 10){
				$arr_acceso = get_data("http://".$sistema->url_valida_acceso.$usuario->rut);
				$arr 	= explode('{', $arr_acceso);
				$arr_acceso 	= $arr[1];
				$arr_acceso 	= json_decode('{'.$arr_acceso,true);
			}
			else{
                $arr_acceso = json_decode(get_data("http://".$sistema->url_valida_acceso."?rut=".$usuario->rut),true);
        }	
		}	
		if(isset($arr_acceso['rut']) and trim(str_replace(".","",$arr_acceso['rut'])) == trim($usuario->rut)){
                $tiene_acceso = true;			
        }

        if($tiene_acceso){
            $smarty->assign("disponible", "si");				
        }else{
            $smarty->assign("disponible", "no");						
        }
        
        if(ENVIROMENT == "PROD"){
            $smarty->assign("url", $sistema->url_produccion);
        } else {
            $smarty->assign("url", $sistema->url_desarrollo);
        }
		
        $smarty->assign("id_sistema", $sistema->id);
		$smarty->assign("nombre", $sistema->nombre);
        $smarty->assign("color" , $sistema->gl_color);
        $smarty->assign("icono" , $sistema->gl_icono);
        $smarty->assign("descripcion", $sistema->descripcion);
        $smarty->assign("visible", $sistema->gl_activo);
        
        $html .= $smarty->fetch("home/plugins/view/sistema.tpl");
    }
    
    return $html;

}

function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
