<?php
	/*	Victor OK */
	$session					= New Zend_Session_Namespace("usuario_carpeta");
	$parametros					= $this->_request->getParams();
	$correcto					= false;
	$error						= false;
	$datos_evento				= array();
	$rut						= $parametros['rut'];
	$id_paciente				= $parametros['id_paciente'];
	$gl_grupo_tipo_ant			= $parametros['gl_grupo_tipo'];
	$grupo_usuario_registrador	= $_SESSION['gl_grupo_tipo'];
	$count						= $this->_DAOPaciente->countPacientesxRegion($_SESSION['id_region']);

	if($parametros['edad'] > 15 AND $grupo_usuario_registrador == 'Seguimiento' AND $parametros['chkAcepta'] == 1 AND $parametros['prevision'] == 1 and $count < 50) {
		$gl_grupo_tipo	= 'Seguimiento';
		if ($gl_grupo_tipo_ant != $gl_grupo_tipo){
			$datos_evento['id_paciente']	= $id_paciente;
			$datos_evento['bo_estado']		= 1;
			$datos_evento['id_usuario_crea']= $session->id;
			$datos_evento['eventos_tipo']	= 10;
			$datos_evento['gl_descripcion'] = "Paciente RUT : ". $rut ." en seguimiento desde : " . Fechas::fechaHoy();
			$resp							= $this->_DAOEventos->insEvento($datos_evento);
		}
	}else{
		$gl_grupo_tipo	= 'Control';
	}
		
    public function getByIdPaciente($id_paciente){
        $query	= "	SELECT
                        examen.id_paciente_examen ,
                        examen.id_tipo_examen,
                        examen.id_empa,
                        examen.id_laboratorio,
                        examen.gl_folio,
                        examen.gl_resultado,
                        date_format(examen.fc_crea,'%d-%m-%Y') AS fc_crea,
                        tipo.gl_nombre_examen,
                        lab.gl_nombre_laboratorio
                    FROM pre_paciente_examen examen
						LEFT JOIN pre_tipo_examen tipo ON tipo.id_tipo_examen = examen.id_tipo_examen
						LEFT JOIN pre_laboratorio lab ON lab.id_laboratorio = examen.id_laboratorio 
                    WHERE examen.id_paciente = ?
                    ORDER BY examen.fc_crea DESC";

        $param	= array($id_paciente);
        $result	= $this->db->getQuery($query, $param);

        if ($result->numRows > 0) {
            return $result->rows;
        } else {
            return NULL;
        }
    }
	
	/*	Carolina */
	$session					= New Zend_Session_Namespace("usuario_carpeta");
	$parametros					= $this->_request->getParams();
	$correcto					= false;
	$error						= false;
	$datos_evento				= array();
	$rut						= $parametros['rut'];
	$id_paciente				= $parametros['id_paciente'];
	$gl_grupo_tipo_ant			= $parametros['gl_grupo_tipo'];
	$grupo_usuario_registrador	= $_SESSION['gl_grupo_tipo'];
	$count						= $this->_DAOPaciente->countPacientesxRegion($_SESSION['id_region']);

	if($parametros['edad'] > 15 AND $grupo_usuario_registrador == 'Seguimiento' AND $parametros['chkAcepta'] == 1 AND $parametros['prevision'] == 1 and $count < 50) {
		$gl_grupo_tipo	= 'Seguimiento';
		if ($gl_grupo_tipo_ant != $gl_grupo_tipo){
			$datos_evento['id_paciente']	= $id_paciente;
			$datos_evento['bo_estado']		= 1;
			$datos_evento['id_usuario_crea']= $session->id;
			$datos_evento['eventos_tipo']	= 10;
			$datos_evento['gl_descripcion'] = "Paciente RUT : ". $rut ." en seguimiento desde : " . Fechas::fechaHoy();
			$resp							= $this->_DAOEventos->insEvento($datos_evento);
		}
	}else{
		$gl_grupo_tipo	= 'Control';
	}
		
    public function getByIdPaciente($id_paciente){
        $query	= "	SELECT
                        examen.id_paciente_examen ,
                        examen.id_tipo_examen,
                        examen.id_empa,
                        examen.id_laboratorio,
                        examen.gl_folio,
                        examen.gl_resultado,
                        date_format(examen.fc_crea,'%d-%m-%Y') AS fc_crea,
                        tipo.gl_nombre_examen,
                        lab.gl_nombre_laboratorio
                    FROM pre_paciente_examen examen
						LEFT JOIN pre_tipo_examen tipo ON tipo.id_tipo_examen = examen.id_tipo_examen
						LEFT JOIN pre_laboratorio lab ON lab.id_laboratorio = examen.id_laboratorio 
                    WHERE examen.id_paciente = ?
                    ORDER BY examen.fc_crea DESC";

        $param	= array($id_paciente);
        $result	= $this->db->getQuery($query, $param);

        if ($result->numRows > 0) {
            return $result->rows;
        } else {
            return NULL;
        }
    }
	
	/*	Orlando */
	$session					= New Zend_Session_Namespace("usuario_carpeta");
	$parametros					= $this->_request->getParams();
	$correcto					= false;
	$error						= false;
	$datos_evento				= array();
	$rut						= $parametros['rut'];
	$id_paciente				= $parametros['id_paciente'];
	$gl_grupo_tipo_ant			= $parametros['gl_grupo_tipo'];
	$grupo_usuario_registrador	= $_SESSION['gl_grupo_tipo'];
	$count						= $this->_DAOPaciente->countPacientesxRegion($_SESSION['id_region']);

	if($parametros['edad'] > 15 AND $grupo_usuario_registrador == 'Seguimiento' AND $parametros['chkAcepta'] == 1 AND $parametros['prevision'] == 1 and $count < 50) {
		$gl_grupo_tipo	= 'Seguimiento';
		if ($gl_grupo_tipo_ant != $gl_grupo_tipo){
			$datos_evento['id_paciente']	= $id_paciente;
			$datos_evento['bo_estado']		= 1;
			$datos_evento['id_usuario_crea']= $session->id;
			$datos_evento['eventos_tipo']	= 10;
			$datos_evento['gl_descripcion'] = "Paciente RUT : ". $rut ." en seguimiento desde : " . Fechas::fechaHoy();
			$resp							= $this->_DAOEventos->insEvento($datos_evento);
		}
	}else{
		$gl_grupo_tipo	= 'Control';
	}
		
    public function getByIdPaciente($id_paciente){
        $query	= "	SELECT
                        examen.id_paciente_examen ,
                        examen.id_tipo_examen,
                        examen.id_empa,
                        examen.id_laboratorio,
                        examen.gl_folio,
                        examen.gl_resultado,
                        date_format(examen.fc_crea,'%d-%m-%Y') AS fc_crea,
                        tipo.gl_nombre_examen,
                        lab.gl_nombre_laboratorio
                    FROM pre_paciente_examen examen
						LEFT JOIN pre_tipo_examen tipo ON tipo.id_tipo_examen = examen.id_tipo_examen
						LEFT JOIN pre_laboratorio lab ON lab.id_laboratorio = examen.id_laboratorio 
                    WHERE examen.id_paciente = ?
                    ORDER BY examen.fc_crea DESC";

        $param	= array($id_paciente);
        $result	= $this->db->getQuery($query, $param);

        if ($result->numRows > 0) {
            return $result->rows;
        } else {
            return NULL;
        }
    }
	
	/*	David */
	$session					= New Zend_Session_Namespace("usuario_carpeta");
	$parametros					= $this->_request->getParams();
	$correcto					= false;
	$error						= false;
	$datos_evento				= array();
	$rut						= $parametros['rut'];
	$id_paciente				= $parametros['id_paciente'];
	$gl_grupo_tipo_ant			= $parametros['gl_grupo_tipo'];
	$grupo_usuario_registrador	= $_SESSION['gl_grupo_tipo'];
	$count						= $this->_DAOPaciente->countPacientesxRegion($_SESSION['id_region']);

	if($parametros['edad'] > 15 AND $grupo_usuario_registrador == 'Seguimiento' AND $parametros['chkAcepta'] == 1 AND $parametros['prevision'] == 1 and $count < 50) {
		$gl_grupo_tipo	= 'Seguimiento';
		if ($gl_grupo_tipo_ant != $gl_grupo_tipo){
			$datos_evento['id_paciente']	= $id_paciente;
			$datos_evento['bo_estado']		= 1;
			$datos_evento['id_usuario_crea']= $session->id;
			$datos_evento['eventos_tipo']	= 10;
			$datos_evento['gl_descripcion'] = "Paciente RUT : ". $rut ." en seguimiento desde : " . Fechas::fechaHoy();
			$resp							= $this->_DAOEventos->insEvento($datos_evento);
		}
	}else{
		$gl_grupo_tipo	= 'Control';
	}
		
    public function getByIdPaciente($id_paciente){
        $query	= "	SELECT
                        examen.id_paciente_examen ,
                        examen.id_tipo_examen,
                        examen.id_empa,
                        examen.id_laboratorio,
                        examen.gl_folio,
                        examen.gl_resultado,
                        date_format(examen.fc_crea,'%d-%m-%Y') AS fc_crea,
                        tipo.gl_nombre_examen,
                        lab.gl_nombre_laboratorio
                    FROM pre_paciente_examen examen
						LEFT JOIN pre_tipo_examen tipo ON tipo.id_tipo_examen = examen.id_tipo_examen
						LEFT JOIN pre_laboratorio lab ON lab.id_laboratorio = examen.id_laboratorio 
                    WHERE examen.id_paciente = ?
                    ORDER BY examen.fc_crea DESC";

        $param	= array($id_paciente);
        $result	= $this->db->getQuery($query, $param);

        if ($result->numRows > 0) {
            return $result->rows;
        } else {
            return NULL;
        }
    }
	
?>