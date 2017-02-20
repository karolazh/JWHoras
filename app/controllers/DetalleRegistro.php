<?php
	class DetalleRegistro extends Controller{
                protected $_DAOPaciente;
                protected $_DAORegistro;
                
                function __construct(){
			parent::__construct();
			$this->_DAORegistro = $this->load->model("DAORegistro");
                        $this->_DAOPaciente = $this->load->model("DAOPaciente");
		}

		public function index(){
		}

		public function detalleRegistro(){
			
	        $parametros = $this->request->getParametros();
	        $rut = $parametros[0];
	        $detPac = $this->_DAOPaciente->getPaciente($rut);
                $detReg = $this->_DAORegistro->getListaRegistroById($detPac->pac_id);
  	        if(!is_null($detPac) && !is_null($detReg)){       
                    $this->smarty->assign("detPac", $detPac);
                    $this->smarty->assign("detReg", $detReg);
	            $this->smarty->display('avanzados/detalle.tpl');
	        } 
	        else {
	            throw new Exception("El historial que está buscando no existe");
	        }
	    }

	}
?>