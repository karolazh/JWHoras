<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOMantenedorPlanificacion.php
!Sistema 	  		: Gestion Calidad
!Modulo 	  		: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carlos Escalona
!Creacion     		: 21/10/2016
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

//clase DAOMantenedorPlanificacion
class DAOMantenedorPlanificacion extends Model{
    /**
     * Constructor
     */
	 
//funcion construct
   function __construct()
    {
        parent::__construct();
    }

//funcion sql getListaRegion lista regiones 
    public function getListaRegion(){
        $query = $this->db->select("id_region , nombre_region")->from("tbl_regiones");
        $resultado = $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

//funcion sql getListaProvincias lista Provincias
    public function getListaProvincias(){
        $query = $this->db->select("id_provincia , nombre_provincias, id_region")->from("tbl_provincias");
        $resultado = $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

//funcion sql getListaOficinas lista las oficinas	
    public function getListaOficinas(){
        $query = $this->db->select("id_oficina , nombre_oficina")->from("tbl_oficinas");
        $resultado = $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

//funcion sql getListaTipoActividad lista tipo actividades
    public function getListaTipoActividad(){
        $query = $this->db->select("id_tipo_actividad , nombre_tipo_actividad")->from("tbl_tipo_actividad");
        $resultado = $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
 
//funcion sql insEvento que inserta en tabla actividades  
    public function insEvento($datos){
        extract($datos);
        $query = "insert into tbl_actividad (id_actividad,id_usuario,id_region,id_provincia,id_oficina,fecha_creacion_actividad,id_tipo_actividad,actividad,fecha_desde,fecha_hasta,hora_desde,hora_hasta,invitados) 
                                    values (null,?,?,?,?,?,?,?,?,?,?,?,?)";
        $parametros = array(
            $id_usuario,
            $region,
            $provincias,
            $oficina,
            $fecha_creacion_actividad,
            $tipo_actividad,
            $actividad,
            $fecha_inicio,
            $fecha_termino,
            $hora_inicio,            
            $hora_termino,
            $invitacion
        );

        if ($this->db->execQuery($query, $parametros)) {
            return $this->db->lastInsertId();

        } else {
            return null;
        }
    }
	
//funcion sql getListaTipoActividad lista tipo actividades
    public function getListaUsuarios($i){		
	   $query = "SELECT id FROM tbl_usuario WHERE email = ? ";
			return $this->db->getQuery($query,array($i));
    }

//funcion sql insEvento que inserta en tabla actividades  
    public function insUsuariosInvitacion($datos_usuario){
        extract($datos_usuario);
		
        $query = "insert into tbl_actividad_usuario (id_actividad_usuario,
													 id_usuario,
													 id_actividad) 
                                    values (null,?,?)";
        $parametros = array($id_usuario,
							$id_actividad
        );
		
        if ($this->db->execQuery($query, $parametros)) {
            return $this->db->lastInsertId();

        } else {
            return null;
        }
    }




	
}

?>
