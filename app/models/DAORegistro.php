<?php

/*
  !IniHeaderDoc
 * ****************************************************************************
  !NombreObjeto 		: DAORegistro.php
  !Sistema 	  	: PREVENCIÓN
  !Modulo 	  	: NA
  !Descripcion  		:
  !Plataforma   		: !PHP
  !Perfil       		:
  !Itinerado    		: NA
  !Uso          		: NA
  !Autor        		: Carolina Zamora Hormazábal
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
 * ****************************************************************************
  !EndHeaderDoc
 */

class DAORegistro extends Model {

    /**
     * @var string 
     */
    protected $_tabla = "pre_registro";
    protected $_primaria = "id_registro";

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }

    /*
     * Lista Registro
     */

    public function getListaRegistro() {

        $query = "select "
                . "id_registro, "
                . "gl_rut, "
                . "gl_nombres, "
                . "gl_apellidos "
                . "from pre_registro r "
        ;

        $resultado = $this->db->getQuery($query);

        if ($resultado->numRows > 0) {
            return $resultado->rows;
        } else {
            return NULL;
        }
    }

    /*
     * Ver Registro
     */
	


    public function getRegistroById($id_registro) {
        $query = "select "
                . "id_registro, "
                . "gl_rut, "
                . "bo_extranjero, "
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
                . "fc_actualiza, "
                . "gl_latitud, "
                . "gl_longitud, "
                . "bo_reconoce, "
                . "bo_acepta_programa, "
                . "id_adjunto, "
                . "id_estado_caso, "
                . "id_institucion,"
                . "id_usuario_crea, "
                . "fc_crea "
                . "from pre_registro "
                . "where id_registro = ?";
        $param = array($id_registro);
        $consulta = $this->db->getQuery($query, $param);

        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }

    public function getRegistroByRut($rut_registro) {

        $query = "	SELECT 
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


        $param = array($rut_registro);
        $consulta = $this->db->getQuery($query, $param);


        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }

}

?>