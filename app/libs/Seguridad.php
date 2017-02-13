<?php if(!defined('BASE_PATH')) exit('No permitido acceder a este script');

class Seguridad{

	public static function generar_sha512($string){
		return hash('sha512',$string);
	}

	public static function generar_sha256($string){
		return hash('sha256',$string);
	}

	public static function generar_sha1($string){
		return hash('sha1',$string);
	}

	/**
	 * [passAleatorio description]
	 * @return [type] [description]
	 */
	public static function randomPass($largo=6){
		$cadena			= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";		
		$longitudCadena	= strlen($cadena);
		$pass			= "";		
		$longitudPass	= $largo;

		for($i = 1 ; $i <= $longitudPass ; $i++){
			$pos = rand(0,$longitudCadena-1);
			$pass .= substr($cadena,$pos,1);
		}
		
		return $pass;
	}

	public static function validarSesionUsuario($url=null){
		
		if(Session::getSession('activo') == null){
			if($url){
				Session::setSession('url_redirect',$url);
			}
			header('Location:'.BASE_URI);
			#header('Location:http://midas.minsal.cl/');
		}
	}

	/*
	public static function validarFuncionPerfil($perfil,$funcion){
		$Loader			= new Loader();
		$daoPerfiles	= $Loader->model('DAOPerfiles');
		return $daoPerfiles->validarPerfilFuncion($perfil,$funcion);
	}
	*/

}