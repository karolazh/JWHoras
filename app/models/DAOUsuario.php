<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_usuario
* Plataforma	: !PHP
* Creacion		: 20/02/2017
* @name			DAOUsuario.php
* @version		1.0
* @author		Orlando Vazquez <orlando.vazquez@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*<victor.retamal@cosof.cl>	27-02-2017	Add getLogin(), getLoginMidas() y registro_login()
*
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOUsuario extends Model {

    protected $_tabla			= "pre_usuario";
    protected $_primaria		= "id_usuario";

    function __construct(){
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

    public function getByRut($gl_rut) {
        $query	= "	SELECT * 
					FROM pre_usuario
					WHERE gl_rut = ?";

		$param	= array($gl_rut);
        $result	= $this->db->getQuery($query,$param);

        if ($result->numRows > 0) {
            return $result->rows->row_0;
        } else {
            return NULL;
        }
    }

	/**
	* getLogin($gl_rut, $gl_password)
	* Obtener la información para Validar al usuario e Iniciar la Session
	* 
	* @author	<victor.retamal@cosof.cl>	27-02-2017
	* 
	* @param string	$gl_rut del usuario.
	* @param string	$gl_password  del usuario.
	*
	* @return object Información del usuario
	*/
    public function getLogin($gl_rut, $gl_password) {
        $query	= "	SELECT 
						u.*,
						r.gl_nombre_region,
						p.gl_nombre_provincia,
						c.id_provincia,
						c.gl_nombre_comuna
					FROM pre_usuario u 
						LEFT JOIN pre_region r ON u.id_region = r.id_region
						LEFT JOIN pre_comuna c ON u.id_comuna = c.id_comuna
						LEFT JOIN pre_provincia p ON c.id_provincia = p.id_provincia
					WHERE u.gl_rut = ? 
						AND u.gl_password = ?";

        $param	= array($gl_rut, $gl_password);
        $result	= $this->db->getQuery($query, $param);

        if ($result->numRows > 0) {
            return $result->rows->row_0;
        } else {
            return NULL;
        }
    }

	/**
	* getLoginMidas($gl_rut)
	* Obtener la información para Validar al usuario que ingresa desde MIDAS e Iniciar la Session
	* 
	* @author	<victor.retamal@cosof.cl>	27-02-2017
	* 
	* @param string	$gl_rut del usuario.
	*
	* @return object Información del usuario
	*/

    public function getLoginMidas($gl_rut) {
        $query	= "	SELECT 
                        u.*,
                        r.gl_nombre_region,
                        p.gl_nombre_provincia,
                        c.id_provincia,
                        c.gl_nombre_comuna
					FROM pre_usuario u 
                        LEFT JOIN pre_region r ON u.id_region = r.id_region
                        LEFT JOIN pre_comuna c ON u.id_comuna = c.id_comuna
                        LEFT JOIN pre_provincia p ON c.id_provincia = p.id_provincia
					WHERE u.gl_rut = ? ";

        $param	= array($gl_rut);
        $result	= $this->db->getQuery($query, $param);

        if ($result->numRows > 0) {
            return $result->rows->row_0;
        } else {
            return NULL;
        }
    }

    public function setUltimoLogin($datos){
        $query	= "	UPDATE pre_usuario
					SET fc_ultimo_login = now()
					WHERE id_usuario = ? ";

        if ($this->db->execQuery($query, $datos)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function setPassword($datos){
        $query	= "	UPDATE pre_usuario
					SET gl_password = ? , fc_ultimo_login = ?
					WHERE id_usuario = ? ";

        if ($this->db->execQuery($query, $datos)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>