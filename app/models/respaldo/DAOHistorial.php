<?php

class DAOHistorial extends Model {

    function __construct()
    {
        parent::__construct();
    }


    public function insHistorial($datos){
        extract($datos);
        $query = "insert into historial values(NULL,?,?,?,?)";
        $parametros = array($fecha,$usuario,$solicitud,$evento);

        if($this->db->execQuery($query,$parametros)){
            return true;
        }else{
            return null;
        }
    }


    public function obtHistorialPorDocumento($documento){
        $query = "select * from historial 
          left join usuario on id = cd_usuario_fk_historial 
          where cd_solicitud_fk_historial = ? order by fc_fecha_historial ASC";

        $consulta = $this->db->getQuery($query,array($documento));
        if($consulta->numRows > 0){
            return $consulta->rows;
        }else{
            return null;
        }
    }
    
    
    public function obtHistorialVisacionDocumento($id_solicitud,$aprobado,$rechazado){
        $query = "select * from historial 
          left join usuario on id = cd_usuario_fk_historial 
          where cd_solicitud_fk_historial = ? and (gl_evento_historial = ? or gl_evento_historial = ?) order by fc_fecha_historial DESC limit 1";

        $consulta = $this->db->getQuery($query,array($id_solicitud,$aprobado,$rechazado));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
}