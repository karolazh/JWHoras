<?php

class DAOAdjuntos extends Model{

    /**
     *
     * @var string 
     */
    protected $_tabla = "instalacion_adjuntos";
    
    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
    }
    
    public function getAdjuntosInstalacion($idInstalacion){
		
	
        $query = $this->db->select("*")
                          ->from($this->_tabla . " adjuntos")
                          ->whereAND("adjuntos.gl_eliminado" ,1,"<>")
                          ->whereAND("adjuntos.id_instalacion" ,$idInstalacion);
        
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
			
			$arrSalida = array();
			foreach($resultado->rows as $itm){
				$itm->gl_valores_campos = json_decode($itm->gl_valores_campos,true);
				$arrSalida[] = $itm;	
			}
			
            return $arrSalida;
        } else{
            return NULL;
        }
    }
	
    public function getTipos(){
		
        $query = $this->db->select("*")
                          ->from("adjuntos_tipo tipo");
                          //->whereAND("u.rut" , $rut);
        
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
            return $resultado->rows;
        } else{
            return NULL;
        }
    }	
	
    public function getTiposAmbitos($idAmbito){
		
        $query = $this->db->select("*")
                          ->from("adjuntos_tipo tipo")
                          ->whereAND("tipo.id_ambito" , $idAmbito);
        
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
            return $resultado->rows;
        } else{
            return NULL;
        }
    }		
	
	
    public function getTiposCampos(){
		
        $query = $this->db->select("*")
                          ->from("adjuntos_tipo_campos tipo")
                          ->whereAND("tipo.gl_activo" , 1);
        
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
			
			$arr = array();
			foreach($resultado->rows as $itm){
				$arr[$itm->id_ambito][$itm->id_tipo][$itm->id_campo]['nombre'] = $itm->gl_nombre;
				$arr[$itm->id_ambito][$itm->id_tipo][$itm->id_campo]['id'] = $itm->gl_campo_html;
				$arr[$itm->id_ambito][$itm->id_tipo][$itm->id_campo]['tipo'] = $itm->gl_tipo;
				
			}
			
            return $arr;
        } else{
            return NULL;
        }
    }		
	
    public function insAdjuntoLimpio($idInstalacion,$glRuta,$glNombre,$idAmbito,$idTipo){
		
		
		$fecha = date('Y-m-d H:i:s');
		$data = array(
                'id_instalacion'=> $idInstalacion,
                'gl_ruta'      	=> $glRuta."/".$glNombre,
                'gl_nombre'   	=> $glNombre,
                'id_usuario'   	=> $_SESSION['usuario']['id'],
                'cd_tipo' 		=> 0,
                'id_tipo' 		=> $idTipo,
                'id_ambito' 		=> $idAmbito,
                'fc_carga'    	=> $fecha,
                'gl_eliminado' 	=> 0
            );
        return $this->insert($data);
    }		
	
	
    public function exportarDesdeASD($idInstalacion,$arrASD){
		
		$arrAdjuntosActuales = array();
		
		foreach($this->getAdjuntosInstalacion($idInstalacion) as $item){
			$arrAdjuntosActuales[$item->gl_nombre] = $item->gl_nombre;
		}
		
		foreach($arrASD as $item){
			
			if(!isset($arrAdjuntosActuales[$item->gl_nombre_archivo])){
				$glNombre	= $item->gl_nombre_archivo;
				$idTipo		= $item->id_antecedente;
				$idAmbito	= 1;
				
				$arrTipos[1] = 3;
				$arrTipos[7] = 3;
				$arrTipos[2] = 5;
				/*
				$arrTipos[3] = ;
				$arrTipos[4] = ;
				$arrTipos[5] = ;
				*/
				$arrTipos[11] = 4;
				$arrTipos[6] = 4;
				$arrTipos[8] = 5;
				$arrTipos[14] = 10;
				
				$arrTipos['r'] = 1;				
				$arrTipos['v'] = 2;				
				
				$ruta 		= "documentos/".date("Ymd");
				@mkdir($ruta);			
				
				$data = file_get_contents("http://asdigital.minsal.cl/asdigital/".$item->gl_ruta_archivo);
				
				$out = fopen($ruta."/".$glNombre, "w");
				fwrite($out, $data);
				fclose($out);			
				
				$fecha = date('Y-m-d H:i:s');
				$data = array(
						'id_instalacion'=> $idInstalacion,
						'gl_ruta'      	=> "/".date("Ymd")."/".$glNombre,
						'gl_nombre'   	=> $glNombre,
						'id_usuario'   	=> $_SESSION['usuario']['id'],
						'cd_tipo' 		=> 0,
						'id_tipo' 		=> $arrTipos[$idTipo],
						'id_ambito' 	=> $idAmbito,
						'fc_carga'    	=> $fecha,
						'gl_eliminado' 	=> 0
					);
				$this->insert($data);			
			}	
			
		}
		
    }			
	
    public function uptAdjunto($arrForm){
		
		
		
		$arrJson = array();
		
		foreach($arrForm as $itm => $valor){
				if(substr($itm,0,4) == "var_"){
					$arrJson[$itm] = $valor;
				}	
		}

		$query = "update instalacion_adjuntos 
					set 
						gl_nombre 			= :gl_nombre,
						fc_modificado		= now(),	
						id_tipo				= :id_tipo,		
						gl_descripcion		= :gl_descripcion,
						gl_valores_campos 	= :gl_valores_campos,
						id_ambito 			= :id_ambito
					where id_adjunto 	= :id_adjunto ";
						
		return $this->db->execQuery($query,array(	":gl_nombre" 			=> $arrForm['gl_nombre'],
													":id_tipo" 				=> $arrForm['cd_tipo'],
													":gl_descripcion" 		=> $arrForm['gl_descripcion'],
													":gl_valores_campos" 	=> json_encode($arrJson),
													":id_adjunto" 			=> $arrForm['id_frm_individual'],
													":id_ambito" 			=> $arrForm['id_ambito'],
												));

    }			
	
    public function delAdjunto($arrForm){
		
		$query = "update instalacion_adjuntos 
					set 
						gl_eliminado 			= 1,
						fc_modificado		= now()	
					where id_adjunto 	= :id_adjunto ";
						
		return $this->db->execQuery($query,array(":id_adjunto" 			=> $arrForm['id_frm_individual']));

    }				
	

	
	
	
}
?>