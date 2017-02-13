<?php 


class CargaMasiva extends Controller{


	function __construct(){
		parent::__construct();
	}


	public function cargarSaludPublica(){
		$file = fopen('salud_publica.csv','r');

		if($file){
			$daoDocumento = $this->load->model('DAODocumento');

			$total = 0;
			$total_ingresados = 0;
			while(($datos = fgetcsv($file,0,';')) !== FALSE){
				$total++;
				$tipo_documento = '';
				if(trim($datos[5]) == 'Factura')
					$tipo_documento = 1;
				elseif(trim($datos[5]) == 'NOTA DE CREDITO' or trim($datos[5]) == 'Nota de Credito')
					$tipo_documento = 2;
				elseif(trim($datos[5]) == 'NOTA DE DEBITO' or trim($datos[5]) == 'Nota de Debito')
					$tipo_documento = 3;
				elseif(trim($datos[5]) == 'BH')
					$tipo_documento = 4;
				elseif(trim($datos[5]) == 'REEMBOLSO' or trim($datos[5]) == 'REEMBOLSOS')
					$tipo_documento = 5;
				elseif(trim($datos[5]) == 'ARRIENDO')
					$tipo_documento = 6;
				elseif(trim($datos[5]) == 'BOLETA')
					$tipo_documento = 7;
				elseif(trim($datos[5]) == 'Factura de Compra')
					$tipo_documento = 8;
				elseif(trim($datos[5]) == 'FONDO FIJO')
					$tipo_documento = 9;
				elseif(trim($datos[5]) == 'GASTOS COMUNES')
					$tipo_documento = 10;
				elseif(trim($datos[5]) == 'RENDICION')
					$tipo_documento = 11;

				$estado_documento = 0;
				if(trim(strtolower($datos[12])) == 'devengada')
					$estado_documento = 4;
				elseif(trim(strtolower($datos[12])) == 'devuelta al proveedor')
					$estado_documento = 3;

				$fecha_oficina = explode('-',trim($datos[10]));
				$fecha_oficina = $fecha_oficina[2].'-'.$fecha_oficina[1].'-'.$fecha_oficina[0];

				$parametros = array(
					'cd_usuario_solicitud' => 1,
					'fc_fecha_solicitud' => date('Y-m-d H:i:s'),
					'cd_subsecretaria_solicitud' => 1,
					'cd_tipo_documento_solicitud' => $tipo_documento,
					'nr_numero_documento_solicitud' => trim($datos[6]),
					'gl_rut_emisor_solicitud' => trim($datos[3]),
					'gl_descripcion_solicitud' => nl2br(trim($datos[8])),
					'fc_fecha_ingreso_partes_solicitud' => $fecha_oficina,
					'gl_nombre_emisor_solicitud' => trim($datos[4]),
					'cd_subtitulo_presupuestario_solicitud' => trim($datos[11]),
					'cd_estado_solicitud' => $estado_documento,
					'nr_monto_solicitud' => str_replace('.','',trim($datos[9])),
					'nr_folio_sigfe_solicitud' => trim($datos[13])
					);

				if($daoDocumento->insert($parametros)){
					$total_ingresados++;
				}else{
					echo "Error en registro fila ".$total."<br/>";
				}
			}

			echo 'Se han ingresado '.$total_ingresados.' registros de un total de '.$total;
		}else{
			echo "Archivo no encontrado";
		}
	}


	public function cargarRedesAsistenciales(){
		$file = fopen('redes_asistenciales.csv','r');

		if($file){
			$daoDocumento = $this->load->model('DAODocumento');

			$total = 0;
			$total_ingresados = 0;
			while(($datos = fgetcsv($file,0,';')) !== FALSE){
				$total++;
				$tipo_documento = '';
				if(trim($datos[5]) == 'Factura')
					$tipo_documento = 1;
				elseif(trim($datos[5]) == 'NOTA DE CREDITO' or trim($datos[5]) == 'Nota de Credito')
					$tipo_documento = 2;
				elseif(trim($datos[5]) == 'NOTA DE DEBITO' or trim($datos[5]) == 'Nota de Debito')
					$tipo_documento = 3;
				elseif(trim($datos[5]) == 'BH')
					$tipo_documento = 4;
				elseif(trim($datos[5]) == 'REEMBOLSO' or trim($datos[5]) == 'REEMBOLSOS')
					$tipo_documento = 5;
				elseif(trim($datos[5]) == 'ARRIENDO')
					$tipo_documento = 6;
				elseif(trim($datos[5]) == 'BOLETA')
					$tipo_documento = 7;
				elseif(trim($datos[5]) == 'Factura de Compra')
					$tipo_documento = 8;
				elseif(trim($datos[5]) == 'FONDO FIJO')
					$tipo_documento = 9;
				elseif(trim($datos[5]) == 'GASTOS COMUNES')
					$tipo_documento = 10;
				elseif(trim($datos[5]) == 'RENDICION')
					$tipo_documento = 11;

				$estado_documento = 0;
				if(trim(strtolower($datos[12])) == 'devengada')
					$estado_documento = 4;
				elseif(trim(strtolower($datos[12])) == 'devuelta al proveedor')
					$estado_documento = 3;
				elseif(trim(strtolower($datos[12])) == 'archivado en contabilidad')
					$estado_documento = 5;
				elseif(trim(strtolower($datos[12])) == 'duplicidad en registro')
					$estado_documento = 6;

				$fecha_oficina = explode('-',trim($datos[10]));
				$fecha_oficina = $fecha_oficina[2].'-'.$fecha_oficina[1].'-'.$fecha_oficina[0];

				$parametros = array(
					'cd_usuario_solicitud' => 1,
					'fc_fecha_solicitud' => date('Y-m-d H:i:s'),
					'cd_subsecretaria_solicitud' => 2,
					'cd_tipo_documento_solicitud' => $tipo_documento,
					'nr_numero_documento_solicitud' => trim($datos[6]),
					'gl_rut_emisor_solicitud' => trim($datos[3]),
					'gl_descripcion_solicitud' => nl2br(trim($datos[8])),
					'fc_fecha_ingreso_partes_solicitud' => $fecha_oficina,
					'gl_nombre_emisor_solicitud' => trim($datos[4]),
					'cd_subtitulo_presupuestario_solicitud' => trim($datos[11]),
					'cd_estado_solicitud' => $estado_documento,
					'nr_monto_solicitud' => str_replace('.','',trim($datos[9])),
					'nr_folio_sigfe_solicitud' => trim($datos[13])
					);

				if($daoDocumento->insert($parametros)){
					$total_ingresados++;
				}else{
					echo "Error en registro fila ".$total."<br/>";
				}
			}

			echo 'Se han ingresado '.$total_ingresados.' registros de un total de '.$total;
		}else{
			echo "Archivo no encontrado";
		}
	}


}