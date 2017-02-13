<?php

require_once(APP_PATH . "libs/Helpers/View/Grid.php");

/**
 * 
 * @param array $params
 * @param Smarty $smarty
 * @return string html
 */
function smarty_function_grilla($params, &$smarty) {
    $grid = New View_Grid("lista_prioridades");
    $grid->setModel("DAOPrioridad");
    $grid->addHelperPath(__DIR__, "");
    $grid->setQuery("queryBusquedaPrioridad", array("id" => "id",
                                           "gl_descripcion" => "gl_descripcion",
                                           "fc_fecha_creacion"=>"fc_fecha_creacion"), 
                                   array());
    //coloca los nombres de la cabecera de la tabla y permite ordenar los registros
    $grid->setColumns(array(
            array("column_name" => "Id",
                "column_table" => array("id"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "pr.id"),
                "width" => "5%"),
            array("column_name" => "Descripción",
                "column_table" => array("gl_descripcion"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "pr.gl_descripcion"),
                "width" => "20%"),
           array("column_name" => "Fecha creación",
                "column_table" => array("fc_fecha_creacion"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "pr.fc_fecha_creacion"),
                "width" => "20%"),
                       
            array("column_name" => "",
                "column_table" => array("id"),
                "column_type" => "html",
                "column_html" => "<button data-toggle=\"tooltip\" type=\"button\" onclick=\"location.href='".BASE_URI."/Prioridad/prioridadAEditar/%';\" class=\"btn btn-sm btn-flat btn-success\" title=\"Ver Detalle\">"
                                ."<i class=\"fa fa-edit\"></i> Editar"
                                ."</button>",
                "column_align" => "center",
                "sortable" => false,
                "width" => "5%")
        ));
    
    return $grid->getGrid();
}