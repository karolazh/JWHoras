<?php

require_once(APP_PATH . "libs/Helpers/View/Grid.php");

/**
 * 
 * @param array $params
 * @param Smarty $smarty
 * @return string html
 */
function smarty_function_grilla($params, &$smarty) {
    $grid = New View_Grid("lista_proyectos");
    $grid->setModel("DAOProyecto");
    $grid->addHelperPath(__DIR__, "");
    $grid->setQuery("queryBusquedaProyecto", array("id_proyecto" => "id_proyecto",
                                           "gl_descripcion" => "gl_descripcion",
                                           "fc_fecha_creacion"=>"fc_fecha_creacion"), 
                                   array());
    //coloca los nombres de la cabecera de la tabla y permite ordenar los registros
    $grid->setColumns(array(
            array("column_name" => "ID",
                "column_table" => array("id_proyecto"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "proy.id_proyecto"),
                "width" => "5%"),
            array("column_name" => "Nombre proyecto",
                "column_table" => array("gl_nombre_proyecto"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "proy.gl_nombre_proyecto"),
                "width" => "20%"),
           array("column_name" => "Descripción proyecto",
                "column_table" => array("gl_descripcion_proyecto"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "proy.gl_descripcion_proyecto"),
                "width" => "20%"),
           array("column_name" => "Cliente",
                "column_table" => array("gl_cliente"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "proy.gl_cliente"),
                "width" => "20%"),
                       
            array("column_name" => "",
                "column_table" => array("id_proyecto"),
                "column_type" => "html",
                "column_html" => "<button data-toggle=\"tooltip\" type=\"button\" onclick=\"location.href='".BASE_URI."/Proyecto/editar/%';\" class=\"btn btn-sm btn-flat btn-success\" title=\"Ver Detalle\">"
                                ."<i class=\"fa fa-edit\"></i> Editar"
                                ."</button>",
                "column_align" => "center",
                "sortable" => false,
                "width" => "5%")
        ));
    
    return $grid->getGrid();
}