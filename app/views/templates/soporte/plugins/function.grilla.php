<?php
	/**
	* 
	* @param array $params
	* @param Smarty $smarty
	* @return string html
	*/

	function smarty_function_grilla($params, &$smarty)
	{
		$sesion = New Zend_Session_Namespace("usuario");
		
		#SOAP MESA MIDAS		
		$wsdl					= WSDL_SOPORTE;
		$ws						= new nusoap_client($wsdl,'wsdl');
        $ws->soap_defencoding	= 'UTF-8';
		$ws->decode_utf8 		= false;
		
		if($ws->getError()){
			
		}else{
			$ws_data			= array(
										'key_public'	=> '7R4Ln875trPt8Ye1dLQDxHYpcKA51vqXL4egdPvuNUV2a',
										'rut_usuario'	=> $sesion->rut,
										);
			$param				= array('data' => $ws_data);
			$result				= $ws->call('obtenerSoportesUsuario', $param);
		}

		$arr_soportes			= array();
		if(is_array($result['arr_soportes'])){
			if(isset($result['arr_soportes'][0])){
				$arr_soportes	= $result['arr_soportes'];
			}else{
				$arr_soportes[] = $result['arr_soportes'];
			}
		}
		$smarty->assign("grilla", $arr_soportes);
		return $smarty->fetch("soporte/plugins/view/grilla.tpl");
	}