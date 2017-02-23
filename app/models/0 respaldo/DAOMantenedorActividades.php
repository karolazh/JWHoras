<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOMantenedorActividades.php
!Sistema 	  		: Gestion Calidad
!Modulo 	  		: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carlos Escalona
!Creacion     		: 09/11/2016
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

//clase DAOMantenedorActividades
class DAOMantenedorActividades extends Model{

//funcion construct
   function __construct()
    {
        parent::__construct();
    }

//funcion sql getActividades inserta en tabla tbl_actividad	y tabla usuario
	public function getActividades($id_usuario){

        $query = "SELECT a.id_actividad,
						 a.fecha_creacion_actividad,
						 a.actividad,
						 u.nombres,
						 u.apellidos,
						 ad.respondio,
                         tau.id_actividad,
                         tau.id_usuario,
                         tau.id_actividad_usuario
				  FROM tbl_actividad a
				  JOIN tbl_usuario u on u.id = a.id_usuario
                  LEFT JOIN tbl_actividad_detalle ad on ad.id_actividad = a.id_actividad
				  JOIN tbl_actividad_usuario tau on a.id_actividad = tau.id_actividad
				  WHERE tau.id_usuario = " .$id_usuario;

        $resultado = $this->db->getQuery($query);
       
       if($resultado->numRows > 0){
            $arrSalida = array();
            $i=0;
            foreach($resultado->rows as $itm){
                $arrSalida[] = $itm;
            }
            return $arrSalida;
        }else{
            return NULL;
        }
    }
	
//funcion sql getArchivosSolicitudArchivos selecciona en tabla tbl_actividad y tbl_usuario	
    public function getActividadesRevisar($id_actividad){
		
        $query = "SELECT a.id_actividad,
						 a.fecha_creacion_actividad,
						 a.actividad,
						 u.nombres,
						 u.apellidos,
						 ad.respondio,
						 ad.comentario,
						 ad.id_tipo_respuesta
				  FROM tbl_actividad a
				  JOIN tbl_usuario u on u.id = a.id_usuario
				  LEFT join tbl_actividad_detalle ad on ad.id_actividad = a.id_actividad
				  WHERE a.id_actividad = ".$id_actividad;

        $consulta = $this->db->getQuery($query, array($id_actividad));

        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
	
//funcion sql de tipo de respuestas
    public function getListaTipoRespuestas(){
        $query = $this->db->select("id_tipo_respuesta , nombre_tipo_respuesta")->from("tbl_tipo_respuesta");
        $resultado = $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
	
//funcion sql insActividad inserta en tabla tbl_actividad_detalle
    public function insActividad($datos){
        extract($datos);
        $query = "INSERT INTO tbl_actividad_detalle (id_actividad_detalle,
												     id_actividad,
												     id_tipo_respuesta,
												     id_usuario,
												     comentario,
												     fecha_respuesta,
													 respondio) 
                                           VALUES (null,?,?,?,?,?,?)";
        $parametros = array($id_actividad,
							$id_tipo_respuesta,
							$id_usuario,
							$comentario,
							$fc_fecha_respuesta,
							$respondio
							);

		if($this->db->execQuery($query,$parametros)){
            return $this->db->lastInsertId();
        }else{
            return null;
        }
    }
	
//funcion sql insArchivo inserta en tabla tbl_archivos	
    public function insArchivo($data){
        $query = "INSERT INTO tbl_archivos VALUES(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
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
        if($this->db->execQuery($query, $parametros)){
            return true;
        }else{
            return null;
        }
    }
	
//funcion sql insArchivo inserta en tabla tbl_archivos	
    public function insArchivoActividad($data){
        $query = "INSERT INTO tbl_archivos_actividad VALUES(null,?,?,?,?,?,?,?,?)";
        $parametros = array($data['id_actividad'],
							$data['usuario_id'],
							$data['fecha_subida'],
                            $data['nombre'],
                            $data['nombre_archivo'],							
                            $data['ruta'],
                            $data['sha'],
                            $data['mime']                            
                            );
							
		
        if($this->db->execQuery($query, $parametros)){
            return true;
        }else{
            return null;
        }
    }
	
//funcion sql updateActividadDetalle actualiza  en tabla tbl_actividad_detalle
    public function updateActividadDetalle($datos){
        extract($datos);

         $query = "UPDATE tbl_actividad_detalle
                    SET   id_usuario_modifica         = ?,
                          fecha_respuesta_actualizada = ?,
						  id_tipo_respuesta           = ?,
						  comentario			      = ?
                    WHERE id_actividad                = ? ";

        $parametros = array($id_usuario_modifica,
							$fecha_respuesta_actualizada,
							$id_tipo_respuesta,
							$comentario,							
							$id_actividad
        );

        if ($this->db->execQuery($query, $parametros)) {
            return $id_actividad;
        } else {
            return null;
        }
    }	
	
}

?>
