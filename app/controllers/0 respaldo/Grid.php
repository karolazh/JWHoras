<?php

/**
 * Shorthill
 *
 * @copyright   Copyright (c) 2011 Shorthill Solutions (http://www.shorthillsolutions.com)
 * @author      Carlos Ayala <carlos.ayala@shorthillsolutions.com>
 */

class Grid extends Controller{
   
    /**
     * Nombre de la tabla
     * @var string 
     */
    protected $_title;
    
    /**
     * Datos guardados en cache
     * @var array 
     */
    protected $_data;
    
    public function limpiar_todos(){
        header('Content-type: application/json');
        $parametros = $this->request->getParametros();
        $this->_title = $parametros[0];
        
        $session = $this->load->lib("Helpers/Session", true, "Session");
        $session->setNombreSesion($this->_title . "_session");
        $session->limpiar();
        
        $salida = array("cantidad" => 0);
        $json = Zend_Json::encode($salida);
        echo $json;
    }
    
    public function seleccionar_todos(){
        header('Content-type: application/json');
        $parametros = $this->request->getParametros();
        $this->_title = $parametros[1];
        fb($parametros);
        
        $sesion = New Zend_Session_Namespace("tablas");
        $tabla = $sesion->tablas;
        $this->_data = $tabla[$this->_title];
        
        $session = $this->load->lib("Helpers/Session", true, "Session");
        $session->setNombreSesion($this->_title . "_session");
        
        $tipo = $parametros[0];
            
        $query = $this->_getQueryExcel();
        $lista = $query->getResult();
        if($lista->numRows>0){
            foreach($lista->rows as $item){
                if($tipo == "todos"){
                    //FP(__METHOD__ . " - Agregando ".$item->id);
                    $session->add($item->id);
                }elseif($tipo == "limpiar"){
                    $session->remove($item->id);
                }
            }
        }
        

        
        $salida = array("cantidad" => $session->quantity());
        $json = Zend_Json::encode($salida);
        echo $json;

    }
    
    
    public function excel(){
        $parametros = $this->request->getParametros();
        $sesion = New Zend_Session_Namespace("tablas");
        $tabla = $sesion->tablas;
        $this->_data = $tabla[$parametros[0]];
        $this->_addPlugin();
       /* echo "<pre>";
        print_r($this->_data);
        echo "</pre>";
        die();*/
        $this->_title = $parametros[0];
        
        $letras = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
        // Create new PHPExcel object
        
        $this->load->lib("PHPExcel", false);
        $objPHPExcel = New PHPExcel();

// Set document properties
        $objPHPExcel->getProperties()->setCreator("Grilla Cosof")
                                     ->setLastModifiedBy("Grilla Cosof")
                                     ->setTitle("")
                                     ->setSubject("Grilla")
                                     ->setDescription($this->_title)
                                     ->setKeywords("office 2007 openxml php")
                                     ->setCategory("Sumanet");
        
        //$objPHPExcel->setActiveSheetIndex(0);
        $i=0;
        foreach($this->_data["columns"] as $columna){
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letras[$i] . '1', strip_tags($columna["column_name"]));
            $i++;
        }

        
        
        
        $limit = array("comienzo" => 0, "total" => 100);
        $sw = true;
        
        $fila = 2;
        while($sw){
        
            $query = $this->_getQueryExcel();
            $this->_orderBy($query);
            $query->limit($limit["comienzo"], $limit["total"]);
            $resultado = $query->getResult();
            if($resultado->numRows>0){
                 
                
                 foreach($resultado->rows as $item){
                     $data = $this->_getDataColumn($item);

                     //$objPHPExcel->setActiveSheetIndex(0);

                     $i=0;
                     foreach($data as $col){
                         $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letras[$i] . $fila, strip_tags($col));
                         $i++;
                     }

                     $fila++;
                 }
                 $limit["comienzo"] = $limit["comienzo"] + $limit["total"];
            } else {
                $sw = false;
            }
        }
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle($this->_title);
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$this->_title.'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
        
    /**
     * Añade directorio de plugins
     */
    protected function _addPlugin(){
        if(!empty($this->_data["helpers"])){
            foreach($this->_data["helpers"] as $helper){
                $this->smarty->addPluginsDir($helper["ruta"]);
            }
        }
    }
    
    /**
     * Lista los datos en JSON
     */ 
    public function listar(){

        
        
        $title = $this->_request->getParam("name");
        $this->_title = $title;
        
        $sesion = New Zend_Session_Namespace("tablas");
        $tabla = $sesion->tablas;
        $this->_data = $tabla[$this->_title];
        fb($this->_data);
        
        $this->_addPlugin();
        # Pagination parameters
        $start 	= $this->_request->getPost('start', 1);
        $resultsPerPage = $this->_request->getPost('length', 10);

        $query = $this->_getQuery();
        

        $this->_orderBy($query);
        
        $query->limit($start, $resultsPerPage);
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
            $list = $resultado->rows;
        } else {
            $list = NULL;
        }
        $total = $this->_getTotal();
        //$list = $query->getQuery()->getResult();

        $elements = array();
        # We also have to format our data array that flexifrid could retrieve itt
        if(!is_null($list)){
            foreach($list as $item){
                $elements[] = $this->_getDataColumn($item);
            }
        }

        echo Zend_Json::encode(array(
            'draw' => $this->_request->getParam("draw"),
            'recordsTotal'	=> $total,
            'recordsFiltered' => $total,
            'data'	=>	$elements
        ));
        

    }
    
    protected function _orderBy(&$query){
        $order = $this->_request->getParam("order");
        $order_column = $order[0]['column'];

        if($order[0]['dir'] == "desc"){
            $direccion = "desc";
        } else {
            $direccion = "asc";
        }

        if(isset($this->_data['columns'][$order_column]['sortable']) && $this->_data['columns'][$order_column]['sortable']['active']){
            if(isset($this->_data['columns'][$order_column]['sortable']['sortable_join'])){
                $query->leftJoin($this->_data['columns'][$order_column]['sortable']['sortable_join'][0],$this->_data['columns'][$order_column]['sortable']['sortable_join'][1]);
            }
            $query->orderBy($this->_data['columns'][$order_column]['sortable']['sortable_field'], $direccion);
        } else {
            $query->orderBy("id","desc");
        }
    }
    
     /**
     * Activa o desactiva un campo boolean
     */
    public function activeDeactiveAction(){

        $this->_title = $this->_getParam("name");
        $cache = App_Cache_Set::cacheEterno();
       // fb("entrando");
        if(($this->_data = $cache->load($this->_title . session_id())) === false){
            
        } else {
            $entity_manager = App_Doctrine_Repository::entityManager();
            
            $numero_columna = (int) $this->_getParam("column");
            
            $model_repository = App_Doctrine_Repository::repository($this->_data['model']);
            $model = $model_repository->findOneBy(array("id" => $this->_getParam("id")));
            
            if($model){
               $columna = $this->_data['columns'][$numero_columna];
               //fb($columna);
               
               $activo = !$model->{$columna['column_get']}();
               $model->{$columna['column_set']}($activo);
               
               $entity_manager->persist($model);
               $entity_manager->flush();
               
               $this->view->result = $activo;
            }
        }
    }
    
    /**
     * Ejecuta la consulta
     * @return Database 
     */
     protected function _getQuery($guarda_busqueda = true){
        $req = $this->_request;
        require_once APP_PATH . "models/". $this->_data['model'] . ".php";
        $model = New $this->_data['model'](); // $this->load->model($this->_data['model']);

        $params = array();
        $busqueda = array();
        foreach($this->_data['query']['params'] as $key => $value){
            if(is_array($req->getParam($value))){
                $params[$key] = $req->getParam($value);
                $busqueda[$key] = $req->getParam($value);
            } else {
                $params[$key] = trim($req->getParam($value));
                $busqueda[$key] = trim($req->getParam($value));
            }
        }
        
        
        
        foreach($this->_data['query']['fixed'] as $key => $value){
            $params[$key] = trim($value);
            $busqueda[$key] = trim($value);
        }
        
        if($guarda_busqueda){
            $session = new Zend_Session_Namespace("search");
            $session->{$this->_title} = $busqueda;
        }
        
        //fb($this->_data['query']);

        $query  = $model->{$this->_data['query']['method']}($params);

        return $query;
    }
    
    protected function _getQueryExcel(){
        require_once APP_PATH . "models/". $this->_data['model'] . ".php";
        $model = New $this->_data['model']();
        
        $session = new Zend_Session_Namespace("search");
        $busqueda = $session->{$this->_title};
        $query  = $model->{$this->_data['query']['method']}($busqueda);

        return $query;
        
    }
    
    /**
     * Devuelve la cantidad total de resultados
     * @return int 
     */
    protected function _getTotal(){
        $query = $this->_getQuery();
        $query->select('COUNT(*) as cantidad', false);
        
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
            fb($resultado);
            return $resultado->rows->row_0->cantidad;
        } else {
            return 0;
        }
    }
    
    /**
     * Muestra el dato de la columna
     * @param /Model/Entity/xxxx $item
     * @return array 
     */
    protected function _getDataColumn($item){
        $salida = array();
        foreach($this->_data['columns'] as $key => $value){
            
            if(is_array($value['column_table'])){
                $obj = $item;
                foreach($value['column_table'] as $i => $metodo){
                    //if(method_exists($obj, $metodo) and $obj){
                        $obj = $obj->{$metodo};
                    //} 
                }
                $valor = $obj;
                /*if(!is_object($obj)) $valor = $obj;
                else $valor = "";*/
                
            } else {
                $valor = $item->{$value['column_table']}();
            }
            
            switch ($value['column_type']){
                case "image":
                    if(is_file(APPLICATION_PATH . "/../public".$valor)){
                        $salida[] = "<img src=\"".$valor."\" class=\"img-table\" />";
                    } else $salida[] = "<img src=\"/img/no-image.png\" class=\"img-table\" />";;
                    break;
                case "active":
                    //fb($key);
                    $html = $this->view->Active($item, $valor, $this->_title,  $key);
                    $salida[] = $html;
                    break;
                case "helper":

                   
                    $funcion = "smarty_function_" . $value['column_helper'];
                                        
                    $this->smarty->loadPlugin($funcion);
                    
                    if(!empty($value["column_helper_params"])){
                        $lista_parametros = $value["column_helper_params"];
                        if(count($lista_parametros)>0){
                            foreach($lista_parametros as $key_parametros => $valor_parametro){
                                $params[$key_parametros] = $item->{$valor_parametro};
                            }
                        }
                    }
                    
                    if(!empty($value["column_helper_fixed_params"])){
                        $fixed_parametros = $value["column_helper_fixed_params"];
                        if(count($fixed_parametros)>0){
                            foreach($fixed_parametros as $key_parametros => $valor_parametro){
                                $params[$key_parametros] = $valor_parametro;
                            }
                        }
                    }
                    
                    $salida[] = $funcion($params, $this->smarty);
                    break;
                case "html":
                    $html = $value['column_html'];
                    $salida[] = str_replace("%", $valor, $html);
                    break;
                case "date":
                    //fb($valor->format("y-m-d"));
                    if($valor instanceof DateTime ){
                       
                       $salida[] = $valor->format($value['column_date']);
                    } else{
                       $salida[] = "";
                    }
                    break;
                case "money":
                    
                    
                    
                    if(!is_numeric($valor)){
                        fb(__METHOD__ . " Valor no numerico ".$valor);
                        $valor = 0;
                    }
                    
                    $currency = new Zend_Currency(
                                                    array(
                                                        'value' => $valor,
                                                    )
                                                );
                    $currency->setFormat(array("precision" => 0));
                    
                   
                    $salida[] = $currency->toCurrency();
                   
                    break;
                default:
                    $salida[] = $valor;
                    break;
            }
      
        }
        return $salida;
    }

    
}
?>
