<?php if(!defined('BASE_PATH')) exit('No se permite acceder a este script');

class Url{


	/**
	 * [formarUrl description]
	 * @param  [type] $controlador [description]
	 * @param  [type] $metodo      [description]
	 * @param  [type] $parametros  [description]
	 * @return [type]              [description]
	 */
	public function formarUrl($controlador,$metodo,$parametros=null){
		$url = BASE_PATH . '?controller=' .$controlador . '&metodo=' .$metodo;
		return  $url;
	}


	/**
	 * [redireccionar description]
	 * @param  [type] $url [description]
	 * @return [type]      [description]
	 */
	public function redireccionar($url){
		header('Location:'.$url);
		//echo '<script>location.href="'.$url.'"</script>';
	}
}
?>