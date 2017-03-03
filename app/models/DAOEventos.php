<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOEventos.php
!Sistema			: PREVENCIÓN
!Descripcion  		: Controlador que Busca, Actualiza e Inserta eventos.
!Plataforma   		: !PHP
!Itinerado    		: 1
!Autor        		: Orlando Vázquez
!Creacion     		: 24/02/2017
=============================================================================
*****************************************************************************
!EndHeaderDoc 
*/

class DAOEventos extends Model{

    protected $_tabla           = "pre_eventos";
    protected $_primaria		= "id_evento";

    function __construct()
    {
        parent::__construct();
    }

    public function selListaEventos(){
        $query		= "SELECT 
							id_evento,
							id_evento_tipo,
							id_registro,
							gl_descripcion,
							fc_crea,
							id_usuario_crea
						FROM pre_eventos";
        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

	public function selEventoById($id_evento, $not_in = array()) {
		$query = $this->db->select(" e.* ")
                ->from($this->_tabla . " e ")
                ->whereAND(" e.".$this->_primaria, $id_evento);
        if (count($not_in) > 0) {
            $query->whereAND(" e." . $this->_primaria, $not_in, "NOT IN");
        }
        $resultado = $query->getResult();
        if ($resultado->numRows > 0) {
            return $resultado->rows->row_0;
        } else {
            return NULL;
        }
    }

	public function selBusquedaEventos($parametros){
	        $query = $this->db->select(	"	e.id_evento, 
											gl_descripcion, 
											id_evento_tipo, 
											date_format(fc_crea,'%d-%m-%Y') as fc_crea, 
											id_registro ")
	                          ->from($this->_tabla . " e ");    
	        if(!empty($parametros["gl_descripcion"])){
	            $query->whereAND(" e.gl_descripcion " , "%" . $parametros["gl_descripcion"] . "%", "LIKE");
	        }
			if(!empty($parametros["id_evento_tipo"])){
	            $query->whereAND(" e.id_evento_tipo " , "%" . $parametros["id_evento_tipo"] . "%", "LIKE");
	        }
	        if(!empty($parametros["id_registro"])){
	            $query->whereAND(" e.id_registro " , "%" . $parametros["id_registro"] . "%", "LIKE");
	        }
			if(!empty($parametros["fc_crea"])){
	            $query->whereAND(" e.fc_crea " , "%" . $parametros["fc_crea"] . "%", "LIKE");
	        }
	        fb($query->query());
	        return $query;
	    }

	public function insEvento($data){
        $query = "insert into pre_eventos values(null,?,?,NULL,?,?,CURRENT_TIMESTAMP,?)";
        $parametros = array($data['eventos_tipo'], 
							$data['id_registro'], 
							$data['gl_descripcion'], 
							$data['bo_estado'],
							$data['id_usuario_crea']);
        if ($this->db->execQuery($query, $parametros)) {
            return true;
        } else {
            return false;
        }

    }

	public function insEventoEmpa($data){
        $query = "insert into pre_eventos values(null,?,NULL,?,?,?,CURRENT_TIMESTAMP,?)";
        $parametros = array($data['eventos_tipo'], 
							$data['id_empa'], 
							$data['gl_descripcion'], 
							$data['bo_estado'],
							$data['id_usuario_crea']);
        if ($this->db->execQuery($query, $parametros)) {
            return true;
        } else {
            return false;
        }

    }
	
	public function updTipoEvento($datos){
        $query = "UPDATE ".$this->_tabla."
                  SET    id_evento_tipo = ?
                  WHERE  " . $this->_primaria . " = ? ";
		$parametros = array($datos['id_evento_tipo'], 
							$datos['id_evento']);
        if ($this->db->execQuery($query, $parametros)) {
            return true;
        } else {
            return false;
        }
    }

	public function updDescripcion($datos){
        $query = "UPDATE ".$this->_tabla."
                  SET    gl_descripcion = ?
                  WHERE  " . $this->_primaria . " = ? ";
		$parametros = array($datos['gl_descripcion'], 
							$datos['id_evento']);
        if ($this->db->execQuery($query, $parametros)) {
            return true;
        } else {
            return false;
        }
    }
	
}
