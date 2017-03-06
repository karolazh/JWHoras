<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_adjunto
* Plataforma	: !PHP
* Creacion		: 22/02/2017
* @name			DAOAdjunto.php
* @version		1.0
* @author		Carolina Zamora <carolina.zamora@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOAdjunto extends Model{

    protected $_tabla           = "pre_adjunto";
    protected $_primaria		= "id_adjunto";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    public function getLista(){
        $query		= "	SELECT * FROM ".$this->_tabla;
        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getById($id){
        $query		= "	SELECT * FROM ".$this->_tabla."
						WHERE ".$this->_primaria." = ?";

		$param		= array($id);
        $resultado	= $this->db->getQuery($query,$param);
		
        if($resultado->numRows > 0){
            return $resultado->rows->row_0;
        }else{
            return null;
        }
    }
    
    public function getByIdPaciente($id_paciente) {
        $query		= "	SELECT gl_path 
						FROM pre_adjunto
						WHERE id_paciente = ?";

		$params		= array($id_paciente);
        $resultado	= $this->db->getQuery($query, $params);

		if($resultado->numRows > 0) {
            return $resultado->rows->row_0;
        }else{
            return null;
        }
    }
    
    public function getDetalleByIdPaciente($id_paciente){
        $query		= "	SELECT 
							adj.id_adjunto,
							adj.id_paciente,
							adj.id_adjunto_tipo,
							tip.gl_nombre_tipo_adjunto,
							adj.gl_path,
							adj.gl_glosa,
							substring_index(substring_index(adj.gl_path,'/',-1),'/',1) AS archivo,
							date_format(adj.fc_crea,'%d-%m-%Y') AS fc_crea,
							usr.gl_rut,
							concat_ws(' ' , usr.gl_nombres, usr.gl_apellidos) AS funcionario
						FROM pre_adjunto adj
							LEFT JOIN pre_adjunto_tipo tip ON tip.id_adjunto_tipo = adj.id_adjunto_tipo
							LEFT JOIN pre_usuario usr ON usr.id_usuario = adj.id_usuario_crea
						WHERE adj.id_paciente = ?";
        
        $params		= array($id_paciente);
        $resultado	= $this->db->getQuery($query, $params);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

	/*
    public function insertarAdjunto($parametros){
        $query	= "	INSERT INTO pre_adjunto 
						(
                        id_paciente,
						id_adjunto_tipo,
						id_empa,
						gl_nombre,
						gl_path,
						gl_glosa,
						sha256,
						fc_crea,
						id_usuario_crea
						)
						VALUES 
						(
						".$parametros['id_paciente'].",
						".$parametros['id_adjunto_tipo'].",
						".$parametros['id_empa'].",
						'".$parametros['gl_nombre']."',
						'".$parametros['gl_path']."',
						'".$parametros['gl_glosa']."',
						'".$parametros['sha256']."',
						now(),
						".$_SESSION['id']."
						)";
                  
        if($this->db->execQuery($query)) {
            return $this->db->getLastId();
        }else{
            return false;
        }
    }
    */

}

?>