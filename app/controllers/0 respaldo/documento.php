<?php

class Documento extends Controller
{

    /**
     *
     * @var DAOUsuarios
     */
    protected $_DAOUsuarios;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->_DAOUsuarios = $this->load->model("DAOUsuarios");
        $this->_DAODocumento = $this->load->model("DAODocumento");
        $this->_DAOAdjuntos = $this->load->model("DAOAdjuntos");
        $this->_DAOHistorial = $this->load->model('DAOHistorial');

        //BC
        $this->_DAOTipoBoletas = $this->load->model('DAOTipoBoletas');

    }

    /**
     * Index
     */
    public function index()
    {
        die("nada que mostrar");
    }

    public function Nuevo()
    {

        if (isset($_SESSION['adjuntos'])) {
            unset($_SESSION['adjuntos']);
        }

        $_DAOSubsecretaria = $this->load->model('DAOSubsecretaria');
        $_DAOTipoDocumentos = $this->load->model('DAOTipoDocumentos');
        $_DAOTipoCompra = $this->load->model('DAOTipoCompra');

        $subsecretarias = $_DAOSubsecretaria->getListado();
        $tipo_documentos = $_DAOTipoDocumentos->getListado();
        $tipo_compras = $_DAOTipoCompra->getListado();

        $visadores_publica = $this->_DAOUsuarios->getUsuariosPorPerfil(2);
        $visadores_redes = $this->_DAOUsuarios->getUsuariosPorPerfil(3);
        $visadores = array();
        foreach ($visadores_publica as $item) {
            $visadores[] = $item;
        }
        foreach ($visadores_redes as $item) {
            $visadores[] = $item;
        }


        $this->smarty->assign('subsecretarias', $subsecretarias);
        $this->smarty->assign('tipo_documentos', $tipo_documentos);
        $this->smarty->assign('tipo_compras', $tipo_compras);
        $this->smarty->assign('visadores', $visadores);
        $this->_display('Documentos/Nuevo/nuevo.tpl');
        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
        $this->load->javascript(STATIC_FILES . 'js/plugins/typeahead/js/bootstrap-typeahead.min.js');
        $this->load->javascript(STATIC_FILES . 'js/templates/documento/documentos.js');
        $this->load->javascript('$(".datepicker").datepicker();');
        $this->load->javascript('Documento.initAutocompleteRutEmisor();');
    }

    public function boletas(){
         //$this->_display('app/views/plugins/view/menu.tpl');
        $_DAOSubsecretaria = $this->load->model('DAOSubsecretaria');
        $subsecretarias = $_DAOSubsecretaria->getListado();
        $_DAOTipoBoletas = $this->load->model('DAOTipoBoletas');
        $tipo_boletas = $_DAOTipoBoletas->getListado();
        $this->smarty->assign('subsecretarias', $subsecretarias);
        $this->smarty->assign('tipo_boleta', $tipo_boletas);
        $this->_display('Documentos/Nuevo/nueva_boleta.tpl');
        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
        $this->load->javascript(STATIC_FILES . 'js/plugins/typeahead/js/bootstrap-typeahead.min.js');
        $this->load->javascript(STATIC_FILES . 'js/templates/documento/documentos.js');
        $this->load->javascript('$(".datepicker").datepicker();');
        $this->load->javascript('Documento.initAutocompleteRutEmisor();');
    }

    public function centrosResponsabilidad()
    {
        $id_subsecretaria = null;

        if (isset($_POST['subsecretaria'])) {
            $id_subsecretaria = $_POST['subsecretaria'];
        }

        $_DAOCentroResponsabilidad = $this->load->model('DAOCentroResponsabilidad');
        $centros = $_DAOCentroResponsabilidad->getListado($id_subsecretaria);
        $json = array();
        $i = 0;
        foreach ($centros as $centro) {
            $json[$i]['nombre'] = $centro->nombre_centroresponsabilidad;
            $json[$i]['id'] = $centro->id_centroresponsabilidad;
            $json[$i]['codigo'] = $centro->codigo_centroresponsabilidad;
            $i++;
        }

        echo json_encode($json);
    }


    public function Asignados()
    {
        $session = New Zend_Session_Namespace("usuario_carpeta");

        $arr = $this->_DAODocumento->getDocumentosAsignados($session->id, 0);
        $this->smarty->assign('arrResultado', $arr);
        $this->smarty->assign('Fechas', $this->load->lib('Fechas', false));
        $this->_display('Documentos/Grillas/Asignados.tpl');
        $this->load->javascript(STATIC_FILES . 'js/templates/documento/documentos.js');

    }

    public function Todo()
    {
        $this->load->lib('Fechas', false);
        $this->load->lib('Constantes', false);

        if ($_SESSION['perfil'] == 1) {
            $arr = $this->_DAODocumento->getDocumentosAsignados();
        } else {
            $session = New Zend_Session_Namespace("usuario_carpeta");
            $arr = $this->_DAODocumento->getDocumentosAsignados($session->id);
        }

        $tmp_arr = array();

        foreach ($arr as $item) {
            if ($item->cd_estado_solicitud == 0) {
                $item->dias_bandeja = Fechas::diffDias(date('Y-m-d'), $item->fc_fecha_ingreso_partes_solicitud, true) - $item->total_dias_feriados;
            } else {
                $evento = $this->_DAOHistorial->obtHistorialVisacionDocumento($item->id_solicitud, Constantes::DOCUMENTO_APROBADO, Constantes::DOCUMENTO_RECHAZADO);
                if ($evento) {
                    $item->dias_bandeja = Fechas::diffDias($evento->fc_fecha_historial, $item->fc_fecha_ingreso_partes_solicitud, true) - $item->total_dias_feriados;
                    $item->fecha_visacion = Fechas::formatearHtml($evento->fc_fecha_historial);
                } else {
                    $item->dias_bandeja = 'Sin fechas';
                    $item->fecha_visacion = 'Sin fecha';
                }
            }
            $tmp_arr[] = $item;
        }

        $this->smarty->assign('arrResultado', $tmp_arr);
        $this->smarty->assign('Fechas', $this->load->lib('Fechas', false));
        $this->_display('Documentos/Grillas/Todo.tpl');
        $this->load->javascript(STATIC_FILES . 'js/templates/documento/documentos.js');
    }


    public function Revision()
    {

        $arr = array();
        $documentos = $this->_DAODocumento->getDocumentosRevision(1);
        if ($documentos->numRows > 0) {
            $arr = $documentos->rows;
        }

        $this->smarty->assign('arrResultado', $arr);
        $this->smarty->assign('Fechas', $this->load->lib('Fechas', false));
        $this->_display('Documentos/Grillas/Revision.tpl');
        $this->load->javascript(STATIC_FILES . 'js/templates/documento/documentos.js');

    }

    /**
     * Resultados de búsqueda
     */
    public function buscar()
    {
        header('Content-type: application/json');

        $limit = array("comienzo" => $this->_request->getParam("page") - 1,
            "resultados" => 20);

        $lista = $this->_DAOUsuarios->listarBusqueda($this->_request->getParams(), $limit);
        $resultados = array();
        $cantidad = 0;
        if (!is_null($lista)) {
            foreach ($lista as $usuario) {
                $imagen = "images/personas/" . substr($usuario->rut, 0, -2) . ".jpg";
                if (file_exists("static/" . $imagen)) {
                    $imagen = "/images/personas/" . substr($usuario->rut, 0, -2) . ".jpg";
                } else {
                    $imagen = "/images/no-image.png";
                }
                $resultados["result"][] = array("image" => STATIC_FILES . $imagen,
                    "width" => "150",
                    "id" => $usuario->id,
                    "rut" => $usuario->rut,
                    "nombre" => $usuario->nombres . " " . $usuario->apellidos);
                $cantidad++;
            }
        }
        $resultados["total"] = $cantidad;

        echo Zend_Json_Encoder::encode($resultados);
    }

    public function detalleInstalacion()
    {

        $parametros = $this->request->getParametros();
        $idInstalacion = $parametros[0];

        //$arrSipresaId = $this->_DAOInstalacion->getDetalleInstalacion($idInstalacion)	;
        $arrSipresaId = $this->_DAODatosRemoto->getOrigenesRemotos("sipresa_id", "?id=" . $idInstalacion, false);
        $arrSumanet = $this->_DAODatosRemoto->getOrigenesRemotos("sumanet_3_sumarios", "?id=" . $idInstalacion, false);
        //$arrSumanet 	= $this->_DAODatosRemoto->getOrigenesRemotos("sumanet_3_sumarios","?id=12903",false)	;


        $arrSumanet = json_decode($arrSumanet);
        $arrSipresaId = json_decode($arrSipresaId);

        $resoluciones = array();


        foreach ($arrSipresaId->ambitos as $item) {
            $resoluciones[$item->gl_resolucion] = $item;
        }

        $arrSipresaId->arrResoluciones = $resoluciones;


        //print_r($arrSipresaId->resoluciones);

        //print_r($arrSipresaId->resoluciones);

        $e = str_replace(",", ".", $arrSipresaId->datos_generales->ins_c_coordenada_e);
        $n = str_replace(",", ".", $arrSipresaId->datos_generales->ins_c_coordenada_n);

        //Convertir coordenadas de UTM a LatLon
        $arrLatLong = ToLL($n, $e, 19);

        //Setear nuevas coordenadas	en datos nuevos
        $arrSipresaId->datos_generales->lat = $arrLatLong['lat'];
        $arrSipresaId->datos_generales->lon = $arrLatLong['lon'];

        $arrAmbitosResumen = array();
        foreach ($arrSipresaId->ambitos as $itm) {
            if (isset($arrAmbitosResumen[$itm->id_ambito])) {
                $arrAmbitosResumen[$itm->id_ambito] = $arrAmbitosResumen[$itm->id_ambito] + 1;
            } else {
                $arrAmbitosResumen[$itm->id_ambito] = 1;
            }
        }

        //print_r($arrAmbitosResumen);

        //print_r($arrSipresaId->datos_generales);

        /*
        if($idInstalacion == 207314){

            $arrSipresaId->datos_generales->gl_resolucion = 160540661;
        }

        if($idInstalacion == 206864){
            $arrSipresaId->datos_generales->gl_resolucion = 160550327;
        }
        */
        //echo "::".$arrSipresaId->datos_generales->gl_resolucion."::";


        //print_r($arrSipresaId->resoluciones);


        foreach ($arrSipresaId->resoluciones as $itemResolucion) {
            $strASD = $this->_DAODatosRemoto->getOrigenesRemotos("asd_antecedentes", "?gl_codigo=" . $itemResolucion->resolucion, false);
            $arrASD[$itemResolucion->resolucion] = json_decode($strASD);

            //$this->_DAOAdjuntos->exportarDesdeASD($idInstalacion,$arrASD);

        }


        //if(trim($arrSipresaId->datos_generales->gl_resolucion) != ""){


        //}

        //print_r($arrASD);
        //die();

        $arrAdjuntos = $this->_DAOAdjuntos->getAdjuntosInstalacion($idInstalacion);


        $arrAdjuntosTipo = array();
        foreach ($this->_DAOAdjuntos->getAdjuntosInstalacion($idInstalacion) as $itemAdjunto) {
            $arrAdjuntosTipo[$itemAdjunto->id_ambito][$itemAdjunto->id_tipo][] = $itemAdjunto;
        }


        $arrAdjuntosResumen = array();
        foreach ($arrAdjuntos as $itm) {
            if (isset($arrAdjuntosResumen[$itm->id_tipo])) {
                $arrAdjuntosResumen[$itm->id_tipo] = $arrAdjuntosResumen[$itm->id_tipo] + 1;
            } else {
                $arrAdjuntosResumen[$itm->id_tipo] = 1;
            }
        }

        foreach ($arrSipresaId->ambitos as $item) {

            $arrAmbitos[$item->id_ambito] = $item;

        }

        //Obtener adjuntos desde ASD


        //print_r($arrSipresaId->resoluciones);

        //print_r($arrSipresaId->arrResoluciones);

        //Llenar los arreglos de datos para el template
        $this->smarty->assign('idInstalacion', $idInstalacion);
        $this->smarty->assign('arrSipresa', $arrSipresaId->datos_generales);
        $this->smarty->assign('arrAdjuntos', $this->_DAOAdjuntos->getAdjuntosInstalacion($idInstalacion));
        $this->smarty->assign('arrAdjuntosASD', $arrASD);
        $this->smarty->assign('arrAdjuntosResumen', $arrAdjuntosResumen);
        $this->smarty->assign("arrAdjuntosTipo", $arrAdjuntosTipo);
        $this->smarty->assign('arrTipos', $this->_DAOAdjuntos->getTipos());
        $this->smarty->assign('arrAmbitos', $arrAmbitos);
        $this->smarty->assign('arrAmbitosBD', $this->_DAOAmbitos->getAmbitos());
        $this->smarty->assign('arrActividades', $arrSipresaId->actividades);
        $this->smarty->assign('arrCamposTipo', $this->_DAOAdjuntos->getTiposCampos());
        $this->smarty->assign('arrAmbitosResumen', $arrAmbitosResumen);
        $this->smarty->assign('arrSumarios', $arrSumanet->expedientes);
        $this->smarty->assign('arrSumariosArchivos', $arrSumanet->adjuntos);
        $this->smarty->assign('arrResoluciones', $arrSipresaId->arrResoluciones);

        $this->smarty->display('instalacion/detalleInstalacion.tpl');

    }

    //creada por BC
    public function guardarNuevaBoleta(){
        $session = New Zend_Session_Namespace("usuario_carpeta");
        $data = array();
        parse_str($_POST['data'], $data);

        $this->load->lib('Constantes', false);

        $json = array();
        $datos = $data;
        $fecha = explode('/', $datos['fecha_oficina_boleta']);
        $datos['fecha_oficina_boleta'] = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
        
        $insertar = $this->_DAODocumento->insBoleta($datos);
               
        if ($insertar) {
                $id_boleta = $insertar;
        }
        echo json_encode($json);
    }

  
    //fin creada por BC
    public function guardarNuevoDocumento()
    {
        $session = New Zend_Session_Namespace("usuario_carpeta");
        $data = array();
        parse_str($_POST['data'], $data);

        $this->load->lib('Constantes', false);

        $json = array();
        $datos = $data;
        $fecha = explode('/', $datos['fecha_oficina']);
        $datos['fecha_oficina'] = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
        $datos['cd_usuario_solicitud'] = $session->id;
        $datos['fc_fecha_soliticitud'] = date('Y-m-d H:i:s');

        /* validar existencia documento */
        $existe = $this->_DAODocumento->validarExistenciaDocumento($datos['subsecretaria'],$datos['tipo_documento'], trim($datos['numero_documento']), trim($datos['rut_emisor']));

        if ($existe) {
            $json['estado'] = false;
            $json['mensaje'] = 'Ya existe un documento ingresado del mismo tipo, mismo número y mismo rut emisor, con folio Nº'.$existe;
        } else {
            $insertar = $this->_DAODocumento->insDocumento($datos);
            if ($insertar) {
                $id_documento = $insertar;

                if (ENVIROMENT == 'PROD') {
                    $this->load->lib('Email', false);
                    $datosVisador = $this->_DAOUsuarios->getUsuarioPorId($datos['asignacion_visador']);
                    /* correo a visador */
                    $msg = '<h3>Documento asignado</h3>';
                    $msg .= 'Estimado/a <strong>' . $datosVisador->nombres . ' ' . $datosVisador->apellidos . '</strong>:<br/><br/>';
                    $msg .= 'Ud. tiene un documento pendiente de visación, correspondiente a:<br/>';
                    $msg .= 'Factura : '.trim($datos['numero_documento']).'<br/>';
                    $msg .= 'Nombre Proveedor : '.trim($datos['nombre_emisor']).'<br/>';
                    $msg .= 'Monto : $'.trim($datos['monto']).'<br/>';
                    $msg .= 'Correlativo : '.$id_documento.'<br/><br/>';
                    $msg .= 'Para ver el detalle completo de esta solicitud, por favor conectarse al módulo de Facturación. Para acceder a la plataforma pinche el siguiente link:';
                    $msg .= '<a href="' . HOST . '/finanzas/" target="_blank">' . HOST . '/finanzas</a>';
                    $msg .= '<p>Finanzas - ' . date('d/m/Y') . '</p>';

                    $destinatario = trim($datosVisador->email);
                    $remitente = 'Minsal - Finanzas';
                    $nombre_remitente = 'Minsal - Finanzas';
                    $asunto = 'Finanzas - Documento Asignado';
                    $mensaje = $msg;
                    Email::sendEmail($destinatario, $remitente, $nombre_remitente, $asunto, $mensaje);

                }


                if (isset($_SESSION['adjuntos']) and count($_SESSION['adjuntos'])) {
                    $_DAOArchivos = $this->load->model('DAOArchivos');
                    $ruta = 'documentos/' . $insertar;

                    if (!is_dir($ruta)) {
                        mkdir($ruta, 0777, true);
                    }
                    foreach ($_SESSION['adjuntos'] as $item) {
                        $data = array(
                            'solicitud' => $insertar,
                            'nombre' => $item['name'],
                            'ruta' => $ruta,
                            'sha' => $item['sha'],
                            'mime' => $item['type'],
                            'usuario_id' => $session->id,
                            'fecha' => $datos['fc_fecha_soliticitud']
                        );

                        $adjunto = fopen($ruta . '/' . $item['name'], 'w+b');
                        fwrite($adjunto, base64_decode($item['contenido']));
                        fclose($adjunto);

                        if (is_file($ruta . '/' . $item['name']) and is_readable($ruta . '/' . $item['name'])) {
                            $guardar = $_DAOArchivos->insArchivo($data);
                        }

                    }
                }
                $_DAOProveedores = $this->load->model('DAOProveedores');
                $proveedor = $_DAOProveedores->getProveedorPorRut(trim($datos['rut_emisor']));
                if (is_null($proveedor)) {
                    $data = array(
                        'rut' => trim($datos['rut_emisor']),
                        'nombre' => trim($datos['nombre_emisor']),
                        'vigencia' => 'Vigente',
                        'categoria' => 'Proveedor'
                    );
                    $insProveedor = $_DAOProveedores->guardarProveedor($data);
                }

                $json['estado'] = true;
                $json['mensaje'] = 'Documento #' . $id_documento . ' ingresado';

                $arr_historial = array(
                    'fecha' => date('Y-m-d H:i:s'),
                    'usuario' => $session->id,
                    'solicitud' => $insertar,
                    'evento' => Constantes::DOCUMENTO_NUEVO
                );
                $historial = $this->_DAOHistorial->insHistorial($arr_historial);

                unset($_SESSION['adjuntos']);
            } else {
                $json['estado'] = false;
                $json['mensaje'] = 'Hubo un problema al ingresar documento. Intente nuevamente';
            }
        }


        echo json_encode($json);

    }


    public function revisarDocumento()
    {

        $session = New Zend_Session_Namespace("usuario_carpeta");

        if (isset($_SESSION['adjuntos']))
            unset($_SESSION['adjuntos']);


        $params = $this->request->getParametros();
        $id_solicitud = $params[0];

        $solicitud = $this->_DAODocumento->getDocumentoPorId($id_solicitud);
        $_DAOArchivos = $this->load->model('DAOArchivos');

        $adjuntos = $_DAOArchivos->getArchivosSolicitud($id_solicitud);
        $this->load->lib('Fechas', false);
        $arr_adjuntos = array();
        $mostrar_fecha = false;
        if ($adjuntos) {
            $i = 0;
            foreach ($adjuntos as $item) {
                $_SESSION['adjuntos'][$i]['name'] = $item->gl_nombre_archivo;
                $_SESSION['adjuntos'][$i]['indice'] = $i;
                $_SESSION['adjuntos'][$i]['fecha'] = Fechas::formatearHtml($item->fc_fecha_archivo);
                $_SESSION['adjuntos'][$i]['usuario'] = $item->nombres . ' ' . $item->apellidos;
                $_SESSION['adjuntos'][$i]['usuario_id'] = $item->cd_usuario_fk_archivo;
                $_SESSION['adjuntos'][$i]['visador'] = true;
                $_SESSION['adjuntos'][$i]['type'] = $item->gl_mime_archivo;
                $_SESSION['adjuntos'][$i]['sha'] = $item->gl_sha_archivo;
                $_SESSION['adjuntos'][$i]['contenido'] = base64_encode(file_get_contents($item->gl_ruta_archivo . '/' . $item->gl_nombre_archivo));
                $i++;
            }
            $arr_adjuntos = $_SESSION['adjuntos'];
            /* foreach ($adjuntos as $item) {

                 $arr_adjuntos[$i]['nombre'] = $item->gl_nombre_archivo;
                 $arr_adjuntos[$i]['solicitud'] = $item->cd_solicitud_fk_archivo;
                 $arr_adjuntos[$i]['fecha'] = Fechas::formatearHtml($solicitud->fc_fecha_solicitud);
                 $mostrar_fecha = true;
                 $arr_adjuntos[$i]['indice'] = $item->gl_sha_archivo;
                 $i++;
             }*/
        }

        if (isset($params[1])) {
            $this->smarty->assign('lectura', true);
        }

        if($solicitud->cd_estado_solicitud == 0){
            $visadores = $this->_DAOUsuarios->getUsuariosPorPerfil(2);
            $this->smarty->assign('visadores',$visadores);
            
        }


        $historial = $this->_DAOHistorial->obtHistorialPorDocumento($id_solicitud);


        $this->smarty->assign('adjuntos', $arr_adjuntos);
        $this->smarty->assign('historial', $historial);
        $this->smarty->assign('mostrar_fecha', $mostrar_fecha);
        $this->smarty->assign('usuario', $session->id);
        $this->smarty->assign('solicitud', $solicitud);
        $this->smarty->assign('Fechas', $this->load->lib('Fechas', false));
        $this->smarty->display('Documentos/Nuevo/revisar.tpl');
        /*$this->load->javascript(STATIC_FILES . 'js/templates/documento/documentos.js');*/

    }


    public function aprobarDocumento()
    {
        $solicitud = $_POST['solicitud'];

        $this->load->lib('Fechas', false);
        $this->load->lib('Email', false);
        $this->load->lib('Constantes', false);

        $json = array();
        $parametros = array(
            'cd_estado_solicitud' => 1, /* estado aprobado */
            'fc_fecha_cambio_estado' => date('Y-m-d H:i:s')
        );
        if ($this->_DAODocumento->updDocumento($solicitud, $parametros)) {
            $session = New Zend_Session_Namespace("usuario_carpeta");
            $json['estado'] = true;
            $json['mensaje'] = 'Documento #' . $solicitud . ' aprobado';

            $solicitud = $this->_DAODocumento->getDocumentoPorId($solicitud);

            if (isset($_SESSION['adjuntos']) and count($_SESSION['adjuntos'])) {

                $_DAOArchivos = $this->load->model('DAOArchivos');
                $ruta = 'documentos/' . $solicitud->id_solicitud;

                $eliminar = $_DAOArchivos->delAdjuntosSolicitud($solicitud->id_solicitud);
                if (!is_dir($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                foreach ($_SESSION['adjuntos'] as $item) {
                    $data = array(
                        'solicitud' => $solicitud->id_solicitud,
                        'nombre' => $item['name'],
                        'ruta' => $ruta,
                        'sha' => $item['sha'],
                        'mime' => $item['type'],
                        'usuario' => $item['usuario'],
                        'usuario_id' => $item['usuario_id'],
                        'fecha' => Fechas::formatearBaseDatos($item['fecha'])
                    );

                    $adjunto = fopen($ruta . '/' . $item['name'], 'w+b');
                    fwrite($adjunto, base64_decode($item['contenido']));
                    fclose($adjunto);

                    if (is_file($ruta . '/' . $item['name']) and is_readable($ruta . '/' . $item['name'])) {
                        $guardar = $_DAOArchivos->insArchivo($data);
                    }

                }
            }

            $arr_historial = array(
                'fecha' => date('Y-m-d H:i:s'),
                'usuario' => $session->id,
                'solicitud' => $solicitud->id_solicitud,
                'evento' => Constantes::DOCUMENTO_APROBADO
            );
            $historial = $this->_DAOHistorial->insHistorial($arr_historial);

            /* correo a asantander@minsal.cl */

            $msg = '<h3>Documento APROBADO</h3>';
            $msg .= 'El documento que se detalla a continuacuón ha sido visado por <strong>'.$session->usuario.'</strong>:<br/>';
            $msg .= 'Factura: ' . $solicitud->nr_numero_documento_solicitud . '<br/>';
            $msg .= 'Nombre Proveedor: ' . $solicitud->gl_nombre_emisor_solicitud . '<br/>';
            $msg .= 'Monto: $' . number_format($solicitud->nr_monto_solicitud,0,',','.') . '<br/>';
            $msg .= 'Correlativo : ' . $solicitud->id_solicitud.'<br/><br/>';
            $msg .= 'Para ver el detalle completo de esta visación y proceder a su devengo, por favor conectarse al módulo de Facturación. Para acceder a la plataforma pinche el siguiente link: ';
            $msg .= '<a href="' . HOST . '/finanzas/" target="_blank">' . HOST . '/finanzas</a>';
            $msg .= '<p>Finanzas - '.date('d/m/Y').'</p>';

            $environment = '';
            if(ENVIROMENT != 'PROD')
                $environment = ENVIROMENT;

            $destinatario = 'asantander@minsal.cl';
            $remitente = 'Minsal - Finanzas';
            $nombre_remitente = 'Minsal - Finanzas';
            $asunto = 'Finanzas - Documento Aprobado '.$environment;
            $mensaje = $msg;


            Email::sendEmail($destinatario, $remitente, $nombre_remitente, $asunto, $mensaje);

        } else {
            $json['estado'] = false;
            $json['mensaje'] = 'Problemas al aprobar documento. Intente nuevamente';
        }

        echo json_encode($json);
    }


    public function guardarRechazo()
    {
        $comentario = $_POST['comentario'];
        $solicitud = $_POST['solicitud'];

        $this->load->lib('Fechas', false);
        $this->load->lib('Email', false);
        $this->load->lib('Constantes', false);

        $json = array();
        $parametros = array(
            'cd_estado_solicitud' => 2, /* estado rechazado */
            'gl_comentario_rechazo' => nl2br($comentario),
            'fc_fecha_cambio_estado' => date('Y-m-d H:i:s')
        );
        if ($this->_DAODocumento->updDocumento($solicitud, $parametros)) {
            $session = New Zend_Session_Namespace("usuario_carpeta");
            $json['estado'] = true;
            $json['mensaje'] = 'Documento #' . $solicitud . ' rechazado';

            $solicitud = $this->_DAODocumento->getDocumentoPorId($solicitud);

            $arr_historial = array(
                'fecha' => date('Y-m-d H:i:s'),
                'usuario' => $session->id,
                'solicitud' => $solicitud->id_solicitud,
                'evento' => Constantes::DOCUMENTO_RECHAZADO
            );
            $historial = $this->_DAOHistorial->insHistorial($arr_historial);

            /* correo a asantander@minsal.cl */
            $msg = '<h3>Documento RECHAZADO</h3>';
            $msg .= 'El documento que se detalla a continuación ha sido visado por: <strong>' . $session->usuario . '</strong><br/>';
            $msg .= 'Factura : ' . $solicitud->nr_numero_documento_solicitud . '<br/>';
            $msg .= 'Nombre Proveedor : ' . $solicitud->gl_nombre_emisor_solicitud . '<br/>';
            $msg .= 'Monto: $' . number_format($solicitud->nr_monto_solicitud,0,',','.') . '<br/>';
            $msg .= 'Correlativo : ' . $solicitud->id_solicitud.'<br/>';
            $msg .= 'Comentario rechazo : ' . $solicitud->gl_comentario_rechazo . '<br/>';
            $msg .= 'Fecha rechazo : ' . Fechas::formatearHtml($solicitud->fc_fecha_cambio_estado);
            $msg .= 'Para ver el detalle completo de esta visación y proceder a la devolución del documento, por favor conectarse al módulo de Facturación. Para acceder a la plataforma pinche el siguiente link: ';
            $msg .= '<a href="' . HOST . '/finanzas/" target="_blank">' . HOST . '/finanzas</a>';
            $msg .= '<p>Finanzas - '.date('d/m/Y').'</p>';

            $environment = '';
            if(ENVIROMENT != 'PROD')
                $environment = ENVIROMENT;

            $destinatario = 'asantander@minsal.cl';
            $remitente = 'Minsal - Finanzas';
            $nombre_remitente = 'Minsal - Finanzas';
            $asunto = 'Finanzas - Documento Rechazado '.$environment;
            $mensaje = $msg;
            Email::sendEmail($destinatario, $remitente, $nombre_remitente, $asunto, $mensaje);

        } else {
            $json['estado'] = false;
            $json['mensaje'] = 'Problemas al rechazar documento. Intente nuevamente';
        }

        echo json_encode($json);
    }


    public function getEmisores()
    {
        $rut = $_POST['search'];

        $_DAOProveedores = $this->load->model('DAOProveedores');

        $listado = $_DAOProveedores->getEmisorRut($rut);
        $json = array();
        $i = 0;
        foreach ($listado as $item) {
            $json['listado'][$i]['id'] = $item->id_proveedor;
            $json['listado'][$i]['rut'] = trim($item->gl_rut_proveedor);
            $json['listado'][$i]['nombre'] = trim($item->gl_nombre_proveedor);
            $i++;
        }

        echo json_encode($json);
    }


    public function grillaAsignados()
    {
        $session = New Zend_Session_Namespace("usuario_carpeta");

        $arr = $this->_DAODocumento->getDocumentosAsignados($session->id, 0);
        $this->smarty->assign('arrResultado', $arr);
        $this->smarty->assign('Fechas', $this->load->lib('Fechas', false));
        $template = $this->smarty->fetch('Documentos/Grillas/grilla_asignados.tpl');

        echo $template;
    }


    public function cargarVisadores()
    {
        $centro = $_POST['centro'];

        $_DAOVisadores = $this->load->model('DAOVisadores');
        $visadores = $_DAOVisadores->getVisadoresPorCentro($centro);

        $json = array();
        if ($visadores->numRows > 0) {
            $i = 0;
            $visadores = $visadores->rows;
            foreach ($visadores as $item) {
                $json[$i]['id'] = $item->id;
                $json[$i]['nombre'] = $item->nombres . " " . $item->apellidos;
                $i++;
            }
        }

        echo json_encode($json);

    }


    public function adjuntarArchivo($mensaje = null, $visador = null)
    {


        $params = $this->request->getParametros();
        if (isset($params[0]) and $params[0] > 0) {
            $this->smarty->assign('visador', $params[0]);
            $this->smarty->display('Documentos/Nuevo/adjuntar_archivo_visador.tpl');
        } else {
            if (!is_null($mensaje)) {
                $this->smarty->assign('mensaje', $mensaje);
            }
            if (!is_null($visador)) {
                $this->smarty->assign('visador', $visador);
                $this->smarty->display('Documentos/Nuevo/adjuntar_archivo_visador.tpl');
            } else {
                $this->smarty->display('Documentos/Nuevo/adjuntar_archivo.tpl');
            }

        }

    }

    //BC
    public function detalleBoleta(){
        $this->smarty->display('Documentos/Nuevo/detalle_boleta.tpl');
        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
        $this->load->javascript(STATIC_FILES . 'js/plugins/typeahead/js/bootstrap-typeahead.min.js');
        $this->load->javascript(STATIC_FILES . 'js/templates/documento/documentos.js');
        $this->load->javascript('$(".datepicker").datepicker();');
        //$this->load->javascript('Documento.initAutocompleteRutEmisor();');
     
    }

    //BC
    public function guardarDetalleBoleta(){
       //echo 'HOLA';
    }


    public function subirArchivo()
    {
        $archivo = $_FILES['archivo'];
        $error = false;
        $archivo['contenido'] = base64_encode(file_get_contents($archivo['tmp_name']));
        if ($archivo['error'] > 0) {
            $error = true;
            $mensaje = '<div class="alert alert-danger text-center">Error al subir archivo</div>';
        }

        if ($archivo['size'] == 0) {
            $error = true;
            $mensaje = '<div class="alert alert-danger text-center">Archivo con peso 0</div>';
        }

        if (empty($archivo['contenido'])) {
            $error = true;
            $mensaje = '<div class="alert alert-danger text-center">Archivo sin contenido</div>';
        }


        if (!$this->validarArchivo($archivo['type'])) {
            $error = true;
            $mensaje = '<div class="alert alert-danger text-center">Tipo de Archivo no permitido</div>';
        }

        if ($error) {
            $this->adjuntarArchivo($mensaje);
        } else {
            $this->load->lib('Fechas', false);
            $session = New Zend_Session_Namespace("usuario_carpeta");

            $archivo['usuario'] = $session->usuario;
            $archivo['usuario_id'] = $session->id;
            $archivo['fecha'] = date('d/m/Y H:i:s');
            $archivo['sha'] = sha1($archivo['name'] . uniqid());
            $_SESSION['adjuntos'][] = $archivo;
            $mensaje = '<div class="alert alert-success text-center">Archivo adjuntado</div>';

            if (isset($_POST['visador'])) {
                $_DAOArchivos = $this->load->model('DAOArchivos');
                //$adjuntos = $_DAOArchivos->getArchivosSolicitud($_POST['visador']);
                /*if($adjuntos){
                    foreach($adjuntos as $item){
                        $archivo = array(
                            'name' => $item->gl_nombre_archivo,
                            'sha' => $item->gl_sha_archivo,
                            'type' => $item->gl_mime_archivo,
                            'contenido' => file_get_contents($item->gl_ruta_archivo.'/'.$item->gl_nombre_archivo),
                            'size' => filesize($item->gl_ruta_archivo.'/'.$item->gl_nombre_archivo),
                            'visador' => true,
                            'fecha' => Fechas::formatearHtml($item->fc_fecha_archivo),
                            'usuario' => $item->nombres.' '.$item->apellidos
                        );
                        $_SESSION['adjuntos'][] = $archivo;
                    }
                }*/
                $this->adjuntarArchivo($mensaje, $_POST['visador']);
                $this->load->javascript('parent.parent.Documento.cargarGrillaAdjuntos("revisar",' . $_POST['visador'] . ');');
            } else {
                $this->adjuntarArchivo($mensaje);
                $this->load->javascript('parent.Documento.cargarGrillaAdjuntos();');
            }
        }


    }


    protected function validarArchivo($tipo)
    {
        $tipos = array(
            'application/pdf',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-excel',
            'application/msword'
        );

        if (in_array(trim($tipo), $tipos)) {
            return true;
        } else {
            return false;
        }
    }


    public function cargarGrillaAdjuntos($visador = null)
    {
        $arr = array();
        $i = 0;
        if (isset($_SESSION['adjuntos']) and count($_SESSION['adjuntos']) > 0) {
            foreach ($_SESSION['adjuntos'] as $item) {
                $arr[$i]['name'] = $item['name'];
                $arr[$i]['indice'] = $i;
                $arr[$i]['fecha'] = $item['fecha'];
                $arr[$i]['usuario'] = $item['usuario'];
                $arr[$i]['usuario_id'] = $item['usuario_id'];
                $arr[$i]['visador'] = $visador;
                if (isset($_POST['visador']) and $_POST['visador'] > 0) {
                    $arr[$i]['visador'] = true;
                }
                $i++;
            }
        }

        $this->smarty->assign('adjuntos', $arr);
        $template = $this->smarty->fetch('Documentos/Nuevo/grilla_adjuntos.tpl');

        echo $template;
    }


    public function grillaRevision()
    {
        $arr = array();
        $documentos = $this->_DAODocumento->getDocumentosRevision(1);
        if ($documentos->numRows > 0) {
            $arr = $documentos->rows;
        }

        $this->smarty->assign('arrResultado', $arr);
        $this->smarty->assign('Fechas', $this->load->lib('Fechas', false));
        $template = $this->smarty->fetch('Documentos/Grillas/grilla_revision.tpl');

        echo $template;
    }


    public function borrarAdjunto()
    {
        $indice = $_POST['indice'];
        $visador = $_POST['visador'];

        $i = 0;
        unset($_SESSION['adjuntos'][$indice]);

        $arr = $_SESSION['adjuntos'];
        unset($_SESSION['adjuntos']);
        foreach ($arr as $item) {
            $_SESSION['adjuntos'][] = $item;
        }

        $this->cargarGrillaAdjuntos($visador);

        /*$this->smarty->assign('adjuntos', $_SESSION['adjuntos']);
        $template = $this->smarty->fetch('Documentos/Nuevo/grilla_adjuntos.tpl');

        echo $template;*/

    }


    public function verAdjunto()
    {
        $params = $this->request->getParametros();
        if (isset($_SESSION['adjuntos'])) {

            $adjunto = $_SESSION['adjuntos'][$params[0]];

            header('Content-Type: ' . $adjunto['type']);
            header('Content-Disposition: inline; filename="' . $adjunto['name'] . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            echo base64_decode($adjunto['contenido']);
            exit();


        } else {
            $sha = $params[0];
            $_DAOArchivos = $this->load->model('DAOArchivos');
            $adjunto = $_DAOArchivos->getArchivoPorSha($sha);
            $ruta = $adjunto->gl_ruta_archivo . '/' . $adjunto->gl_nombre_archivo;
            header('Content-Type: ' . $adjunto->gl_mime_archivo);
            header('Content-Disposition: inline; filename="' . $adjunto->gl_nombre_archivo . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            readfile($ruta);
            exit();
        }

    }


    public function devengarSolicitud()
    {
        $numero = $_POST['numero'];
        $solicitud = $_POST['solicitud'];

        $json = array();
        if (!is_numeric($numero)) {
            $json['estado'] = false;
            $json['mensaje'] = 'Número de folio no válido';
        } else {

            $parametros = array(
                'cd_estado_solicitud' => 4, /* estado devengado */
                'nr_folio_sigfe_solicitud' => $numero
            );
            $update = $this->_DAODocumento->updDocumento($solicitud, $parametros);
            if ($update) {


                $json['estado'] = true;
                $json['mensaje'] = 'Documento #' . $solicitud . ' Devengado';

                $this->load->lib('Constantes', false);
                $session = New Zend_Session_Namespace("usuario_carpeta");
                $arr_historial = array(
                    'fecha' => date('Y-m-d H:i:s'),
                    'usuario' => $session->id,
                    'solicitud' => $solicitud,
                    'evento' => Constantes::DOCUMENTO_DEVENGADO
                );
                $historial = $this->_DAOHistorial->insHistorial($arr_historial);
            } else {
                $json['estado'] = false;
                $json['mensaje'] = 'Problemas al devengar documento. Intente nuevamente';
            }
        }

        echo json_encode($json);
    }


    public function devolverProveedor()
    {
        $solicitud = $_POST['solicitud'];

        $json = array();
        $parametros = array(
            'cd_estado_solicitud' => 3 /* estado devolver proveedor */
        );
        $update = $this->_DAODocumento->updDocumento($solicitud, $parametros);
        if ($update) {
            $json['estado'] = true;
            $json['mensaje'] = 'Documento #' . $solicitud . ' marcado como Devuelto Proveedor';

            $this->load->lib('Constantes', false);
            $session = New Zend_Session_Namespace("usuario_carpeta");
            $arr_historial = array(
                'fecha' => date('Y-m-d H:i:s'),
                'usuario' => $session->id,
                'solicitud' => $solicitud,
                'evento' => Constantes::DOCUMENTO_DEVUELTO
            );
            $historial = $this->_DAOHistorial->insHistorial($arr_historial);
        } else {
            $json['estado'] = false;
            $json['mensaje'] = 'Problemas al cambiar estado del documento. Intente nuevamente';
        }

        echo json_encode($json);
    }


    public function filtrarDocumentos()
    {
        $this->load->lib('Constantes', false);
        $dias = $_POST['dias'];
        $condicion = $_POST['condicion'];

        if ($_SESSION['perfil'] == 1) {
            $arr = $this->_DAODocumento->getDocumentosPorEstados(Constantes::DOCUMENTO_NUEVO);
        } else {
            $session = New Zend_Session_Namespace("usuario_carpeta");
            $arr = $this->_DAODocumento->getDocumentosPorEstados(Constantes::DOCUMENTO_NUEVO, $session->id);
        }

        $documentos = array();
        if ($arr) {
            $this->load->lib('Fechas', false);
            foreach ($arr as $item) {
                $dias_habiles = Fechas::diffDias(date('Y-m-d'), $item->fc_fecha_ingreso_partes_solicitud, true) - $item->total_dias_feriados;
                if ($condicion == 1) {
                    if ($dias_habiles == $dias) {
                        $documentos[] = $item;
                    }
                } elseif ($condicion == 2) {
                    if ($dias_habiles > $dias) {
                        $documentos[] = $item;
                    }
                } elseif ($condicion == 3) {
                    if ($dias_habiles >= $dias) {
                        $documentos[] = $item;
                    }
                }

            }
        }

        $tmp_arr = array();

        foreach ($documentos as $item) {
            if ($item->cd_estado_solicitud == 0) {
                $item->dias_bandeja = Fechas::diffDias(date('Y-m-d'), $item->fc_fecha_ingreso_partes_solicitud, true) - $item->total_dias_feriados;
            } else {
                $evento = $this->_DAOHistorial->obtHistorialVisacionDocumento($item->id_solicitud, Constantes::DOCUMENTO_APROBADO, Constantes::DOCUMENTO_RECHAZADO);
                if ($evento) {
                    $item->dias_bandeja = Fechas::diffDias($evento->fc_fecha_historial, $item->fc_fecha_ingreso_partes_solicitud, true) - $item->total_dias_feriados;
                    $item->fecha_visacion = Fechas::formatearHtml($evento->fc_fecha_historial);
                } else {
                    $item->dias_bandeja = 'Sin fechas';
                    $item->fecha_visacion = 'Sin fecha';
                }
            }
            $tmp_arr[] = $item;
        }

        $this->smarty->assign('arrResultado', $tmp_arr);
        $this->smarty->assign('Fechas', $this->load->lib('Fechas', false));
        $template = $this->smarty->fetch('Documentos/Grillas/grilla_todos.tpl');

        echo $template;
    }


    public function cambiarVisador(){
        $visador = $_POST['visador'];
        $doc = $_POST['doc'];

        $data = array(
            'cd_asignacion_visador_solicitud' => $visador
            );

        $json = array();
        if($this->_DAODocumento->update($data,$doc)){
            if (ENVIROMENT == 'PROD') {
                $this->load->lib('Email', false);
                $documento = $this->_DAODocumento->getDocumentoPorId($doc);
                $datosVisador = $this->_DAOUsuarios->getUsuarioPorId($visador);
                /* correo a visador */
                $msg = '<h3>Documento asignado</h3>';
                $msg .= 'Estimado/a <strong>' . $datosVisador->nombres . ' ' . $datosVisador->apellidos . '</strong>:<br/><br/>';
                $msg .= 'Ud. tiene un documento pendiente de visación, correspondiente a:<br/>';
                $msg .= 'Factura : '.trim($documento->nr_numero_documento_solicitud).'<br/>';
                $msg .= 'Nombre Proveedor : '.trim($documento->gl_nombre_emisor_solicitud).'<br/>';
                $msg .= 'Monto : $'.number_format($documento->nr_monto_solicitud,0,',','.').'<br/>';
                $msg .= 'Correlativo : '.$doc.'<br/><br/>';
                $msg .= 'Para ver el detalle completo de esta solicitud, por favor conectarse al módulo de Facturación. Para acceder a la plataforma pinche el siguiente link:';
                $msg .= '<a href="' . HOST . '/finanzas/" target="_blank">' . HOST . '/finanzas</a>';
                $msg .= '<p>Finanzas - ' . date('d/m/Y') . '</p>';

                $destinatario = trim($datosVisador->email);
                $remitente = 'Minsal - Finanzas';
                $nombre_remitente = 'Minsal - Finanzas';
                $asunto = 'Finanzas - Documento Asignado';
                $mensaje = $msg;
                Email::sendEmail($destinatario, $remitente, $nombre_remitente, $asunto, $mensaje);

            }
            $json['estado'] = true;
        }else{
            $json['estado'] = false;
            $json['mensaje'] = 'Problemas al cambiar visador. Intente nuevamente';
        }

        echo json_encode($json);
    }


    public function grillaTodos(){
        $this->load->lib('Fechas', false);
        $this->load->lib('Constantes', false);

        if ($_SESSION['perfil'] == 1) {
            $arr = $this->_DAODocumento->getDocumentosAsignados();
        } else {
            $session = New Zend_Session_Namespace("usuario_carpeta");
            $arr = $this->_DAODocumento->getDocumentosAsignados($session->id);
        }

        $tmp_arr = array();

        foreach ($arr as $item) {
            if ($item->cd_estado_solicitud == 0) {
                $item->dias_bandeja = Fechas::diffDias(date('Y-m-d'), $item->fc_fecha_ingreso_partes_solicitud, true) - $item->total_dias_feriados;
            } else {
                $evento = $this->_DAOHistorial->obtHistorialVisacionDocumento($item->id_solicitud, Constantes::DOCUMENTO_APROBADO, Constantes::DOCUMENTO_RECHAZADO);
                if ($evento) {
                    $item->dias_bandeja = Fechas::diffDias($evento->fc_fecha_historial, $item->fc_fecha_ingreso_partes_solicitud, true) - $item->total_dias_feriados;
                    $item->fecha_visacion = Fechas::formatearHtml($evento->fc_fecha_historial);
                } else {
                    $item->dias_bandeja = 'Sin fechas';
                    $item->fecha_visacion = 'Sin fecha';
                }
            }
            $tmp_arr[] = $item;
        }

        $this->smarty->assign('arrResultado', $tmp_arr);
        $this->smarty->assign('Fechas', $this->load->lib('Fechas', false));
        $template = $this->smarty->fetch('Documentos/Grillas/grilla_todos.tpl');

        echo $template;
    }

}