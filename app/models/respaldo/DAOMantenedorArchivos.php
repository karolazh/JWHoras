<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOMantenedorArchivos.php
!Sistema 	  		: Gestion Calidad
!Modulo 	  		: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carlos Escalona
!Creacion     		: 19/10/2016
!Retornos/Salidas 	: NA
!OrigenReq        	: NA
=============================================================================
!Parametros 		: NA 
=============================================================================
!Testing 			: NA
=============================================================================
!ControlCambio
--------------
!cVersion !cFecha   !cProgramador   !cDescripcion 
-----------------------------------------------------------------------------

-----------------------------------------------------------------------------
*****************************************************************************
!EndHeaderDoc 
*/

//clase DAOMantenedorArchivos
class DAOMantenedorArchivos extends Model{
    /**
     * Constructor
     */

//funcion construct
   function __construct()
    {
        parent::__construct();
    }
	
	

//funcion sql insSolicitud inserta en tabla tbl_carpeta_archivo
    public function insSolicitud($datos){
        extract($datos);
        $query = "INSERT INTO tbl_carpeta_archivo (id_carpeta_archivo,nombre,gl_comentario,fc_fecha_creacion,id_estado_carpeta,id_usuario,padre) 
                                           VALUES (null,?,?,?,?,?,?)";
        $parametros = array(
            $nombre,
            $gl_comentario,
            $fc_fecha_creacion,
            $id_estado_carpeta,
            $id_usuario,
            $padre
        );

        if ($this->db->execQuery($query, $parametros)) {
            return $this->db->lastInsertId();

        } else {
            return null;
        }
    }

//funcion sql insSolicitudSubCarpeta inserta en tabla tbl_carpeta_archivo
    public function insSolicitudSubCarpeta($datos){
        extract($datos);
        $query = "INSERT INTO tbl_carpeta_archivo (id_carpeta_archivo,nombre,gl_comentario,fc_fecha_creacion,id_estado_carpeta,id_usuario,padre,id_carpeta_relacionada) 
                                           VALUES (null,?,?,?,?,?,?,?)";
        $parametros = array(
            $nombre,
            $gl_comentario,
            $fc_fecha_creacion,
            $id_estado_carpeta,
            $id_usuario,
            $padre,
            $id_carpeta_relacionada  
        );

        if ($this->db->execQuery($query, $parametros)) {
            return $this->db->lastInsertId();

        } else {
            return null;
        }
    }

//funcion sql insBitacora inserta en tabla tbl_bitacora	
    public function insBitacora($bitacora){
        extract($bitacora);
        $query = "INSERT INTO tbl_bitacora (id_bitacora,fecha_bitacora,id_usuario_bitacora,nombre_evento_bitacora,id_carpeta_archivo) 
                                           VALUES (null,?,?,?,?)";
        $parametros = array(
            $fecha_bitacora,
            $id_usuario_bitacora,
            $nombre_evento_bitacora,
            $id_carpeta_archivo
        );

        if ($this->db->execQuery($query, $parametros)) {
            return $this->db->lastInsertId();

        } else {
            return null;
        }
    }

//funcion sql getBitacora selecciona en tabla tbl_bitacora	
    public function getBitacora($id_carpeta_archivo){

       $query = "SELECT * 
                FROM tbl_bitacora b
                JOIN tbl_usuario u on u.id = b.id_usuario_bitacora 
                WHERE b.id_carpeta_archivo =" .$id_carpeta_archivo;

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

//funcion sql updSolicitud actualiza  en tabla tbl_carpeta_archivo
    public function updSolicitud($datos){
        extract($datos);

         $query = "UPDATE tbl_carpeta_archivo
                    SET   fc_fecha_update = ?,
                          id_usuario_modifica = ? 
                    WHERE id_carpeta_archivo =? ";

        $parametros = array(
            $fc_fecha_update,
            $id_usuario_modifica,
            $id_carpeta_archivo
        );

        if ($this->db->execQuery($query, $parametros)) {
            return $id_carpeta_archivo;
        } else {
            return null;
        }
    }

//funcion sql updArchivo actualiza  en tabla tbl_archivos	
    public function updArchivo($datos){
        extract($datos);

        $query = "UPDATE tbl_archivos
                    SET   nombre_archivo = ?,
                          id_estado_archivo = ?,
                          id_usuario_modifica = ?,
                          fecha_UPDATE = ? 
                    WHERE id_archivo =? ";

        $parametros = array(
            $nombre_archivo,
            $id_estado_archivo,
            $id_usuario,
            $fecha_UPDATE,
            $id_archivo

        );

        if ($this->db->execQuery($query, $parametros)) {
            return $id_archivo;
        } else {
            return null;
        }
    }

//funcion sql getSolicitudesAsignadas selecciona en tabla tbl_carpeta_archivo	
    public function getSolicitudesAsignadas(){

        $query = "SELECT ca.id_carpeta_archivo, 
                         ca.nombre, 
                         ca.fc_fecha_creacion, 
                         u.nombres,
                         ce.nombre_estado_carpeta
                 FROM tbl_carpeta_archivo ca 
                 JOIN tbl_usuario u on u.id = ca.id_usuario 
                 JOIN tbl_carpeta_estado ce on ce.id_estado_carpeta = ca.id_estado_carpeta
                 AND ca.padre = 'si'";

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

//funcion sql getSubCarpetas selecciona en tabla tbl_carpeta_archivo		
    public function getSubCarpetas($id_carpeta_archivo){

        $query = "SELECT ca.id_carpeta_archivo, 
                         ca.nombre, 
                         ca.fc_fecha_creacion, 
                         u.nombres,
                         ce.nombre_estado_carpeta
                 FROM tbl_carpeta_archivo ca 
                 JOIN tbl_usuario u on u.id = ca.id_usuario 
                 JOIN tbl_carpeta_estado ce on ce.id_estado_carpeta = ca.id_estado_carpeta
                 AND ca.padre = 'no'
                 AND ca.id_carpeta_relacionada = " .$id_carpeta_archivo;

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

//funcion sql getSolicitudById selecciona en tabla tbl_carpeta_archivo	
    public function getSolicitudById($id_carpeta_archivo){

             $query = "SELECT ca.id_carpeta_archivo, 
                              ca.nombre, 
                              ca.fc_fecha_creacion,
                              ca.gl_comentario, 
                              u.nombres,
                              ce.nombre_estado_carpeta
                       FROM tbl_carpeta_archivo ca 
                       JOIN tbl_usuario u on u.id = ca.id_usuario 
                       JOIN tbl_carpeta_estado ce on ce.id_estado_carpeta = ca.id_estado_carpeta
                       WHERE ca.id_carpeta_archivo = " .$id_carpeta_archivo;

        $consulta = $this->db->getQuery($query,array($id_carpeta_archivo));
       
        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }

//funcion sql getArchivosSolicitudArchivos selecciona en tabla tbl_archivos	
    public function getArchivosSolicitudArchivos($id_carpeta_archivo){
        $query = "SELECT * 
                  FROM tbl_archivos a
                  JOIN tbl_archivo_estado b on b.id_estado_archivo = a.id_estado_archivo 
                  JOIN tbl_usuario u on u.id = a.cd_usuario_fk_archivo 
                  WHERE a.id_estado_archivo in (1,3)
                  AND a.cd_solicitud_fk_archivo = ".$id_carpeta_archivo;

        $consulta = $this->db->getQuery($query, array($id_carpeta_archivo));

        if ($consulta->numRows > 0) {
            return $consulta->rows;
        } else {
            return null;
        }
    }

//funcion sql getArchivosVersionados selecciona en tabla tbl_archivos		
    public function getArchivosVersionados($id_documento){
        $query = "SELECT * 
                  FROM tbl_archivos a
                  JOIN tbl_archivo_estado b on b.id_estado_archivo = a.id_estado_archivo 
                  JOIN tbl_usuario u on u.id = a.cd_usuario_fk_archivo 
                  WHERE a.id_estado_archivo = 2
                  AND a.id_archivo_relacionado = " .$id_documento;

       $consulta = $this->db->getQuery($query, array($id_documento));

        if ($consulta->numRows > 0) {
            return $consulta->rows;
        } else {
            return null;
        }
    }

//funcion sql getListaEstadosArchivos selecciona en tabla tbl_archivo_estado	
    public function getListaEstadosArchivos(){
        $query = $this->db->SELECT("id_estado_archivo, nombre_archivo_estado")->FROM("tbl_archivo_estado");
        $resultado = $query->getResult();
        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

//funcion sql getArchivos selecciona en tabla tbl_archivos	
    public function getArchivos($id_documento){
        $query = "SELECT * 
                  FROM tbl_archivos a
                  JOIN tbl_archivo_estado b on b.id_estado_archivo = a.id_estado_archivo 
                  WHERE a.id_archivo = ".$id_documento;

    $consulta = $this->db->getQuery($query,array($id_documento));
       
        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }

//funcion sql getSolicitudesAsignadascontar selecciona en tabla tbl_carpeta_archivo		
    public function getSolicitudesAsignadascontar($estado){
        $query = "SELECT ca.id_carpeta_archivo, 
                         ca.nombre, 
                         ca.fc_fecha_creacion, 
                         u.nombres,
                         ce.nombre_estado_carpeta
                 FROM tbl_carpeta_archivo ca 
                 JOIN tbl_usuario u on u.id = ca.id_usuario 
                 JOIN tbl_carpeta_estado ce on ce.id_estado_carpeta = ca.id_estado_carpeta
                 WHERE ca.id_estado_carpeta=? ";

        $consulta = $this->db->getQuery($query, array($estado));

        return $consulta;
    }

//funcion sql getTotalCarpetas selecciona en tabla tbl_carpeta_archivo		
    public function getTotalCarpetas(){
        $query = "SELECT count(*) as total 
                  FROM tbl_carpeta_archivo";
                  
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
}

?>
