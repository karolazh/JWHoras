<?php
/**
 ******************************************************************************
 * Sistema           : PREVENCION DE FEMICIDIOS
 * 
 * Descripcion       : Modelo para Tabla pre_paciente_direccion
 *
 * Plataforma        : !PHP
 * 
 * Creacion          : 07/03/2017
 * 
 * @name             DAOPacienteDireccion.php
 * 
 * @version          1.0
 *
 * @author           Orlando Vazquez <orlando.vazquez@cosof.cl>
 * 
 ******************************************************************************
 * !ControlCambio
 * --------------
 * !cProgramador				!cFecha		!cDescripcion 
 * ----------------------------------------------------------------------------
 * <david.guzman@cosof.cl>      07-03-2017  getByIdPaciente()
 * ----------------------------------------------------------------------------
 * ****************************************************************************
 */
class DAOPacienteDireccion extends Model {

    protected $_tabla			= "pre_paciente_direccion";
    protected $_primaria		= "id_paciente_direccion";

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

	public function getById($id_direccion){
        $query	= "	SELECT * FROM ".$this->_tabla."
					WHERE ".$this->_primaria." = ?";

		$param	= array($id_direccion);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return NULL;
        }
    }
	
	/**
	 * Descripción : Lleva la informacion de la direccion a la base de datos.
	 * @author  Orlando Vasquez <orlando.vazquez@cosof.cl>
     * @param   array $datos
	 */
    public function insertarDireccion($datos){
		$query = "  INSERT INTO ".$this->_tabla." (
						id_paciente,
						id_comuna,
						id_region,
						gl_direccion,
						gl_latitud,
						gl_longitud,
						bo_estado,
						id_usuario_crea,
						fc_crea,
						id_usuario_actualiza,
						fc_actualiza
					) VALUES (
						".$datos['id_paciente'].",
						".$datos['id_comuna'].",
						".$datos['id_region'].",
						'".$datos['gl_direccion']."',
						'".$datos['gl_latitud']."',
						'".$datos['gl_longitud']."',
						".$datos['bo_estado'].",
						".$datos['id_usuario_crea'].",
						now(),
						".$_SESSION['id'].",
						now()
						)";
		
        if ($this->db->execQuery($query)) {
			return $this->db->getLastId();
        } else {
			return false;
        }
    }
	
	/**
	 * Descripción : Obtiene dirección(es) de paciente
	 * @author  David Guzmán <david.guzman@cosof.cl> 07-03-2017
     * @param   int $id_paciente
	 */
	public function getByIdPaciente($id_paciente){
		$query	= "	SELECT * FROM ".$this->_tabla."
					WHERE id_paciente = ?
					AND bo_estado = 1";

		$param	= array($id_paciente);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return NULL;
        }
	}
    
    /**
	 * Descripción : Obtiene dirección(es) de paciente con estado = 1
	 * @author  S/N
     * @param   int $id_paciente
     * @param   int $bo_estado
	 */
	public function getMultByIdPaciente($id_paciente, $bo_estado=1){
		$query = "  SELECT 
                        pac.id_paciente_direccion,
                        pac.id_paciente,
                        com.id_comuna,
                        com.gl_nombre_comuna,
                        pro.id_provincia,
                        pro.gl_nombre_provincia,
                        reg.id_region,
                        reg.gl_nombre_region,
                        pac.gl_direccion, 
                        pac.gl_latitud,
                        pac.gl_longitud,
                        pac.bo_estado,
                        pac.id_usuario_crea,
                        usr.gl_rut,
                        concat_ws(' ' , usr.gl_nombres, usr.gl_apellidos) AS funcionario,
                        date_format(pac.fc_crea,'%d-%m-%Y') AS fc_crea
                    FROM pre_paciente_direccion pac
                    LEFT JOIN pre_region reg ON reg.id_region = pac.id_region
                    LEFT JOIN pre_comuna com ON com.id_comuna = pac.id_comuna
                    LEFT JOIN pre_provincia pro ON pro.id_provincia = com.id_provincia
                    LEFT JOIN pre_usuario usr ON usr.id_usuario = pac.id_usuario_crea
                    WHERE pac.id_paciente = ?";

        if($bo_estado==1){
            $query .= ' AND bo_estado = 1';
        }
        
		$param	= array($id_paciente);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows;
        }else{
            return NULL;
        }
	}
    
    /**
	 * Descripción : Actualiza estado en tabla "pre_paciente_direccion"
	 * @author  S/N
     * @param   int $id_paciente
	 */
	public function disabDirecciones($id_paciente){
        $query = "  UPDATE pre_paciente_direccion 
                    SET bo_estado				= 0,
						id_usuario_actualiza    = ".$_SESSION['id'].",
						fc_actualiza			= now()
					WHERE id_paciente = ".$id_paciente."";

        if($this->db->execQuery($query)) {
            return TRUE;
        }else{
            return FALSE;
        }		 
	 }
         
    /**
	 * Descripción : Obtiene historial de direcciones por Id de Paciente
	 * @author  Carolina Zamora <carolina.zamora@cosof.cl>  08-03-2017
     * @param   int $id_paciente
	 */
    public function getDireccionesById($id_paciente){
        $query = "  SELECT 
                        pac.id_paciente_direccion,
                        pac.id_paciente,
                        com.id_comuna,
                        com.gl_nombre_comuna,
                        pro.id_provincia,
                        pro.gl_nombre_provincia,
                        reg.id_region,
                        reg.gl_nombre_region,
                        pac.gl_direccion, 
                        pac.gl_latitud,
                        pac.gl_longitud,
                        pac.bo_estado,
                        pac.id_usuario_crea,
                        usr.gl_rut,
                        concat_ws(' ' , usr.gl_nombres, usr.gl_apellidos) AS funcionario,
                        date_format(pac.fc_crea,'%d-%m-%Y') AS fc_crea
                    FROM pre_paciente_direccion pac
                    LEFT JOIN pre_region reg ON reg.id_region = pac.id_region
                    LEFT JOIN pre_comuna com ON com.id_comuna = pac.id_comuna
                    LEFT JOIN pre_provincia pro ON pro.id_provincia = com.id_provincia
                    LEFT JOIN pre_usuario usr ON usr.id_usuario = pac.id_usuario_crea
                    WHERE pac.id_paciente = ?
                    ORDER BY pac.bo_estado DESC";

        $param	= array($id_paciente);
        $result	= $this->db->getQuery($query, $param);

        if($result->numRows>0){
            return $result;
        }else{
            return NULL;
        }
    }

    /**
	 * Descripción : Obtiene dirección vigente por Id de Paciente
	 * @author  Carolina Zamora <carolina.zamora@cosof.cl>  08-03-2017
     * @param   int $id_paciente
	 */
    public function getDireccionVigenteById($id_paciente){
        $query = "  SELECT 
                        pac.id_paciente_direccion,
                        pac.id_paciente,
                        com.id_comuna,
                        com.gl_nombre_comuna,
                        pro.id_provincia,
                        pro.gl_nombre_provincia,
                        reg.id_region,
                        reg.gl_nombre_region,
                        pac.gl_direccion, 
                        pac.gl_latitud,
                        pac.gl_longitud,
                        pac.bo_estado,
                        pac.id_usuario_crea,
                        pac.fc_crea
                    FROM pre_paciente_direccion pac
                    LEFT JOIN pre_region reg ON reg.id_region = pac.id_region
                    LEFT JOIN pre_comuna com ON com.id_comuna = pac.id_comuna
                    LEFT JOIN pre_provincia pro ON pro.id_provincia = com.id_provincia
                    WHERE pac.id_paciente = ?
                    AND pac.bo_estado = 1
                    ORDER BY fc_crea DESC
                    LIMIT 1";

        $param	= array($id_paciente);
        $result	= $this->db->getQuery($query, $param);

        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return NULL;
        }
    }
}

?>