<?php if(!defined('BASE_PATH')) exit('No se permite acceder a este script');

class Password{

	/**
	 * [passAleatorio description]
	 * @return [type] [description]
	 */
	public static function randomPass($largo=10){
		$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890_-?#*><";
		
		$longitudCadena = strlen($cadena);

		$pass = "";
		
		$longitudPass = $largo;

		for($i = 1 ; $i <= $longitudPass ; $i++){
			$pos = rand(0,$longitudCadena-1);
			$pass .= substr($cadena,$pos,1);
		}
		return $pass;

	}


	/**
	 * [passSha description]
	 * @param  [type] $pass [description]
	 * @return [type]       [description]
	 */
	public static function passSha($pass){
		return sha1($pass);
	}


	/**
	 * [passMd5 description]
	 * @param  [type] $pass [description]
	 * @return [type]       [description]
	 */
	public static function passMd5($pass){
		return md5($pass);
	}
}
?>