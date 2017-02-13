<?php

class DAOArchivos extends Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function insArchivo($data)
    {
        $query = "insert into archivos values(NULL,?,?,?,?,?,?,?)";
        $parametros = array($data['solicitud'], $data['nombre'], $data['ruta'], $data['sha'], $data['mime'], $data['usuario_id'], $data['fecha']);

        if ($this->db->execQuery($query, $parametros)) {
            return true;
        } else {
            return null;
        }
    }


    public function getArchivosSolicitud($id_solicitud)
    {
        $query = "select * from archivos left join usuario on id = cd_usuario_fk_archivo where cd_solicitud_fk_archivo = ? ";
        $consulta = $this->db->getQuery($query, array($id_solicitud));

        if ($consulta->numRows > 0) {
            return $consulta->rows;
        } else {
            return null;
        }
    }


    public function getArchivoPorSha($sha)
    {
        $query = "select * from archivos left join usuario on id = cd_usuario_fk_archivo where gl_sha_archivo = ? limit 1";
        $consulta = $this->db->getQuery($query, array($sha));

        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }


    public function delAdjuntosSolicitud($solicitud)
    {
        $query = "delete from archivos where cd_solicitud_fk_archivo = ?";
        if($this->db->execQuery($query,array($solicitud))){
            return true;
        }else{
            return false;
        }
    }


}