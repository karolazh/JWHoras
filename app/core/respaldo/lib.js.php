<?php if(!defined('BASE_PATH')) exit('No se permite acceder a este script');

class Js{

	/**
	 * [alerta description]
	 * @param  [type] $mensaje [description]
	 * @return [type]          [description]
	 */
	public function alerta($mensaje){
		echo '<script>alert("'.$mensaje.'")</script>';
	}
}

?>