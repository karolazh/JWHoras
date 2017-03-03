<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOArchivos.php
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

class DAOArchivos extends Model{

//funcion construct
    function __construct()
    {
        parent::__construct();
    }

//funcion sql insArchivo inserta en tabla tbl_archivos	
    public function insArchivo($data){
        $query = "INSERT INTO tbl_archivos values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $parametros = array($data['solicitud'],
                            $data['nombre'],
                            $data['nombre_archivo'],
                            $data['ruta'],
                            $data['sha'],
                            $data['mime'],
                            $data['usuario_id'],
                            $data['fecha'],
                            $data['estado'],
                            $data['id_usuario_modifica'],
                            $data['fecha_update'],
                            $data['versionado'],
                            $data['id_archivo_relacionado'],
                            $data['version']
                            );
        if ($this->db->execQuery($query, $parametros)) {
            return true;
        } else {
            return null;
        }
    }

//funcion sql updArchivo actualiza  en tabla tbl_archivos		
    public function updArchivo($data){
        extract($data);

        $query = "UPDATE tbl_archivos
                    SET  id_estado_archivo = 2,
                         id_archivo_relacionado = ?
                    WHERE id_archivo =? ";

        $parametros = array(
               $id_archivo_relacionado,
               $id_archivo_relacionado
        );

        if ($this->db->execQuery($query, $parametros)) {
            return $id_archivo_relacionado;
        } else {
            return null;
        }
    }

//funcion sql updArchivo actualiza  en tabla tbl_archivos		
    public function updArchivos($data){
        extract($data);

        $query = "UPDATE tbl_archivos
                    SET  id_estado_archivo = 2
                    WHERE id_archivo =? ";

        $parametros = array(
               $id_archivo
        );

        if ($this->db->execQuery($query, $parametros)) {
            return $id_archivo_relacionado;
        } else {
            return null;
        }
    }

 //funcion sql getArchivosSolicitudArchivos selecciona en tabla tbl_archivos	 
    public function getArchivosSolicitudArchivos($id_carpeta_archivo){
        $query = "SELECT * 
                  FROM tbl_archivos 
                  WHERE cd_solicitud_fk_archivo = ? ";

        $consulta = $this->db->getQuery($query, array($id_carpeta_archivo));

        if ($consulta->numRows > 0) {
            return $consulta->rows;
        } else {
            return null;
        }
    }
	
//funcion sql insArchivo inserta en tabla tbl_archivos	
    public function insArchivoActividad($data){
        $query = "INSERT INTO tbl_archivos_actividad values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $parametros = array($data['id_actividad'],
							$data['id_usuario'],
							$data['gl_nombre_archivo'],
                            $data['nombre_archivo'],
                            $data['ruta'],
                            $data['sha'],
                            $data['mime']
                            );
        if ($this->db->execQuery($query, $parametros)) {
            return true;
        } else {
            return null;
        }
    }	
	
//funcion sql getArchivosActividades selecciona en tabla tbl_archivos	 
    public function getArchivosActividades($id_actividades){
        $query = "SELECT * 
                  FROM tbl_archivos_actividad 
                  WHERE id_actividad = ? ";

        $consulta = $this->db->getQuery($query, array($id_actividades));

        if ($consulta->numRows > 0) {
            return $consulta->rows;
        } else {
            return null;
        }
    }	

 //funcion sql getArchivosSolicitud selecciona en tabla tbl_archivos
    public function getArchivosSolicitud($id_solicitud){
        $query = "SELECT * 
                  FROM tbl_archivos 
                  LEFT JOIN tbl_usuario on id = cd_usuario_fk_archivo 
                  WHERE cd_solicitud_fk_archivo = ? ";

        $consulta = $this->db->getQuery($query, array($id_solicitud));

        if ($consulta->numRows > 0) {
            return $consulta->rows;
        } else {
            return null;
        }
    }

 //funcion sql getArchivoPorSha selecciona en tabla tbl_archivos
    public function getArchivoPorSha($sha){
        $query = "SELECT * 
                  FROM tbl_archivos 
                  LEFT JOIN tbl_usuario on id = cd_usuario_fk_archivo
                  WHERE gl_sha_archivo = ? limit 1";
        $consulta = $this->db->getQuery($query, array($sha));

        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }

 //funcion sql getArchivoPorIdDocumento selecciona en tabla tbl_archivos	
    public function getArchivoPorIdDocumento($id_documento){
        $query = "SELECT * 
                  FROM tbl_archivos 
                  WHERE id_archivo = ? limit 1";
        $consulta = $this->db->getQuery($query, array($id_documento));

        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }
	
//funcion sql getArchivoPorIdDocumento selecciona en tabla tbl_archivos_actividad	
    public function getArchivoPorIdDocumentoActividades($id_documento){
        $query = "SELECT * 
                  FROM tbl_archivos_actividad 
                  WHERE id_archivo_actividad = ? limit 1";
        $consulta = $this->db->getQuery($query, array($id_documento));

        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }	

 //funcion sql delAdjuntosSolicitud elimina en tabla tbl_archivos
    public function delAdjuntosSolicitud($solicitud){
        $query = "DELETE FROM tbl_archivos 
                   WHERE cd_solicitud_fk_archivo = ?";
        if($this->db->execQuery($query,array($solicitud))){
            return true;
        }else{
            return false;
        }
    }

 //funcion sql getTotalArchivos selecciona en tabla tbl_archivos
     public function getTotalArchivos(){
        $query = "SELECT count(*) as total 
                  FROM tbl_archivos 
                  WHERE id_estado_archivo = 1";
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

 //funcion sql getTotalArchivosmostrar selecciona en tabla tbl_archivos	
    public function getTotalArchivosmostrar(){
        $query = "SELECT * 
                  FROM tbl_archivos 
                  WHERE id_estado_archivo = 1";
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

 //funcion sql getTotalArchivosActivos selecciona en tabla tbl_archivos	
    public function getTotalArchivosActivos(){
        $query = "SELECT count(*) as total 
                  FROM tbl_archivos 
                  WHERE id_estado_archivo = 3";
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