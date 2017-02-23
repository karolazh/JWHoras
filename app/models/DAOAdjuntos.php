<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOAdjuntos.php
!Sistema 	  	: PREVENCIÓN
!Modulo 	  	: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carolina Zamora
!Creacion     		: 22/02/2017
!Retornos/Salidas 	: NA
!OrigenReq        	: NA
=============================================================================
!Parametros 		: NA 
=============================================================================
!Testing 		: NA
=============================================================================
!ControlCambio
--------------
!cVersion !cFecha   !cProgramador   !cDescripcion 
-----------------------------------------------------------------------------

-----------------------------------------------------------------------------
*****************************************************************************
!EndHeaderDoc 
*/

class DAOAdjuntos extends Model{

    /**
     *
     * @var string 
     */
    protected $_tabla           = "pre_adjuntos";
    protected $_primaria	= "id_adjunto";
    protected $_transaccional	= false;

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }
    
    public function getAdjuntoByRegistro($id_registro) {
        $query = "SELECT gl_path FROM ". $this->_tabla ." WHERE id_registro = ?";
        $params = array($id_registro);
        $resultado = $this->db->getQuery($query, $params);
        if ($resultado->numRows > 0) {
            return $resultado->rows->row_0;
        } else {
            return null;
        }
    }
    
    public function getTipos() {

        $query = $this->db->select("*")
                ->from("pre_adjuntos_tipo tipo");
        //->whereAND("u.rut" , $rut);

        $resultado = $query->getResult();
        if ($resultado->numRows > 0) {
            return $resultado->rows;
        } else {
            return NULL;
        }
    }

    /*
     * Lista Adjuntos (todos)
     */
    public function getListaAdjuntos(){
        $query		= "SELECT * FROM pre_adjuntos";
        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
    /*
     * Lista Adjuntos (por registro)
     */
    public function getListaAdjuntosRegistro($id_registro){
        $query		=   "SELECT 
                                adj.id_adjunto AS id_adjunto,
                                adj.id_registro AS id_registro,
                                adj.id_tipo_adjunto AS id_tipo_adjunto,
                                tip.gl_nombre_tipo_adjunto AS nombre_tipo_adjunto,
                                adj.gl_path AS path,
                                adj.gl_glosa AS glosa,
                                date_format(adj.fc_crea,'%d-%m-%Y') AS fc_crea,
                                usr.gl_rut AS rut
                            FROM pre_adjuntos adj
                            LEFT JOIN pre_adjuntos_tipo tip ON tip.id_tipo_adjunto = adj.id_tipo_adjunto
                            LEFT JOIN pre_usuarios usr ON usr.id_usuario = adj.id_usuario_crea
                            WHERE adj.id_registro = ?";
        
        $params		= array($id_registro);
        $resultado	= $this->db->getQuery($query, $params);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

}

?>