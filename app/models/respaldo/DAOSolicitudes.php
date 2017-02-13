<?php

class DAOSolicitudes extends Model
{
    /**
     * Constructor
     */

    protected $_tabla = "tickets";


    function __construct()
    {
        parent::__construct();
    }

    public function queryBusquedaPendientes($parametros){
        $query = $this->db->select("id_ticket,nombre,gl_comentario,date_format(fc_fecha_creacion,'%d-%m-%Y')as fc_fecha_creacion,date_format(fc_plazo,'%d-%m-%Y')as fc_plazo,cd_id_estado,cd_id_usuario,concat(nombres,' ',apellidos)as nombres from tickets t left join usuario u on u.id=t.cd_id_usuario where  cd_id_estado in (1,2,3)");
                         // ->from($this->_tabla . " t ")
                          //->where("cd_id_usuario",21);
                 
        if(!empty($parametros["nombre"])){
            $query->whereAND("t.nombre" , "%" . $parametros["nombre"] . "%", "LIKE");
        }

        if(!empty($parametros["gl_comentario"])){
            $query->whereAND("t.gl_comentario" , "%" . $parametros["gl_comentario"] . "%", "LIKE");
        }

        if(!empty($parametros["fc_fecha_creacion"])){
            $query->whereAND("t.fc_fecha_creacion" , "%" . $parametros["fc_fecha_creacion"] . "%", "LIKE");
        }

        if(!empty($parametros["fc_plazo"])){
            $query->whereAND("t.fc_plazo" , "%" . $parametros["fc_plazo"] . "%", "LIKE");
        }

        if(!empty($parametros["nombres"])){
            $query->whereAND("t.nombres" , "%" . $parametros["nombres"] . "%", "LIKE");
        }

                     
        fb($query->query());
        return $query;
    }	
	
    public function getPrioridad(){
        $query = $this->db->select("id, gl_descripcion")->from("prioridad");
        $resultado = $query->getResult();
        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getListaTrabajadores(){
        $query = $this->db->select("id, rut, nombres, apellidos")->from("usuario");
        $resultado = $query->getResult();
        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getListaProyectos(){
        $query = $this->db->select("id_proyecto, gl_nombre_proyecto")->from("proyecto");
        $resultado = $query->getResult();
        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function insSolicitud($datos){
        extract($datos);
        $query = "insert into tickets values(null,?,?,?,?,?,?,?,?,?,?)";
        $parametros = array(//son lols nombres de los campos de texto de la vista
            $nombre,
            $gl_comentario,
            $fc_fecha_creacion,
            $fc_fecha_termino,
            $fc_fecha_entrega,
            $cd_id_estado,
            $id_prioridad,
            $cd_id_usuario,
            $fc_fecha_diferencia,
            $id_proyecto,
        );

        if ($this->db->execQuery($query, $parametros)) {
            return $this->db->lastInsertId();

        } else {
            return null;
        }
    }



     /*public function insAdjuntoLimpio($id_solicitud)
    {
        $query = "insert into archivos values(null,?,?,?,?,?,?,?)";
        $fecha = date('Y-m-d H:i:s');
        $data = array(
            'cd_solicitud_fk_archivo' => $id_solicitud,
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
    }*/
     
     public function queryBusquedaTicket($parametros){
        $query = $this->db->select("t.*, p.gl_nombre_proyecto")
                          ->from($this->_tabla . " t")
                          ->join("proyecto p", "p.id_proyecto = t.cd_id_proyecto");
        fb($query->query());

        return $query;
    }

    public function getSolicitudById($id_solicitud){
        $query = "select t.id_ticket as id_solicitud, t.nombre as asunto, t.gl_comentario as comentario, t.cd_id_estado as id_estado, t.cd_id_prioridad, t.fc_fecha_creacion, t.fc_plazo as fecha_entrega, t.nr_fecha_diferencia, e.gl_descripcion as desc_estado, u.id as id_usuario, u.nombres as nombre, u.apellidos as apellido, p.id, p.gl_descripcion as desc_prioridad, t.cd_id_proyecto as id_proyecto, pro.gl_nombre_proyecto as nombre_proyecto
                from tickets t, tipo_estado e, usuario u, prioridad p , proyecto pro
                where t.id_ticket = $id_solicitud and t.cd_id_estado = e.id_estado and t.cd_id_usuario = u.id and t.cd_id_prioridad = p.id and t.cd_id_proyecto = pro.id_proyecto
                group by t.id_ticket";
        $consulta = $this->db->getQuery($query,array($id_solicitud));

        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }  

 public function getSolicitudesAsignadas($id_usuario = null, $estado = null){

        $query = "select t.id_ticket as id_solicitud, t.nombre as asunto, t.cd_id_estado as id_estado, t.cd_id_prioridad, t.fc_fecha_creacion, t.fc_plazo as fecha_entrega,  t.gl_comentario, e.gl_descripcion as desc_estado, p.id, p.gl_descripcion as desc_prioridad, t.cd_id_proyecto as id_proyecto, pro.gl_nombre_proyecto as nombre_proyecto
                  FROM tickets t, tipo_estado e, prioridad p, proyecto pro
                  WHERE t.cd_id_proyecto = pro.id_proyecto and t.cd_id_estado = e.id_estado and t.cd_id_prioridad = p.id and t.cd_id_usuario =". $id_usuario;

        $resultado = $this->db->getQuery($query);
        if ($resultado->numRows > 0) {

            $arrSalida = array();
            $i=0;
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

