<?php

class DAODocumento extends Model
{

    /**
     *
     * @var string
     */
    protected $_tabla = "solicitudes";

    protected $_primaria = 'id_solicitud';

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

    public function getDocumentosAsignados($id_usuario = null, $estado = null)
    {


        /* $query = $this->db->select("*")
                           ->from("solicitudes")*/
        /*
        ->whereAND("adjuntos.gl_eliminado" ,1,"<>")
        ->whereAND("adjuntos.id_instalacion" ,$idInstalacion);
        */

        /*$resultado = $query->getResult();*/
        $usuario = '';
        if (!is_null($id_usuario)) {
            $usuario = ' where cd_asignacion_visador_solicitud = ' . $id_usuario;
        }

        if (!is_null($estado)) {
            if(empty($usuario))
                $usuario = ' where cd_estado_solicitud = ' . $estado;
            else
                $usuario .= ' and cd_estado_solicitud = ' . $estado;
        }

        $query = "select *, (select count(*) as dias_habiles from dias_feriados where fecha_diaferiado BETWEEN fc_fecha_ingreso_partes_solicitud and current_date()) as total_dias_feriados 
          from solicitudes 
          left join subsecretaria on id_subsecretaria = cd_subsecretaria_solicitud 
          left join tipo_documento on id_tipodocumento = cd_tipo_documento_solicitud 
          left join centro_responsabilidad on codigo_centroresponsabilidad = cd_centro_responsabilidad_solicitud 
          left join usuario on id = cd_asignacion_visador_solicitud  
          left join tipo_compra on id_tipocompra = cd_tipo_compra_solicitud " . $usuario;

        $resultado = $this->db->getQuery($query);
        if ($resultado->numRows > 0) {

            $arrSalida = array();
            foreach ($resultado->rows as $itm) {
                $arrSalida[] = $itm;
            }

            return $arrSalida;
        } else {
            return array();
        }
    }

    public function getAdjuntosInstalacion($idInstalacion)
    {


        $query = $this->db->select("*")
            ->from($this->_tabla . " adjuntos")
            ->whereAND("adjuntos.gl_eliminado", 1, "<>")
            ->whereAND("adjuntos.id_instalacion", $idInstalacion);

        $resultado = $query->getResult();
        if ($resultado->numRows > 0) {

            $arrSalida = array();
            foreach ($resultado->rows as $itm) {
                $itm->gl_valores_campos = json_decode($itm->gl_valores_campos, true);
                $arrSalida[] = $itm;
            }

            return $arrSalida;
        } else {
            return NULL;
        }
    }

    public function getTipos()
    {

        $query = $this->db->select("*")
            ->from("adjuntos_tipo tipo");
        //->whereAND("u.rut" , $rut);

        $resultado = $query->getResult();
        if ($resultado->numRows > 0) {
            return $resultado->rows;
        } else {
            return NULL;
        }
    }

    public function getTiposAmbitos($idAmbito)
    {

        $query = $this->db->select("*")
            ->from("adjuntos_tipo tipo")
            ->whereAND("tipo.id_ambito", $idAmbito);

        $resultado = $query->getResult();
        if ($resultado->numRows > 0) {
            return $resultado->rows;
        } else {
            return NULL;
        }
    }


    public function getTiposCampos()
    {

        $query = $this->db->select("*")
            ->from("adjuntos_tipo_campos tipo")
            ->whereAND("tipo.gl_activo", 1);

        $resultado = $query->getResult();
        if ($resultado->numRows > 0) {

            $arr = array();
            foreach ($resultado->rows as $itm) {
                $arr[$itm->id_ambito][$itm->id_tipo][$itm->id_campo]['nombre'] = $itm->gl_nombre;
                $arr[$itm->id_ambito][$itm->id_tipo][$itm->id_campo]['id'] = $itm->gl_campo_html;
                $arr[$itm->id_ambito][$itm->id_tipo][$itm->id_campo]['tipo'] = $itm->gl_tipo;

            }

            return $arr;
        } else {
            return NULL;
        }
    }

    public function insAdjuntoLimpio($idInstalacion, $glRuta, $glNombre, $idAmbito, $idTipo)
    {


        $fecha = date('Y-m-d H:i:s');
        $data = array(
            'id_instalacion' => $idInstalacion,
            'gl_ruta' => $glRuta . "/" . $glNombre,
            'gl_nombre' => $glNombre,
            'id_usuario' => $_SESSION['usuario']['id'],
            'cd_tipo' => 0,
            'id_tipo' => $idTipo,
            'id_ambito' => $idAmbito,
            'fc_carga' => $fecha,
            'gl_eliminado' => 0
        );
        return $this->insert($data);
    }


    public function exportarDesdeASD($idInstalacion, $arrASD)
    {

        $arrAdjuntosActuales = array();

        foreach ($this->getAdjuntosInstalacion($idInstalacion) as $item) {
            $arrAdjuntosActuales[$item->gl_nombre] = $item->gl_nombre;
        }

        foreach ($arrASD as $item) {

            if (!isset($arrAdjuntosActuales[$item->gl_nombre_archivo])) {
                $glNombre = $item->gl_nombre_archivo;
                $idTipo = $item->id_antecedente;
                $idAmbito = 1;

                $arrTipos[1] = 3;
                $arrTipos[7] = 3;
                $arrTipos[2] = 5;
                /*
                $arrTipos[3] = ;
                $arrTipos[4] = ;
                $arrTipos[5] = ;
                */
                $arrTipos[11] = 4;
                $arrTipos[6] = 4;
                $arrTipos[8] = 5;
                $arrTipos[14] = 10;

                $arrTipos['r'] = 1;
                $arrTipos['v'] = 2;

                $ruta = "documentos/" . date("Ymd");
                @mkdir($ruta);

                $data = file_get_contents("http://asdigital.minsal.cl/asdigital/" . $item->gl_ruta_archivo);

                $out = fopen($ruta . "/" . $glNombre, "w");
                fwrite($out, $data);
                fclose($out);

                $fecha = date('Y-m-d H:i:s');
                $data = array(
                    'id_instalacion' => $idInstalacion,
                    'gl_ruta' => "/" . date("Ymd") . "/" . $glNombre,
                    'gl_nombre' => $glNombre,
                    'id_usuario' => $_SESSION['usuario']['id'],
                    'cd_tipo' => 0,
                    'id_tipo' => $arrTipos[$idTipo],
                    'id_ambito' => $idAmbito,
                    'fc_carga' => $fecha,
                    'gl_eliminado' => 0
                );
                $this->insert($data);
            }

        }

    }

    public function uptAdjunto($arrForm)
    {


        $arrJson = array();

        foreach ($arrForm as $itm => $valor) {
            if (substr($itm, 0, 4) == "var_") {
                $arrJson[$itm] = $valor;
            }
        }

        $query = "update instalacion_adjuntos 
					set 
						gl_nombre 			= :gl_nombre,
						fc_modificado		= now(),	
						id_tipo				= :id_tipo,		
						gl_descripcion		= :gl_descripcion,
						gl_valores_campos 	= :gl_valores_campos,
						id_ambito 			= :id_ambito
					where id_adjunto 	= :id_adjunto ";

        return $this->db->execQuery($query, array(":gl_nombre" => $arrForm['gl_nombre'],
            ":id_tipo" => $arrForm['cd_tipo'],
            ":gl_descripcion" => $arrForm['gl_descripcion'],
            ":gl_valores_campos" => json_encode($arrJson),
            ":id_adjunto" => $arrForm['id_frm_individual'],
            ":id_ambito" => $arrForm['id_ambito'],
        ));

    }

    public function delAdjunto($arrForm)
    {

        $query = "update instalacion_adjuntos 
					set 
						gl_eliminado 			= 1,
						fc_modificado		= now()	
					where id_adjunto 	= :id_adjunto ";

        return $this->db->execQuery($query, array(":id_adjunto" => $arrForm['id_frm_individual']));

    }


    //creada  por BC
    public function insBoleta($datos)
    {
        extract($datos);
        $query = "insert into boleta values(null,?,?,?,?,?,?)";
        $parametros = array(//son lols nombres de los campos de texto de la vista
            $subsecretaria_boleta,
            $tipo_boleta,
            $fecha_oficina_boleta,
            $rut_emisor_boleta,
            $nombre_emisor_boleta,
            $numero_boleta
        );

        if ($this->db->execQuery($query, $parametros)) {
            return $this->db->lastInsertId();

        } else {
            return null;
        }
    }
    // fin creada por BC


     //creada  por BC
    public function insDetalle($datos)
    {
        //extract($datos);
        $query = "insert into detalle_boleta values(null,?,?,?,?,?,1)";
        /*$parametros = array(//son lols nombres de los campos de texto de la vista
            $codigo,
            $glosa,
            $cantidad,
            $precio,
            $total
        );*/

        if ($this->db->execQuery($query)) {
            return $this->db->lastInsertId();

        } else {
            return null;
        }
    }
    // fin creada por BC


    public function insDocumento($datos)
    {
        extract($datos);
        $query = "insert into solicitudes values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,0,'',null,?,0)";
        $parametros = array(
            $cd_usuario_solicitud,
            $fc_fecha_soliticitud,
            $subsecretaria,
            $tipo_documento,
            $numero_documento,
            $rut_emisor,
            $numero_compra,
            $centro_responsabilidad,
            nl2br($descripcion),
            $fecha_oficina,
            $id_registro_sigfe,
            $tipo_compra,
            $nombre_emisor,
            $subtitulo_presupuestario,
            $asignacion_visador,
            str_replace('.','',$monto)
        );

        if ($this->db->execQuery($query, $parametros)) {
            return $this->db->lastInsertId();

        } else {
            return null;
        }
    }



    public function getDocumentoPorId($id_solicitud)
    {
        $query = "select * from solicitudes 
          left join subsecretaria on id_subsecretaria = cd_subsecretaria_solicitud 
          left join tipo_documento on id_tipodocumento = cd_tipo_documento_solicitud 
          left join centro_responsabilidad on codigo_centroresponsabilidad = cd_centro_responsabilidad_solicitud 
          left join tipo_compra on id_tipocompra = cd_tipo_compra_solicitud 
          left join usuario on id = cd_asignacion_visador_solicitud 
          where id_solicitud = ? limit 1";
        $consulta = $this->db->getQuery($query, array($id_solicitud));

        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }


    public function updDocumento($id_solicitud, $parametros)
    {
        $query = "update solicitudes set ";

        $valores = array();
        foreach ($parametros as $campo => $valor) {
            $query .= ' ' . $campo . ' = ?,';
            $valores[] = $valor;
        }
        $query = trim($query, ',');
        $query .= ' where id_solicitud = ?';
        $valores[] = $id_solicitud;

        if ($this->db->execQuery($query, $valores)) {
            return true;
        } else {
            return null;
        }
    }



    public function getDocumentosPorEstado($estado){
        $query = "select * from solicitudes 
          left join subsecretaria on id_subsecretaria = cd_subsecretaria_solicitud 
          left join tipo_documento on id_tipodocumento = cd_tipo_documento_solicitud 
          left join centro_responsabilidad on codigo_centroresponsabilidad = cd_centro_responsabilidad_solicitud 
          left join tipo_compra on id_tipocompra = cd_tipo_compra_solicitud 
          left join usuario on id = cd_asignacion_visador_solicitud 
          where cd_estado_solicitud = ? ";
        $consulta = $this->db->getQuery($query, array($estado));

        return $consulta;
    }

    public function getTicketsPorEstado($estado){
        $query = "select * from tickets
                left join tipo_estado  on id_estado=cd_id_estado
                left join prioridad on id=cd_id_prioridad
                left join usuario u on u.id=cd_id_usuario
                where cd_id_estado=? ";
        $consulta = $this->db->getQuery($query, array($estado));

        return $consulta;
    }

    public function diferenciaDiasFechas($inicio,$termino){
        $query="select * from tickets
                left join tipo_estado  on id_estado=cd_id_estado
                left join prioridad on id=cd_id_prioridad
                left join usuario u on u.id=cd_id_usuario
                where nr_fecha_diferencia < ? and nr_fecha_diferencia > ?";
        $consulta = $this->db->getQuery($query, array($inicio,$termino));
        return $consulta;        
    }

    public function diferenciaDiasFechasUsuario($IdUsuario,$inicio,$termino){
        $query="select * from tickets
                left join tipo_estado  on id_estado=cd_id_estado
                left join prioridad on id=cd_id_prioridad
                left join usuario u on u.id=cd_id_usuario
                where cd_id_usuario=? and nr_fecha_diferencia < ? and nr_fecha_diferencia > ?";
        $consulta = $this->db->getQuery($query, array($IdUsuario,$inicio,$termino));
        return $consulta;        
    }




    public function getTicketsPorUsuario($idUsuario,$estado){
        $query = "select * from tickets
                left join tipo_estado  on id_estado=cd_id_estado
                left join prioridad on id=cd_id_prioridad
                left join usuario u on u.id=cd_id_usuario
                where cd_id_usuario=? and cd_id_estado=? ";
        $consulta = $this->db->getQuery($query, array($idUsuario,$estado));

        return $consulta;
    }


    public function getDocumentosRevision(){
        $query = "select * from solicitudes 
          left join subsecretaria on id_subsecretaria = cd_subsecretaria_solicitud 
          left join tipo_documento on id_tipodocumento = cd_tipo_documento_solicitud 
          left join centro_responsabilidad on codigo_centroresponsabilidad = cd_centro_responsabilidad_solicitud 
          left join tipo_compra on id_tipocompra = cd_tipo_compra_solicitud 
          left join usuario on id = cd_asignacion_visador_solicitud 
          where cd_estado_solicitud = 1 or cd_estado_solicitud = 2 ";
        $consulta = $this->db->getQuery($query);

        return $consulta;
    }



    public function validarExistenciaDocumento($subsecretaria,$tipo_documento,$num_documento,$rut_emisor){
        $query = 'select count(*) as existencia from solicitudes where cd_subsecretaria_solicitud = ? and cd_tipo_documento_solicitud = ? and nr_numero_documento_solicitud = ? and gl_rut_emisor_solicitud = ? ';
        $consulta = $this->db->getQuery($query,array($subsecretaria,$tipo_documento,$num_documento,$rut_emisor));

        $resultado = $consulta->rows->row_0;
        if($resultado->existencia > 0){
            $query = 'select id_solicitud from solicitudes where cd_subsecretaria_solicitud = ? and cd_tipo_documento_solicitud = ? and nr_numero_documento_solicitud = ? and gl_rut_emisor_solicitud = ? ';
            $consulta = $this->db->getQuery($query,array($subsecretaria,$tipo_documento,$num_documento,$rut_emisor));
            return $consulta->rows->row_0->id_solicitud;
        }else{
            return null;
        }

    }

    //BC
    public function validarExistenciaBoleta($subsecretaria,$tipo_boleta,$num_boleta,$rut_emisor){
        $query = 'select count(*) as existencia from boleta where cd_id_subsecretaria = ? and id_tipo = ? and nr_numero_boleta = ? and gl_rut_emisor = ? ';
        $consulta = $this->db->getQuery($query,array($subsecretaria,$tipo_boleta,$num_boleta,$rut_emisor));

        $resultado = $consulta->rows->row_0;
        if($resultado->existencia > 0){
            $query = 'select id_boleta from boleta where cd_id_subsecretaria = ? and id_tipo = ? and nr_numero_boleta = ? and gl_rut_emisor = ? ';
            $consulta = $this->db->getQuery($query,array($subsecretaria,$tipo_boleta,$num_boleta,$rut_emisor));
            return $consulta->rows->row_0->id_boleta;
        }else{
            return null;
        }

    }

    public function getDocumentosPorEstados($estado,$id_usuario=null){
        $usuario = '';
        if (!is_null($id_usuario)) {
            $usuario = ' and cd_asignacion_visador_solicitud = ' . $id_usuario;
        }
        
        $query = 'select *, 
          (select count(*) as dias_habiles from dias_feriados where fecha_diaferiado BETWEEN fc_fecha_ingreso_partes_solicitud and current_date()) as total_dias_feriados 
          from solicitudes 
          left join subsecretaria on id_subsecretaria = cd_subsecretaria_solicitud 
          left join tipo_documento on id_tipodocumento = cd_tipo_documento_solicitud 
          left join centro_responsabilidad on codigo_centroresponsabilidad = cd_centro_responsabilidad_solicitud 
          left join usuario on id = cd_asignacion_visador_solicitud  
          left join tipo_compra on id_tipocompra = cd_tipo_compra_solicitud 
          where cd_estado_solicitud = ? ' . $usuario;

        $resultado = $this->db->getQuery($query,array($estado));
        if ($resultado->numRows > 0) {

            $arrSalida = array();
            foreach ($resultado->rows as $itm) {
                $arrSalida[] = $itm;
            }

            return $arrSalida;
        } else {
            return NULL;
        }
    }


}

?>