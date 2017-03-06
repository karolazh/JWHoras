<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_evento
* Plataforma	: !PHP
* Creacion		: 24/02/2017
* @name			DAOEvento.php
* @version		1.0
* @author		Orlando Vázquez <orlando.vazquez@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOEvento extends Model{

    protected $_tabla           = "pre_evento";
    protected $_primaria		= "id_evento";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    public function getLista(){
        $query	= "	SELECT * FROM ".$this->_tabla;
        $result	= $this->db->getQuery($query);

        if($result->numRows>0){
            return $result->rows;
        }else{
            return NULL;
        }
    }

    public function getById($id){
        $query	= "	SELECT * FROM ".$this->_tabla."
						WHERE ".$this->_primaria." = ?";

		$param	= array($id);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return NULL;
        }
    }

	public function selBusquedaEventos($parametros){
        $query	= "	SELECT
							e.id_evento, 
							e.gl_descripcion,
							e.id_evento_tipo,
							date_format(e.fc_crea,'%d-%m-%Y') as fc_crea,
							e.id_paciente
						FROM pre_evento e
						WHERE 1 ";

		if(!empty($parametros["gl_descripcion"])){
			$query	.= " AND e.gl_descripcion LIKE %" . $parametros["gl_descripcion"] . "%";
		}
		if(!empty($parametros["id_evento_tipo"])){
			$query	.= " AND e.id_evento_tipo = " . $parametros["id_evento_tipo"];
		}
		if(!empty($parametros["id_paciente"])){
			$query	.= " AND e.id_paciente = " . $parametros["id_paciente"];
		}

        $result	= $this->db->getQuery($query);

        if($result->numRows>0){
            return $result->rows;
        }else{
            return NULL;
        }
	}

	public function insEvento($data){
        $query	= "INSERT into pre_evento values(null,?,?,?,?,?,?,CURRENT_TIMESTAMP)";

        $param	= array(
						$data['eventos_tipo'],
						$data['id_paciente'],
						$data['id_empa'],
						$data['gl_descripcion'],
						$data['bo_estado'],
						$data['id_usuario_crea']
						);

        if($this->db->execQuery($query, $param)) {
            return $this->db->getLastId();
        }else{
            return FALSE;
        }
    }

	public function updTipoEvento($datos){
        $query	= "	UPDATE ".$this->_tabla."
					SET    id_evento_tipo = ?
					WHERE  " . $this->_primaria . " = ? ";

		$param	= array($datos['id_evento_tipo'], $datos['id_evento']);
		
        if($this->db->execQuery($query, $param)) {
			return TRUE;
        }else{
			return FALSE;
        }
    }

	public function updDescripcion($datos){
        $query	= "	UPDATE ".$this->_tabla."
					SET    gl_descripcion = ?
					WHERE  " . $this->_primaria . " = ? ";

		$param	= array($datos['gl_descripcion'], $datos['id_evento']);

        if($this->db->execQuery($query, $param)) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function getEventosRegistro($id_paciente){
        $query	= "	SELECT
						eve.id_evento AS id_evento, 
						eve.id_evento_tipo AS id_evento_tipo, 
						tip.gl_nombre_evento_tipo AS nombre_evento,
						eve.id_paciente AS id_paciente,
						eve.gl_descripcion AS glosa,
						date_format(eve.fc_crea,'%d-%m-%Y') AS fc_crea,
						usr.gl_rut AS rut,
						concat_ws(' ' , usr.gl_nombres, usr.gl_apellidos) AS funcionario
					FROM pre_evento eve
					LEFT JOIN pre_evento_tipo tip ON tip.id_evento_tipo = eve.id_evento_tipo
					LEFT JOIN pre_usuario usr ON usr.id_usuario = eve.id_usuario_crea
					WHERE eve.id_paciente = ?";

		$param	= array($id_paciente);
        $result	= $this->db->getQuery($query,$param);
        
        if($result->numRows>0){
            return $result->rows;
        }else{
            return NULL;
        }
    }

}
