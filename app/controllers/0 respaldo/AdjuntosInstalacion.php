<?php

class AdjuntosInstalacion extends Controller {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        Acceso::set("ALL");
        $this->smarty->addPluginsDir(APP_PATH . "views/templates/home/plugins/");
        $this->_DAOUsuarios = $this->load->model("DAOUsuarios");
        $this->_DAOInstalacion = $this->load->model("DAOInstalacion");
        $this->_DAODatosRemoto = $this->load->model("DAODatosRemotos");
        $this->_DAOAdjuntos = $this->load->model("DAOAdjuntos");
        $this->_DAOAmbitos = $this->load->model("DAOAmbitos");
    }

    /**
     * 
     */
    public function index() {
        
    }

    /**
     * 
     */
    public function editar() {

        $this->_addJavascript(STATIC_FILES . 'js/templates/AdjuntosInstalacion/editar.js');

        //print_r($_POST);
        //print_r($_FILES);

        if (isset($_REQUEST['id_instalacion'])) {
            $idInstalacion = $_REQUEST['id_instalacion'];
        }

        if (isset($_REQUEST['accion']) and $_REQUEST['accion'] == "adjunto_nuevo") {
            echo "Agregar archivo";

            $idUnico = rand();
            $ruta = "documentos/" . date("Ymd");

            @mkdir($ruta);

            $nombre = $idUnico . "-" . $_FILES['nuevo_archivo']['name'];

            $fp = fopen($_FILES['nuevo_archivo']['tmp_name'], 'r+b');
            $data = fread($fp, filesize($_FILES['nuevo_archivo']['tmp_name']));
            fclose($fp);

            $out = fopen($ruta . "/" . $idUnico . "-" . $_FILES['nuevo_archivo']['name'], "w");
            fwrite($out, $data);
            fclose($out);

            $idInstalacion = $_POST['id_agregar'];
            $idAmbito = $_POST['id_ambito_nuevo_archivo'];
            $idTipo = $_POST['id_tipo'];
            $this->_DAOAdjuntos->insAdjuntoLimpio($idInstalacion, "/" . date("Ymd"), $nombre, $idAmbito, $idTipo);

            $_SESSION['TabAmbito'] = $idAmbito;
        }

        //$arrSipresaId 	= $this->_DAODatosRemoto->getOrigenesRemotos("sipresa_id",$idInstalacion)	;
        $arrSipresaId = $this->_DAOInstalacion->getDetalleInstalacion($idInstalacion);
        $arrSumanet = $this->_DAODatosRemoto->getOrigenesRemotos("sumanet_3_sumarios", "?id=62", false);

        $arrSumanet = json_decode($arrSumanet);

        $e = str_replace(",", ".", $arrSipresaId->datos_generales->ins_c_coordenada_e);
        $n = str_replace(",", ".", $arrSipresaId->datos_generales->ins_c_coordenada_n);

        //Convertir coordenadas de UTM a LatLon
        $arrLatLong = ToLL($n, $e, 19);

        //Setear nuevas coordenadas	en datos nuevos
        $arrSipresaId->datos_generales->lat = $arrLatLong['lat'];
        $arrSipresaId->datos_generales->lon = $arrLatLong['lon'];

        $arrTipoCampo = $this->_DAOAdjuntos->getTiposCampos();

        //print_r($this->_DAOAmbitos->getAmbitos());

        $arrAdjuntosTipo = array();
        foreach ($this->_DAOAdjuntos->getAdjuntosInstalacion($idInstalacion) as $itemAdjunto) {
            $arrAdjuntosTipo[$itemAdjunto->id_ambito][$itemAdjunto->id_tipo][] = $itemAdjunto;
        }

        //print_r($arrAdjuntosTipo);
        //Obtener ambitos de la instalacion, los informados por SIPRESA mas los locales	
        $arrAmbitosPestanas = array();
        foreach ($arrSipresaId->ambitos as $itemAmbito) {
            if ($_SESSION['TabAmbito'] == 0) {
                $_SESSION['TabAmbito'] = $itemAmbito->id_ambito;
            }

            $arrAmbitosPestanas[$itemAmbito->id_ambito] = $itemAmbito->id_ambito;
        }

        foreach ($this->_DAOInstalacion->getAmbitosLocales($idInstalacion) as $itemAmbito) {
            if ($_SESSION['TabAmbito'] == 0) {
                $_SESSION['TabAmbito'] = $itemAmbito->id_ambito;
            }
            $arrAmbitosPestanas[$itemAmbito->id_ambito] = $itemAmbito->id_ambito;
        }


        $this->smarty->assign("id_instalacion", $idInstalacion);
        //$this->smarty->assign("id_ambito_inicial",$_SESSION['TabAmbito']);			
        $this->smarty->assign("arrAdjuntos", $this->_DAOAdjuntos->getAdjuntosInstalacion($idInstalacion));
        $this->smarty->assign("arrAdjuntosTipo", $arrAdjuntosTipo);
        $this->smarty->assign('arrSipresa', $arrSipresaId->datos_generales);
        $this->smarty->assign('arrAmbitos', $arrSipresaId->ambitos);
        $this->smarty->assign('arrAmbitosBD', $this->_DAOAmbitos->getAmbitos());
        $this->smarty->assign('arrAmbitosPestana', $arrAmbitosPestanas);
        $this->smarty->assign('arrTipos', $this->_DAOAdjuntos->getTipos());
        $this->smarty->assign('arrCamposTipo', $arrTipoCampo);
        $this->smarty->assign("FOLDER", 'acceso');
        $this->smarty->assign("js", '<script type="text/javascript" src="' . STATIC_FILES . "js/templates/AdjuntosInstalacion/editar.js" . '"></script>');
        $this->smarty->display('AdjuntosInstalacion/editar.tpl');
        $_SESSION['TabAmbito'][$idInstalacion] = 0;
    }

    public function guardarCambios() {

        if ($_POST['gl_nombre'] == "") {
            echo "Nombre no puede ser vacio\n";
        }
        if ($_POST['cd_tipo'] == "0") {
            echo "Debe seleccionar un tipo\n";
        }

        $respuesta = $this->_DAOAdjuntos->uptAdjunto($_POST);

        if ($respuesta) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function eliminarADjunto() {

        $respuesta = $this->_DAOAdjuntos->delAdjunto($_POST);

        if ($respuesta) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function cambiarTipo() {

        $arrUnico = explode('_', $_POST['form']);
        $idAdjunto = $arrUnico[2];


        $arrTipoCampo = $this->_DAOAdjuntos->getTiposCampos();

        $itm->id_tipo = $_POST['tipo'];
        $this->smarty->assign('itm', $itm);
        $this->smarty->assign('arrCamposTipo', $arrTipoCampo);
        $this->smarty->display("instalacion/bloques/bloqueCamposEspeciales.tpl");
    }

    /* 	
      public function ocultarTour(){
      $this->_DAOUsuarios->update(array("gl_ocultar_tour" => "1"), $_SESSION['usuario']['id']);
      $_SESSION['usuario']['gl_ocultar_tour'] = 1;
      }
     */
    /*
      public function ocultarTourSession(){
      $_SESSION['usuario']['gl_ocultar_tour'] = 1;
      }
     */
}

?>	