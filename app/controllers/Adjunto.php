<?php
/**
 ******************************************************************************
 * Sistema           : PREVENCION DE FEMICIDIOS
 * 
 * Descripcion       : Controlador de archivos adjuntos
 *
 * Plataforma        : !PHP
 * 
 * Creacion          : 13/02/2017
 * 
 * @name             Adjunto.php
 * 
 * @version          1.0
 *
 * @author           Victor Retamal <victor.retamal@cosof.cl>
 * 
 ******************************************************************************
 * !ControlCambio
 * --------------
 * !cProgramador				!cFecha		!cDescripcion 
 * ----------------------------------------------------------------------------
 * <orlando.vazquez@cosof.cl>	06-03-2017	Modificadas referencias de DAO's y agregada información de autor.
 * ----------------------------------------------------------------------------
 * ****************************************************************************
 */
class Adjunto extends Controller{

    protected $_DAOAdjunto;

	function __construct() {
		parent::__construct();
        $this->load->lib('Boton', false);
		$this->load->lib('Fechas', false);
        $this->_DAOAdjunto			= $this->load->model("DAOAdjunto");
	}

    /**
	 * Descripción : Cargar Adjunto
	 * @author S/N
	 */
	public function cargarAdjunto(){
		$this->smarty->display('adjunto/cargar_adjunto.tpl');
        $this->load->javascript(STATIC_FILES . "js/templates/adjunto/adjunto.js");
	}

    /**
	 * Descripción : Guardar Adjunto
	 * @author S/N
	 */
	public function guardarAdjunto(){
		$adjunto	= $_FILES['adjunto'];

		if($adjunto['tmp_name'] != ""){
			$file		= fopen($adjunto['tmp_name'],'r+b');
			$contenido	= fread($file,filesize($adjunto['tmp_name']));
			fclose($file);

			if(!empty($contenido)){
				$arr_adjunto	= array(
									'id_adjunto'	=> 1,
									'id_mensaje'	=> 1,
									'nombre_adjunto'=> $adjunto['name'],
									'mime_adjunto'	=> $adjunto['type'],
									'contenido'		=> base64_encode($contenido)
								);
				$_SESSION['adjunto'][] = $arr_adjunto;	
				$success	= 1;
				$mensaje	= "El archivo <strong>".$adjunto['name']."</strong > ha sido Adjuntado";
			}else{
				$success	= 0;
				$mensaje	= "No se ha podido leer el archivo adjunto. Intente nuevamente";
			}
		}else{
			$success	= 0;
			$mensaje	= "Error al cargar el Adjunto. Intente nuevamente";	
		}

		if($success == 1){
			echo "<script>Adjunto.cargarListadoAdjuntos('listado-adjuntos'); parent.xModal.close();</script>";
		}else{
			$this->view->assign('success',$success);
			$this->view->assign('mensaje',$mensaje);

			$this->view->assign('template',$this->view->fetch('Adjunto/cargar_adjunto.tpl'));
			$this->view->display('template_iframe.tpl');
		}
	}

    /**
	 * Descripción : Cargar Listado
	 * @author S/N
	 */
	public function cargarListado(){
		$adjuntos	= array();
		$template	= '';

		if(isset($_SESSION['adjunto']))
		{
			$template.= '<div class="col-xs-6 col-xs-offset-3" id="div_adjuntos" name="div_adjuntos">
							<table id="adjuntos" class="table table-hover table-condensed table-bordered" align=center>
								<thead>
									<tr>
										<th>Nombre Archivo</th>
										<th width="50px" nowrap>Descargar</th>
										<th width="50px" nowrap>Eliminar</th>
									</tr>
								</thead>
								<tbody>';
			$adjuntos	= $_SESSION['adjunto'];
			$i			= 0;
			foreach($adjuntos as $adjunto)
			{
				$template.= '	<tr>
									<td>
										<strong>'.$adjunto['nombre_adjunto'].'</strong>
									</td>
									<td><a class="btn btn-xs btn-primary" href="javascript:void(0);" onclick="window.open(\''.BASE_URI.'/Adjunto/verAdjunto/'.$i.'\',\'_blank\');">
											<i class="fa fa-download fa-2x"></i>
										</a>
									</td>
									<td>
										<button class="btn btn-xs btn-danger" type="button" onclick="Adjunto.borrarAdjunto('.$i.')">
											<i class="fa fa-trash-o fa-2x"></i>
										</button>
									</td>
								</tr>';
				$i++;
			}

			$template.= '		</tbody>
							</table>
						</div>';
		}

		echo $template;
	}

    /**
	 * Descripción : Borrar Adjunto
	 * @author S/N
	 */
	public function borrar(){
		$id_adjunto	= $_POST['adjunto'];
		$template	= '';
		unset($_SESSION['adjunto'][$id_adjunto]);

		if(count($_SESSION['adjunto']) > 0)
		{
			$template.= '<div class="col-xs-6 col-xs-offset-3" id="div_adjuntos" name="div_adjuntos">
							<table id="adjuntos" class="table table-hover table-condensed table-bordered" align=center>
								<thead>
								<tr>
									<th>Nombre Archivo</th>
									<th width="50px" nowrap>Descargar</th>
									<th width="50px" nowrap>Eliminar</th>
								</tr>
								</thead>
								<tbody>';
			$adjuntos	= $_SESSION['adjunto'];
			$i			= 0;
			unset($_SESSION['adjunto']);

			foreach($adjuntos as $adjunto)
			{
				$_SESSION['adjunto'][] = $adjunto;
				$template.= '	<tr>
									<td>
										<strong>'.$adjunto['nombre_adjunto'].'</strong>
									</td>
									<td><a class="btn btn-xs btn-primary" href="javascript:void(0);" onclick="window.open(\''.BASE_URI.'/Adjunto/verAdjunto/'.$i.'\',\'_blank\');">
											<i class="fa fa-download fa-2x"></i>
										</a>
									</td>
									<td>
										<button class="btn btn-xs btn-danger" type="button" onclick="Adjunto.borrarAdjunto('.$i.')">
											<i class="fa fa-trash-o fa-2x"></i>
										</button>
									</td>
								</tr>';
				$i++;
			}

			$template.= '		</tbody>
							</table>
						</div>';
		}

		echo $template;
	}

    /**
	 * Descripción : Ver Adjunto
	 * @author S/N
	 */
    public function ver(){
        $id_adjunto = Request::getParametros(0);

        if(isset($_SESSION['adjuntos'][$id_adjunto])){
            $adjunto = $_SESSION['adjuntos'][$id_adjunto];
            header("Content-Type: ".$adjunto['mime_adjunto']);
            header("Content-Disposition: inline; filename=".$adjunto['nombre_adjunto']);
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            ob_end_clean();
            echo base64_decode($adjunto['contenido']);
            exit();
        }elseif(isset($_SESSION['adjunto'][$id_adjunto])){
            $adjunto = $_SESSION['adjunto'][$id_adjunto];
            header("Content-Type: ".$adjunto['mime_adjunto']);
            header("Content-Disposition: inline; filename=".$adjunto['nombre_adjunto']);
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            ob_end_clean();
            echo base64_decode($adjunto['contenido']);
            exit();
        }else{
            echo "El adjunto no existe";
        }
    }

}