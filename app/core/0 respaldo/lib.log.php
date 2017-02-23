<?php if(!defined('BASE_PATH')) exit('No se permite acceder a este script');

class Log{

	/**
	 * [logMessage description]
	 * @param  [type] $tipo    [description]
	 * @param  [type] $mensaje [description]
	 * @return [type]          [description]
	 */
	public function logMessage($tipo,$mensaje){
		$today = date("Y-m-d");
		$fileLog = RUTA_LOG.'log-'.$today.'log';

		if(!is_dir(RUTA_LOG)){
			mkdir(RUTAL_LOG,0777);
		}
		if(!file_exists($fileLog)){
			$log = fopen($fileLog,'w+');
		}else{
			$log = fopen($fileLog,'a+');
		}

		$mensaje = $today . " - " . $tipo . " : " .$mensaje;
		fputs($log,$mensaje);

		fclose($log);

	}
}
?>