<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAORegistro.php
!Sistema 	  	: PREVENCIÓN
!Modulo 	  	: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carolina Zamora Hormazábal, Orlando Vázquez G.
!Creacion     		: 14/02/2017
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

class DAORegistro extends Model{
    /**
     * @var string 
     */
    protected $_tabla		= "pre_registro";
    protected $_primaria	= "id_registro";
    
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Lista Registro
     */
    public function getListaRegistro(){

        $query = "select "
                . "id_registro, "
                . "gl_rut, "
                . "gl_nombres, "
                . "gl_apellidos "
                . "from pre_registro r "
                ;

        $resultado = $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
	public function getListaRegistroById($id_registro){
        $query	= "	SELECT 
						date_format(r.reg_fec_ingreso,'%d-%m-%Y') as reg_fec_ingreso,
						date_format(r.reg_hora_ingreso,'%H:%i:%s') as reg_hora_ingreso,
						r.reg_motivo_consulta,
						r.reg_historia_enfermedad,
						r.reg_diagnostico,
						r.reg_indicacion_medica
					FROM tab_registro r 
						INNER JOIN tab_pacientes p ON p.pac_id= r.reg_pac_id 
					WHERE p.pac_id = ? " ;
		
		$param		= array($id_registro);
        $resultado	= $this->db->getQuery($query,$param);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
    /*
     * Ver Registro
     */	
    public function getRegistro($id_registro){
        $query = "select "
                . "id_registro, "
                . "gl_rut, "
                . "gl_extranjero, "
                . "gl_run_pass, "
                . "gl_nombres, "
                . "gl_apellidos, "
                . "date_format(fc_nacimiento,'%d-%m-%Y') as fc_nacimiento, "
                . "gl_sexo, "
                . "id_prevision, "
                . "gl_direccion, "
                . "id_comuna, "
                . "gl_fono, "
                . "gl_celular, "
                . "gl_email, "
                . "fc_act, "
                . "gl_latitud, "
                . "gl_longitud, "
                . "gl_reconoce, "
                . "gl_acepta_programa, "
                . "id_adjunto, "
                . "gl_seguimiento, "
                . "id_estado_caso, "
                . "id_institucion,"
                . "id_usuario_crea, "
                . "fc_crea "
                . "from pre_registro "
                . "where id_registro = ?";


        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
    
    public function getRegistro1($rut_registro){

        $query	= "	SELECT 
						id_registro,
						gl_nombres,
						gl_apellidos,
						date_format(fc_nac,'%d-%m-%Y') as fc_nac,
						id_prevision,
						gl_direccion,
						gl_fono,
						gl_email,
						gl_celular
					FROM pre_registro 
					WHERE gl_rut = ?";

		$param		= array($rut_registro);
        $consulta	= $this->db->getQuery($query,$param);


        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
}

?>